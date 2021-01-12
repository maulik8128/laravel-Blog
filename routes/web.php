<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('posts/{id}',function($id){


//     return "This is post Number". $id;

// });


//Route::get('/post',"App\Http\Controllers\PostsController@index");

//Route::resource('posts','App\Http\Controllers\PostsController');
// Route::get('/', function(){

//     return view('home.index');

// })->name('home.index');

// Route::get('/contact', function(){

//     return view('home.contact');

// })->name('home.contact');

// Route::view('/', 'home.index')->name('home.index');
// Route::view('/contant','home.contact')->name('home.contact');

// Route::get('/posts/{id}', function($id){

//     $posts = [
//         1 => ['title'=> ' Intro to Laravel','content'=>'This is a short into to laravel','is_new'=>false],
//         2 =>['title'=> ' Intro to php','content'=>'This is a short into to php','is_new'=>true]

//     ];

//     abort_if(!isset($posts[$id]), 404);


//     return view('posts.show', ['post'=> $posts[$id]]);


// });


Route::get('/contact',[ContactController::class,'index']);

Route::get('/home', function(){

 echo "This is redirect Home page";

});

Route::get('/contact', function(){

    return view('welcome');

})->middleware('check');


Route::get('/page', function(){

    echo "This is  Home page";

   });

Route::get('/about', function(){

    echo "This is  about page";

})->name('about');



Route::get('/category/all',[CategoryController::class,'Allcat'])->name('all.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}',[CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}',[categoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}',[categoryController::class, 'Restore']);

Route::get('/pdelete/category/{id}',[CategoryController::class,'Pdelete']);


Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    // $users = User::all();
    $users = DB::table('users')->get();

    return view('dashboard' , compact('users'));
})->name('dashboard');
