
@extends('admin.master')

@section('title', 'Create')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Craete Or Update Settings</h1>

    <form action="{{route('admin.save_settings')}}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('put')
             
            <div class="mb-3">
               <div class="col-md-12">
                    <label for="website_name"> Website Name </label>
                    <input type="text" name="website_name" class="form-control 
                    @error('website_name') is-invalid @enderror"
                     placeholder="Enter Website Name ... " value="{{old('website_name', $data['website_name'])}}">
                    @error('website_name')
                       <small class="invalid-feedback">{{$message}}</small>
                    @enderror
               </div>
            </div>
             <div class="mb-3">
               <div class="col-md-12">
                   <label for="logo_image"> Logo Image </label>
                   <input onchange="return showImg(event)" type="file" 
                   name="logo_image" class="form-control @error('logo_image') is-invalid @enderror" 
                   value="{{old('logo_image', $data['logo_image'])}}">
                   @error('logo_image')
                   <small class="invalid-feedback"> {{$message}}</small>
                   @enderror
                   @php
                     $src = asset('default.jpg');
                     if($data['logo_image']) {
                        $src = asset('settings_imgs/'.$data['logo_image']);
                     }
                   @endphp
                   <div class="position-relative d-inline-block">
                      <div id="delete_img">x</div>
                     <img src="{{$src}}" width="100" id="preview">
                   </div>
               </div>
             </div>

             <div class="mb-3">
               <div class="col-md-12">
                    <label for="address"> Website Adress </label>
                    <input type="text" name="address" class="form-control 
                    @error('address') is-invalid @enderror" placeholder="Enter Website Address ... " 
                    value="{{old('address', $data['address'])}}">
                    @error('address')
                       <small class="invalid-feedback">{{$message}}</small>
                    @enderror
               </div>
            </div>

             <div class="mb-3">
               <div class="col-md-12">
                    <label for="phone"> Website Phone </label>
                    <input type="tel" name="phone" class="form-control 
                    @error('phone') is-invalid @enderror" placeholder="Enter Website phone ... "
                    value="{{old('phone', $data['phone'])}}">
                    @error('phone')
                       <small class="invalid-feedback">{{$message}}</small>
                    @enderror
               </div>
            </div>

             <div class="mb-3">
               <div class="col-md-12">
                    <label for="email"> Website Email </label>
                    <input type="email" name="email" class="form-control 
                    @error('email') is-invalid @enderror" placeholder="Enter Website email ... "
                    value="{{old('email', $data['email'])}}">
                    @error('email')
                       <small class="invalid-feedback">{{$message}}</small>
                    @enderror
               </div>
            </div>
        

         <div class="mb-3">
              <div class="col-md-6">
                   <button class="btn btn-success px-4"> <i class="fas fa-save"></i> Save </button>
              </div>
              
         </div>



    </form>
@endsection

    @section('css')

     <style type="text/css">
          
           #delete_img {
               position: absolute;
               font-size: 20px;
               color: white;
               background: red;
               border-radius: 50%;
               display: flex;
               justify-content: center;
               align-items: center;
               padding: 9px;
               width: 12px;
               height: 12px;
               top: 5px;
               right: 4px;
               cursor: pointer;
           }

     </style>



















    @endsection

@section('js')
      
     <script type="text/javascript">
          let deleimg = document.querySelector('#delete_img');
          deleimg.onclick = () => {
              $.get('/admin/deleimg-site')
              .done((res) => {
                   deleimg.parentElement.remove()
              })
              .fail((err) => {
                   console.log(err);
              })
          }
     </script> 
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

    <script type="text/javascript">
        function showImg(e) {
            const [file] = e.target.files;
            if(file) {
               preview.src = URL.createObjectURL(file);
            }
          }
    </script>


         
@endsection