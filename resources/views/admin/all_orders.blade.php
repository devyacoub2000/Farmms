
@extends('admin.master')

@section('title', 'All Orders')

@section('content')
     @if(session('msg'))
      <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        {{session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
       </div>
     @endif 
    <h1 class="h3 mb-4 text-gray-800">Orders</h1>
    <table class="table table-bordered table-hover">
         <tr class="bg-dark text-white">
             <th>#</th>
             <th>User Name</th>
             <th>Total</th>
             <th>Action</th>
         </tr>

         @forelse($data as $item)
         <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$item->user->name}}</td>
             <td>${{$item->total}}</td>
             <td>
                 <a href="{{route('admin.show_order', $item->id)}}" class="btn btn-info"> <i class="fas fa-eye"></i>
              </a>                 
             </td>
            </tr> 
         
         @empty
            
               <tr>
                  <td colspan="5" class="text-center"> No Orders Found </td>
               </tr>
            
         @endforelse
    </table>

    {{$data->links()}}

@endsection
