<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title> @yield('title', 'Famms - Fashion')</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('front_end/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('front_end/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('front_end/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('front_end/css/responsive.css')}}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      @yield('css')
      <style type="text/css">
         .custom_nav-container .navbar-nav .nav-item .nav-link.active {
              color: #f7444e;
         }
      
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
           @include('front.header')
      
           @yield('content')
        
     
         <footer>
            <div class="container">
               <div class="row">
                  <div class="col-md-4">
                      <div class="full">
                         <div class="logo_footer">
                           <a href="{{url('/')}}"><img width="210" src="{{asset('front_end/images/logo.png')}}" alt="#" /></a>
                         </div>
                         <div class="information_f">
                           <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                           <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                           <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                         </div>
                      </div>
                  </div>
                  <div class="col-md-8">
                     <div class="row">
                     <div class="col-md-7">
                        <div class="row">
                           <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>Menu</h3>
                           <ul>
                              <li><a href="#">Home</a></li>
                              <li><a href="#">About</a></li>
                              <li><a href="#">Services</a></li>
                              <li><a href="#">Testimonial</a></li>
                              <li><a href="#">Blog</a></li>
                              <li><a href="#">Contact</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>Account</h3>
                           <ul>
                              <li><a href="#">Account</a></li>
                              <li><a href="#">Checkout</a></li>
                              <li><a href="#">Login</a></li>
                              <li><a href="#">Register</a></li>
                              <li><a href="#">Shopping</a></li>
                              <li><a href="#">Widget</a></li>
                           </ul>
                        </div>
                     </div>
                        </div>
                     </div>     
                     <div class="col-md-5">
                        <div class="widget_menu">
                           <h3>Newsletter</h3>
                           <div class="information_f">
                             <p>Subscribe by our newsletter and get update protidin.</p>
                           </div>
                           <div class="form_sub">
                              <form>
                                 <fieldset>
                                    <div class="field">
                                       <input type="email" placeholder="Enter Your Mail" name="email" />
                                       <input type="submit" value="Subscribe" />
                                    </div>
                                 </fieldset>
                              </form>
                           </div>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <!-- footer end -->
         <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            
               Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            
            </p>
         </div>
      <!-- jQery -->
      <script src="{{asset('front_end/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('front_end/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('front_end/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('front_end/js/custom.js')}}"></script>
      @yield('js')
   </body>
</html>