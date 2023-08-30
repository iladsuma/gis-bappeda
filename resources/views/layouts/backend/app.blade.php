<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('extra_stylesheet')
    @include('layouts.backend.stylesheet')
    <style>#button{
        display:block;
        margin:20px auto;
        padding:10px 30px;
        background-color:#eee;
        border:solid #ccc 1px;
        cursor: pointer;
      }
      #overlay{	
        position: fixed;
        top: 0;
        z-index: 99999;
        width: 100%;
        height:100%;
        display: none;
        background: rgba(0,0,0,0.6);
      }
      .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;  
      }
      .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #2e93e6 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
      }
      @keyframes sp-anime {
        100% { 
          transform: rotate(360deg); 
        }
      }
      .is-hide{
        display:none;
      }</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    
    <div class="wrapper">
        <div id="overlay">
            <div class="cv-spinner">
              <span class="spinner"></span>
            </div>
          </div>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('assets/image/logo/kdr-logo.png') }}" alt="AdminLTELogo"
                height="175" width="124">
        </div>

        <!-- Navbar -->
        @include('layouts.backend.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.backend.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.backend.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.backend.javascript')
    @yield('extra_javascript')
</body>

</html>
