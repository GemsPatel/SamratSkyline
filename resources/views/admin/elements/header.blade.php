<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
      <head>
            <?php
            $headerInfo = getHeaderInformation();
            ?>
            <base href="./">
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <meta name="description" content="Times Of Rreading">
            <meta name="author" content="ShreeGurave">
            <meta name="keyword" content="Times Of Rreading">

            <!--=============== favicons ===============-->
            <link rel="shortcut icon" href="{{url( 'storage/app/'.$headerInfo->favicon )}}">

            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>{{ $headerInfo->name }}</title>

            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Font Awesome -->
            {{-- <link rel="stylesheet" href="{{url('public/plugins/fontawesome-free/css/all.min.css')}}"> --}}
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Tempusdominus Bootstrap 4 -->
            <link rel="stylesheet" href="{{url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
            <!-- Select2 -->
            <link rel="stylesheet" href="{{url('public/plugins/select2/css/select2.min.css')}}">
            <!-- iCheck -->
            <link rel="stylesheet" href="{{url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
            <!-- JQVMap -->
            <link rel="stylesheet" href="{{url('public/plugins/jqvmap/jqvmap.min.css')}}">
            <!-- Theme style -->
            <link rel="stylesheet" href="{{url('public/css/adminlte.css')}}">
            <!-- overlayScrollbars -->
            <link rel="stylesheet" href="{{url('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
            <!-- Daterange picker -->
            <link rel="stylesheet" href="{{url('public/plugins/daterangepicker/daterangepicker.css')}}">
            <!-- summernote -->
            <link rel="stylesheet" href="{{url('public/plugins/summernote/summernote-bs4.min.css')}}">
            <!-- custom -->
            <link rel="stylesheet" href="{{url('public/css/custom.css')}}">

            <!-- select2 -->
            <link rel="stylesheet" href="{{url('public/css/select2.css')}}">

            <!-- jQuery -->
            <script src="{{url('public/plugins/jquery/jquery.min.js')}}"></script>

            <!-- Dropify Image upload -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            {{-- CKEditor CDN --}}
            {{-- <script src="{{url('public/css/ckeditor5.css')}}"></script> --}}

            @yield('css')

            <script>
                  var token = $('meta[name="csrf-token"]').attr("content");
                  var url = '{{url("/")}}';
                  var load_image = "{{load_image('')}}";
            </script>
      </head>
      <body class="hold-transition sidebar-mini layout-fixed">
            <div class="wrapper">

            <!-- Preloader -->
            <?php
            $getThemeName = getConfigurationfield("FRONT_THEME");
            ?>
            <div class="preloader flex-column justify-content-center align-items-center">
                  <img class="animation__shake" src="{{url( 'storage/app/'.$headerInfo->favicon )}}" alt="{{pgTitle( $headerInfo->name )}}" height="60" width="60">
            </div>

            <!-- Navbar -->
            @include('admin.elements.header-menu')

            <!-- Main Sidebar Container -->
            @include('admin.elements.sidebar')
