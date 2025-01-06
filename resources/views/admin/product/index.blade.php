
@extends('admin.master')

@section('title', 'index')

@section('content')
     @if(session('msg'))
      <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        {{session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
       </div>
     @endif 
    <h1 class="h3 mb-4 text-gray-800">Products</h1>
    <table class="table table-bordered table-hover">
         <tr class="bg-dark text-white">
             <th>#</th>
             <th>Image</th>
             <th>Name</th>
             <th>Price</th>
             <th>Quantity</th>
             <th>Discount Price</th>
             <th>Category</th>
             <th>Action</th>
         </tr>

         @forelse($data as $item)
         <tr>
             <td>{{$loop->iteration}}</td>
             <td><img src="{{$item->Img_Path}}" width="200" height="150"></td>
             <td>{{$item->Trans_Name}}</td>
             <td>${{$item->price}}</td>
             <td>{{$item->quantity}}</td>
             <td>{{$item->discount}}</td>
             <td>{{$item->category->Trans_Name}}</td>
             <td>
                  <a href="{{route('admin.product.edit', $item->id)}}" class="btn btn-info"> <i class="fas fa-edit"></i>
                 </a>
                  <form class="d-inline" action="{{route('admin.product.destroy', $item->id)}}" enctype="multipart/form-data" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" onclick="return confirm('Are u Sure ?')"> <i class="fas fa-trash"></i></button>
                  </form>
             </td>
            </tr> 
         
         @empty
            
               <tr>
                  <td colspan="7" class="text-center"> No Data Found </td>
               </tr>
            
         @endforelse
    </table>

    {{$data->links()}}

@endsection
