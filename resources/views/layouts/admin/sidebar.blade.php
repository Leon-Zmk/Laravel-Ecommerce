 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src='{{asset("images/admin_img/AdminLTELogo.png")}}'alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src='{{asset("images/admin_img/user2-160x160.jpg")}}' class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route("dashboard")}}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Auth::guard("admin")->user()->type=="Vendor")

          <li class="nav-item">

            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                 Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("vupdate","password")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("vupdate","personal")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("vupdate","business")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Business Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("dlogout")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Add Your Products 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
             
              <li class="nav-item">
                <a href="{{route("productsManagement")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Products </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Orders Management 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="{{route("orders")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Orders </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route("buyers")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Buyers </p>
                </a>
              </li>
            
            </ul>
          </li>
          
          @else
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Admin Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("apupdate")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("adupdate")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("dlogout")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Logout</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Account Management 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route("management","Admin")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("management","Subadmin")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subadmin </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("management","Vendor")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendor </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("users")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("management")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Catalogue Management 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="{{route("sectionsManagement")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sections </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("categoriesManagement")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Catagories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("brandsManagement")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brands </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("productsManagement")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products </p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Orders Management 
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="{{route("orders")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Orders </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route("buyers")}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Show Buyers </p>
                </a>
              </li>
            
            </ul>
          </li>
        @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>