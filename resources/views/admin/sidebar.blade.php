<div id="sidebar_color" class=""> 
             
             <!-- Sidebar -->
       <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" 
           href="{{url('/')}}">
               <div class="sidebar-brand-icon">
                   <i class="fas fa-store"></i>
               </div>
               <div class="sidebar-brand-text mx-3"> {{env('APP_NAME')}} </div>
           </a>

           <!-- Divider -->
           <hr class="sidebar-divider my-0">

           <!-- Nav Item - Dashboard -->
           <li class="nav-item">
               <a class="nav-link" href="{{route('admin.index')}}">
                   <i class="fas fa-fw fa-tachometer-alt"></i>
                   <span> {{__('admin.dash')}}</span></a>
           </li>

            <hr class="sidebar-divider my-0">

           <!-- Nav Item - Dashboard -->
           <li class="nav-item">
               <a class="nav-link" href="{{route('admin.contacts')}}">
                   <i class="fas fa-fw fa-box"></i>
                   <span>Contacts</span></a>
           </li>

           <!-- Divider -->
           <hr class="sidebar-divider my-0">

         
           <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                   aria-expanded="true" aria-controls="collapseCategory">
                   <i class="fas fa-fw fa-tags"></i>
                   <span>{{__('admin.cate')}}</span>
               </a>
               <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">
                       <h6 class="collapse-header">Custom Components:</h6>
                       <a class="collapse-item" href="{{route('admin.category.index')}}"> 
                       {{__('admin.all_cate')}}</a>
                       <a class="collapse-item" href="{{route('admin.category.create')}}">
                           {{__('admin.add_new')}}
                       </a>
                   </div>
               </div>
           </li>

            <!-- Divider -->
           <hr class="sidebar-divider my-0">

            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseproduct"
                   aria-expanded="true" aria-controls="collapseproduct">
                   <i class="fas fa-fw fa-box-open"></i>
                   <span>{{__('admin.product')}}</span>
               </a>
               <div id="collapseproduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                   <div class="bg-white py-2 collapse-inner rounded">
                       <h6 class="collapse-header">Custom Components:</h6>
                       <a class="collapse-item" href="{{route('admin.product.index')}}"> 
                         {{__('admin.all_products')}}
                       </a>
                       <a class="collapse-item" href="{{route('admin.product.create')}}">{{__('admin.add_new')}}</a>
                   </div>
               </div>
           </li>

           <hr class="sidebar-divider my-0">
           <li class="nav-item">
               <a class="nav-link" href="{{route('admin.all_orders')}}">
                   <i class="fas fa-fw fa-shopping-cart"></i>
                   <span>{{__('admin.order')}}</span></a>
           </li>



            <!-- Divider -->
           <hr class="sidebar-divider my-0">



           <!-- Divider -->
           <hr class="sidebar-divider">

        
   

           <!-- Sidebar Toggler (Sidebar) -->
           <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
           </div>

       </ul>

        </div>