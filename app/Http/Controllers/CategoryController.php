<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

     public function AllCat(){

        // $categories=Category::all();
       // $categories =Category::latest()->paginate(5);
        //$categories = DB::table('Categories')->latest()->paginate(5);

        $categories = Category::latest()->paginate(5);
        $trachCat = Category::onlyTrashed()->latest()->paginate(3);

        // $categories = DB::table('categories')->join('users','categories.user_id','users.id')
        //     ->select('categories.*','users.name')->latest()->paginate(5);
        return view('admin.category.index',compact('categories', 'trachCat'));



     }

    public function AddCat(Request $request){

        $validatedData = $request->validate([

            'category_name' =>'required|unique:categories|max:25'

        ],
        [
            'category_name.required' => 'Please Input Category Name',
        ]

    );

        Category::insert([

            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()

        ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['user_id']= Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with('success','Category Inserted Successfully');



    }

    public function Edit($id){

       // $categories = Category::find($id);
        $categories = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit', compact('categories'));



    }

    public function Update(Request $request, $id){

        // $update = Category::find($id)->update([

        //     'category_name' => $request->category_name,
        //     'user_id'=>Auth::user()->id
        //     ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $data['user_id']=Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('update','Category Updated Successfully');
    }

    public function SoftDelete($id){

        $delete = Category::find($id)->delete();

        return Redirect()->back()->with('success','Category SoftDelete Successfully');



    }

    public function Restore($id){

       $delete = Category::withTrashed()->find($id)->restore();

       return Redirect()->back()->with('success','Category Restore Successfully');

    }

    public function Pdelete($id){

        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success','Category Permanently  Delete Successfully');

    }

}
