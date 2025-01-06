
@extends('admin.master')

@section('title', 'contacts')

@section('content')
     @if(session('msg'))
      <div class="alert alert-{{session('type')}} alert-dismissible fade show" role="alert">
        {{session('msg')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
       </div>
     @endif 
    <h1 class="h3 mb-4 text-gray-800">Contacts</h1>
    <table class="table table-bordered table-hover">
         <tr class="bg-dark text-white">
             <th>#</th>
             <th>Full Name</th>
             <th>Email</th>
             <th>Subject</th>
             <th>Message</th>
         </tr>

         @forelse($data as $item)
         <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$item->name}}</td>
             <td>{{$item->email}}</td>
             <td>{{$item->subject}}</td>
             <td>{{$item->msg}}</td>
            </tr> 
         
         @empty
            
               <tr>
                  <td colspan="7" class="text-center"> No Data Found </td>
               </tr>
            
         @endforelse
    </table>

    {{$data->links()}}

@endsection
