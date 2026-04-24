 <!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
     data-scroll="true">
     <div class="container-fluid py-1 px-3">
         <nav aria-label="breadcrumb">
             <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                 <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                 <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
             </ol>
         </nav>
         <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
             <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                 {{-- <div class="input-group input-group-outline">
                     <label class="form-label">Type here...</label>
                     <input type="text" class="form-control">
                 </div> --}}
             </div>
             <ul class="navbar-nav d-flex align-items-center justify-content-end">

                 {{-- Hamburger (Mobile) --}}
                 <li class="nav-item d-xl-none d-flex align-items-center me-2">
                     <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                         <div class="sidenav-toggler-inner">
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                             <i class="sidenav-toggler-line"></i>
                         </div>
                     </a>
                 </li>

                 {{-- User Dropdown --}}
                 @auth
                     <li class="nav-item dropdown d-flex align-items-center ms-2">
                         <a href="#" class="nav-link text-body font-weight-bold px-0 d-flex align-items-center"
                             id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                             <i class="material-symbols-rounded me-1">account_circle</i>
                             <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                         </a>

                         <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="userDropdown">

                             {{-- Edit Profile --}}
                             <li>
                                 <a class="dropdown-item border-radius-md" href="{{ route('profile.edit') }}">
                                      Edit Profile
                                 </a>
                             </li>

                             <li>
                                 <hr class="horizontal dark my-2">
                             </li>

                             {{-- Logout --}}
                             <li>
                                 <form method="POST" action="{{ route('logout') }}">
                                     @csrf
                                     <button type="submit" class="dropdown-item border-radius-md text-danger">
                                         Logout
                                     </button>
                                 </form>
                             </li>

                         </ul>
                     </li>
                 @endauth

             </ul>
         </div>
     </div>
 </nav>
 <!-- End Navbar -->
