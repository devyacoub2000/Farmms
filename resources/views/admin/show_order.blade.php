
@extends('admin.master')

@section('css')
 <style type="text/css">
     .price {
        text-decoration: line-through;
        color: red;
     }
     .discount {
        text-decoration:underline;
        color: blue;
     }
 </style>
@endsection

@section('title', 'Show')

@section('content')
     @if(session('msg'))
      <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        {{session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
       </div>
     @endif 
    <h1 class="h3 mb-4 text-gray-800">{{__('admin.order')}}</h1>
    <table class="table table-bordered table-hover">
         <tr class="bg-dark text-white">
             <th>#</th>
             <th>User Name</th>
             <th>Product Name</th>
             <th>Price</th>
             <th>Discount</th>
             <th>Quantity</th>
             <th>Total</th>
         </tr>

         @forelse($data->order_detailes as $item)
         <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$item->user->name}}</td>
             <td>{{$item->product->Trans_Name}}</td>
             <td class="{{ $item->discount > 0 ? 'price' : 'discount' }}">${{$item->price}}</td>
             <td>${{$item->discount}}</td>
             <td>{{$item->quantity}}</td>
             <td>{{$item->total}}</td>
            </tr> 
         
         @empty
            
               <tr>
                  <td colspan="7" class="text-center"> No Data Found </td>
               </tr>
            
         @endforelse
    </table>


@endsection
