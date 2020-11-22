<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('backend/img/logo.png') }}" rel="icon">
  <title>Vue Inventory</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('backend/css/ruang-admin.css') }}" rel="stylesheet">
</head>

<div id="app">
  <body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
          <ul v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false: true " style="display: none" class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <router-link to="/home" class="sidebar-brand d-flex align-items-center justify-content-center">
              {{-- <div class="sidebar-brand-icon">
                <img src="{{ asset('backend/img/logo/logo2.png') }}">
              </div> --}}
              <div class="sidebar-brand-text mx-3">Vue Inventory WebApps</div>
            </router-link>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
              <router-link to="/home" class="nav-link" >
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></router-link>
            </li>
            <li class="nav-item active">
              <router-link to="/pos" class="nav-link" >
                <i class="fas fa-fw fa-chart-area"></i>
                <span>POS</span></router-link>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
              Features
            </div>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="fas fa-users"></i><span>Employee</span>
              </a>
              <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-employee" class="collapse-item"><i class="fas fa-user-plus"></i> Add Employee</router-link>
                  <router-link to="/employee" class="collapse-item"><i class="fas fa-users"></i> All Employee</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fas fa-user-tag"></i><span> Supplier</span>
              </a>
              <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-supplier" class="collapse-item"><i class="fas fa-user-plus"></i> Add Supplier</router-link>
                  <router-link to="/supplier" class="collapse-item"><i class="fas fa-users"></i> All Supplier</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer" aria-expanded="true"
                aria-controls="customer">
                <i class="far fa-id-card"></i><span> Customer</span>
              </a>
              <div id="customer" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-customer" class="collapse-item"><i class="fas fa-user-plus"></i> Add Customer</router-link>
                  <router-link to="/customer" class="collapse-item"><i class="fas fa-users"></i> All Customer</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#category" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fas fa-tags"></i><span>Category</span>
              </a>
              <div id="category" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-category" class="collapse-item" ><i class="fas fa-plus-square"></i> Add Category</router-link>
                  <router-link to="/category" class="collapse-item" ><i class="fas fa-tags"></i> All Category</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fas fa-gifts"></i><span>Product</span>
              </a>
              <div id="product" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-product" class="collapse-item" ><i class="fas fa-plus-square"></i> Add Product</router-link>
                  <router-link to="/product" class="collapse-item" ><i class="fas fa-box-open"></i> All Product</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expense" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fas fa-hand-holding-usd"></i><span>Expense</span>
              </a>
              <div id="expense" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/store-expense" class="collapse-item" ><i class="fas fa-dollar-sign"></i> Add Expense</router-link>
                  <router-link to="/expense" class="collapse-item" ><i class="fas fa-comment-dollar"></i> All Expense</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#salary" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="far fa-money-bill-alt"></i><span>Salary</span>
              </a>
              <div id="salary" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/given-salary" class="collapse-item" ><i class="fas fa-hand-holding-usd"></i> Pay Salary</router-link>
                  <router-link to="/salary" class="collapse-item" ><i class="fas fa-money-bill-alt"></i> All Salary</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orders" aria-expanded="true"
                aria-controls="collapseForm">
                <i class="fas fa-shopping-cart"></i><span>Orders</span>
              </a>
              <div id="orders" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Action</h6>
                  <router-link to="/order" class="collapse-item" ><i class="fas fa-cart-arrow-down"></i> Today's Order</router-link>
                  <router-link to="/search/order" class="collapse-item" ><i class="fas fa-search"></i> Search Order</router-link>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <router-link to="/stock" class="nav-link collapsed">
                <i class="fas fa-store"></i><span> Product Stock</span>
              </router-link>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
              Others
            </div>
            
            <li class="nav-item">
              <router-link to="/setting" class="nav-link collapsed">
                <i class="fas fa-cog"></i><span>Settings</span>
              </router-link>
            </li>
            
            <hr class="sidebar-divider">
            <div class="version" >Powered by Laravel,Vue.JS,Rest API</div>
          </ul>
        <!-- end Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">

            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top" id="topbar" v-show="$route.path === '/' || $route.path === '/register' || $route.path === '/forget' ? false: true " style="display: none" >
              <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                          aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle" src="{{ asset('backend/img/boy.png') }}" style="max-width: 60px">
                    <span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#LogoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>
                  </div>
                </li>
              </ul>
            </nav>
            <!-- Topbar -->
              <!-- Modal -->
              <div class="modal fade" id="LogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <router-link to="/logout"><button type="button" class="btn btn-primary">Logout</button></router-link>
                    </div>
                  </div>
                </div>
              </div>
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <!-- route outlet -->
                <!-- component matched by the route will render here -->
                <router-view></router-view>
                
            </div>
            <!---Container Fluid-->
          </div>
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright © 2020 -  Developed by
                  <b><a href="https://shawon9324.github.io/" target="_blank">shawon9324</a></b>
                </span>
              </div>
            </div>
          </footer>
        </div>
    </div> 

  </div>
</div>


  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>  
  <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script type="text/javascript">
  let token = localStorage.getItem('token')
  if(token){
    // $("#sidebar").css("display","");
    $("#topbar").css("display","");
  }else{
    // $("#container-wrapper").addClass("custom");
  }
  </script>
  <script src="{{ asset('backend/js/ruang-admin.js') }}"></script>


</body>
</html>