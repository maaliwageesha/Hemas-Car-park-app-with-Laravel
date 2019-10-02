
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Hemas Hospital')}}</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./css/starter-template.css') }}">
 <link rel="stylesheet" href="/css/app.css">
 <style>
     body {
         padding-top: 0 !important;
     }
 </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  {{-- <nav class="main-header navbar navbar-expand navbar-white"> --}}
  <nav class="main-header navbar navbar-expand bg-dark">
    <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
    </ul>
    <!-- SEARCH FORM -->
    <div class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchthis" v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchthis">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </div>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  {{-- <aside class="main-sidebar sidebar-light-primary elevation-4"> --}}
  <aside class="main-sidebar bg-dark elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/hemas.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Hemas Hospital</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition"><div class="os-resize-observer-host"><div class="os-resize-observer observed" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer observed"></div></div><div class="os-content-glue" style="margin: 0px -8px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/person.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
              </p>
            </router-link>
          </li>
          @if (Auth::user()->can('isSuperAdmin') || Auth::user()->can('isAdmin'))
            <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>STAFF REG.</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/regular" class="nav-link">
                  <i class="fas fa-user-clock nav-icon"></i>
                  <p>TEMPORARY REG.</p>
                </router-link>
              </li>
            <li class="nav-item">
                <router-link to="/booking" class="nav-link">
                    <i class="nav-icon fa fa-list-alt"></i>
                    <p>BOOKINGS</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/payment" class="nav-link">
                    <i class="fa fa-credit-card nav-icon"></i>
                    <p>PAYMENT</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/feedback" class="nav-link">
                    <i class="fa fa-comment-dots nav-icon"></i>
                    <p>FEEDBACK</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/complaints" class="nav-link">
                    <i class="fa fa-angry nav-icon"></i>
                    <p>COMPLAINTS</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/settings" class="nav-link">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>SETTINGS</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/attendance" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>ATTENDANCE</p>
                </router-link>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off"></i>
                <p>{{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 54.5189%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <router-view></router-view>
            {{-- progressbar --}}
            <vue-progress-bar></vue-progress-bar>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
@auth
    <script>
        window.user = @json(auth()->user());
    </script>
@endauth
<script src="/js/app.js"></script>
</body>
</html>
