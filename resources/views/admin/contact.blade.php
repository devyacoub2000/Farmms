
@extends('admin.master')

@section('title', 'contacts')

@section('content')
  
    
    <h1 class="h3 mb-4 text-gray-800">Contacts</h1>
    <table class="table table-bordered table-hover">
         <tr class="bg-dark text-white">
             <th>#</th>
             <th>Full Name</th>
             <th>Email</th>
             <th>Subject</th>
             <th>Message</th>
             <th>Action</th>
         </tr>

         @forelse($data as $item)
         <tr>
             <td>{{$loop->iteration}}</td>
             <td>{{$item->name}}</td>
             <td>{{$item->email}}</td>
             <td>{{$item->subject}}</td>
             <td>{{$item->msg}}</td>
             <td>
                 <a href="{{route('admin.single_contact', $item->id)}}" class="btn btn-info">
                        <i class="fas fa-eye"></i>
                 </a>

                 <form class="d-inline" action="{{route('admin.delete_contact', $item->id)}}" method="POST">
                     @csrf
                     @method('DELETE')
                     <button class="btn btn-danger" onclick="return confirm('Are u Sure ?');"> <i class="fas fa-trash"></i></button>
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

@section('js')
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript">
           const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                  toast.onmouseenter = Swal.stopTimer;
                  toast.onmouseleave = Swal.resumeTimer;
              }
          });

          @if(session('msg'))
              Toast.fire({
                  icon: "success",
                  title: "{{session('msg')}}"
              });
          @endif
        </script>
      @endsection
