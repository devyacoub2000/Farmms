
@extends('admin.master')

@section('title', 'Edit')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit category</h1>

    <form action="{{route('admin.category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('put')

         <div class="mb-3">       
           <label for="name_en">  Category Name English </label>
           <input type="text" name="name_en" placeholder="Name En" value="{{old('name_en', $category->name_en)}}" class="form-control @error('name_en') is-invalid @enderror">
           @error('name_en')
             <small class="invalid-feedback"> {{$message}} </small>
           @enderror
          </div>

         <div class="mb-3">       
           <label for="name_ar">  Category Name Arabic </label>
           <input type="text" name="name_ar" placeholder="Name Ar" value="{{old('name_ar', $category->name_ar)}}" class="form-control @error('name_ar') is-invalid @enderror">
           @error('name_ar')
             <small class="invalid-feedback"> {{$message}} </small>
           @enderror
          </div>

         <div class="mb-3">
              <button class="btn btn-success"> <i class="fas fa-edit"></i> Edit </button>
         </div>



    </form>
@endsection
@section('js')
   <script type="text/javascript">
          function showImg(e) {
            const [file] = e.target.files;
            if(file) {
               preview.src = URL.createObjectURL(file);
            }
          }
     </script>
@endsection