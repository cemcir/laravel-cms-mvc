<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>NE CMS PANEL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/backend/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="/backend/dist/css/skins/skin-blue.min.css">
  
  <script src="/backend/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="/backend/bower_components/jquery-ui/jquery-ui.js"></script>
  
  <script src="/backend/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/backend/dist/js/adminlte.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
  <!-- Semantic UI theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
  <!-- Bootstrap theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <link rel="stylesheet" href="/backend/custom/css/custom.css"/>
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b>E</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>NE</b>CMS</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/images/users/{{Auth::user()->user_file}}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/images/users/{{Auth::user()->user_file}}" class="img-circle" alt="User Image">
                <p>
                  {{Auth::user()->name}}
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('user.edit',Auth::user()->id)}}" class="btn btn-default btn-flat">Profil Düzenle</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('nedmin.Logout')}}" class="btn btn-default btn-flat">Çıkış</a>
                </div>
              </li>
            </ul>
          </li>   
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img style="width:50px;height:50px;" src="/images/users/{{Auth::user()->user_file}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <p>Yönetici</p>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENULER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{route('nedmin.Index')}}"><i class="fa fa-link"></i><span>Dashboard</span></a></li>
        <li><a href="{{route('blog.index')}}"><i class="fa fa-paper-plane"></i> <span>Blogs</span></a></li>
        <li><a href="{{route('slider.index')}}"><i class="fa fa-paper-plane"></i> <span>Sliders</span></a></li>
        <li class="treeview">
          <a href=""><i class="fa fa-link"></i><span>Yönetim</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('settings.Index')}}"><i class="fa fa-cog"></i><span>Ayarlar</span></a></li>
            <li><a href="{{route('user.index')}}"><i class="fa fa-user"></i><span>Yönetici</span></a></li>
          </ul>
        </li>

      </ul>  
    </section>
  </aside>

  <div class="content-wrapper">
    
    @yield('content')
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->

    </section>
  </div>
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Ne Yazılım CMS
    </div>
    <strong>Copyright &copy; 2016 <a href="#">NE YAZILIM</a>.</strong> All rights reserved.
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@if(session()->has('success'))
    <script>alertify.success('{{session('success')}}')</script>
@endif
@if(session()->has('error'))
    <script>alertify.error('{{session('error')}}')</script>
@endif

@foreach($errors->all() as $error)
    <script>
      alertify.error('{{$error}}');
    </script>
@endforeach
</body>
</html>