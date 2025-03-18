
@extends('admin.master')

@section('title', 'Single Contact')

@section('content')
    
    <h1 class="h3 mb-4 text-gray-800">Single Contact</h1>

    <div class="card">
         <div class="card-body">
          <p> <strong style="cursor: pointer;"> Message Name: </strong> {{$item->name}}</p>
          <p> <strong style="cursor: pointer;"> Message Email:</strong> {{$item->email}}</p>
          <p> <strong style="cursor: pointer;"> Message Subject:</strong> {{$item->subject}}</p>
          <p>
              <strong style="cursor: pointer;"> Message Content:</strong> {{$item->msg}}
          </p>

          <hr>
          <h1 style="cursor:pointer;"> <i class="fas fa-reply"></i> Reply To Message </h1>

          <form action="{{route('admin.reply_msg', $item->id)}}" method="POST">
              @csrf
              <textarea class="form-control mb-3" rows="5" name="reply" placeholder="Reply to your Message .. ">
                   
              </textarea>

              <button class="btn btn-primary px-3"> <i class="fas fa-paper-plane mr-2"></i> Reply</button>
          </form>
          </div>
    </div>
    

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
