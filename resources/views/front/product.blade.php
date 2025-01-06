      
      @extends('front.app')
      @section('title', 'ALL Products')
      @section('content')
      <!-- inner page section -->
         <section class="inner_page_head">
            <div class="container_fuild">
               <div class="row">
                  <div class="col-md-12">
                     <div class="full">
                        <h3>Product Grid</h3>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- end inner page section -->
         <!-- product section -->
         <section class="product_section layout_padding">
            <div class="container">
               <div class="heading_container heading_center">
                  <h2>
                     Our <span>products</span>
                  </h2>
               </div>
               <div class="row">
                   @foreach(App\Models\Product::latest('id')->get() as $item)
                  <div class="col-sm-6 col-md-4 col-lg-4">
                     <div class="box">
                        <div class="option_container">
                           <div class="options">
                              <a href="{{route('front.single_product', $item->id)}}" class="option1">
                              {{$item->Trans_Name}}
                              </a>
                              <a href="{{route('front.single_product', $item->id)}}" class="option2">
                              Buy Now
                              </a>
                           </div>
                        </div>
                        <div class="img-box">
                           <img src="{{asset('images/'.$item->image->path)}}" alt="">
                        </div>
                        <div class="detail-box">
                           <h5>
                              {{Str::Words($item->Trans_Name, 1.5, '.')}} 
                           </h5>
                           @if($item->discount > 0) 
                              <h6 style="text-decoration: line-through;">
                                 ${{$item->price}}
                              </h6> 
                              <h6 style="color:red;">
                                 ${{$item->discount}}
                              </h6> 
                           @else
                             <h6 style="text-decoration: underline;">
                                 ${{$item->price}}
                              </h6>                                     
                           @endif  
                        </div>
                     </div>
                  </div>
                  @endforeach
                
               </div>
             
            </div>
         </section>
      @endsection
     