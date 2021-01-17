<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Brand
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">





                <div class="col-md-4">

                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <form action="{{ url('brand/update/'.$brands->id) }}"method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $brands->brand_image }}" >

                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Update Brand</label>
                              <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{ $brands->brand_name }}">

                              @error('brand_name')


                              <span class="text-danger"> {{ $message }}</span>


                              @enderror


                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Brand Image</label>
                                <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ $brands->brand_image }} ">

                                @error('brand_image')

                                    <span class="text-danger"> {{ $message }}</span>

                                @enderror

                            </div>

                            <div>
                             <img src="{{ asset($brands->brand_image) }}" alt="" style="width:400px; hieght:200px;">

                            </div>

                            <button type="submit" class="btn btn-primary">Upadate brand</button>
                          </form>

                    </div>
                </div>





                {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <x-jet-welcome />
                    </div>
                </div> --}}
            </div>
</x-app-layout>
