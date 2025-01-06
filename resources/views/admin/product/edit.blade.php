
@extends('admin.master')

@section('title', 'Edit')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Edit product</h1>

    <form action="{{route('admin.product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('put')
         <div class="mb-3"> 
           <div class="row"> 
                <div class="col-md-6">     
                   <label for="name_en">  product Name English </label>
                   <input type="text" name="name_en" placeholder="Name En" value="{{old('name_en',$product->name_en)}}" class="form-control @error('name_en') is-invalid @enderror">
                   @error('name_en')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>
               
               <div class="col-md-6">     
                   <label for="name_ar">  product Name Arabic </label>
                   <input type="text" name="name_ar" placeholder="Name Ar" value="{{old('name_ar',$product->name_ar)}}" class="form-control @error('name_ar') is-invalid @enderror">
                   @error('name_ar')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

                <div class="col-md-6">     
                   <label for="price">  product Price </label>
                   <input type="number" name="price" placeholder="price" value="{{old('price', $product->price)}}" class="form-control @error('price') is-invalid @enderror">
                   @error('price')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

               <div class="col-md-6">     
                   <label for="quantity">  product Quantity </label>
                   <input type="number" name="quantity" placeholder="quantity" value="{{old('quantity', $product->quantity)}}" class="form-control @error('quantity') is-invalid @enderror">
                   @error('quantity')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

                <div class="col-md-6">     
                   <label for="discount">  product discount </label>
                   <input type="number" name="discount" placeholder="discount" value="{{old('discount', $product->discount)}}" class="form-control @error('discount') is-invalid @enderror">
                   @error('discount')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

               <div class="col-md-6">     
                   <label for="category_id">  product Category </label>
                   <select name="category_id" value="{{old('category_id')}}" class="form-control @error('category_id') is-invalid @enderror">
                        <option disabled> -- Select Category --</option>
                         @foreach ($categories as $item)
                             <option value="{{$item->id}}"{{$item->id == $product->category->id ? 'selected' : ''}}> {{$item->Trans_Name}} </option>
                         @endforeach 
                   </select>
                   @error('category_id')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

               <div class="col-md-6">     
                   <label for="body_en">  product body English </label>
                   <textarea name="body_en" placeholder="body En" class="form-control @error('body_en') is-invalid @enderror" rows="3">
                       {{old('body_en', $product->body_en)}}
                   </textarea>
                   @error('body_en')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

               <div class="col-md-6">     
                   <label for="body_ar">  product body Arabic </label>
                   <textarea name="body_ar" placeholder="body Ar" class="form-control @error('body_ar') is-invalid @enderror" rows="3">
                       {{old('body_ar', $product->body_ar)}}
                   </textarea>
                   @error('body_ar')
                     <small class="invalid-feedback"> {{$message}} </small>
                   @enderror
               </div>

               <div class="col-md-6">
                     <label for="image"> Image </label>
                      <input onchange="return showImg(event)" type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                      @error('image')
                        <small class="invalid-feedback"> {{$message}}</small>
                      @enderror
                      @php
                        $src = '';
                        if($product->image) {
                            $src = asset('images/'.$product->image->path);
                        }
                      @endphp
                      <img src="{{$src}}" width="100" id="preview">
               </div>

           </div>
        </div>

         <div class="mb-3">
              <button class="btn btn-info"> <i class="fas fa-edit"></i> Edit </button>
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