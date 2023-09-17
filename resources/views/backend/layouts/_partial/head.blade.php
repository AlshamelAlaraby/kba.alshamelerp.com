<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','لوحة التحكم')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/jqvmap/jqvmap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/summernote/summernote-bs4.min.css">


    <link rel="stylesheet" href="{{asset('assets/backend')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/backend')}}/dist/css/custom.css">
     <!-- Toastr -->
     <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/toastr/toastr.min.css">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="{{asset('assets/backend')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link href='https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css' rel='stylesheet'>

    {{-- @import url(https://fonts.googleapis.com/earlyaccess/amiri.css);
  /* font-family: 'Amiri', serif; */

  @import url(https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
  /*font-family: 'Droid Arabic Naskh', serif;*/

  @import url(https://fonts.googleapis.com/earlyaccess/lateef.css);
  /* font-family: 'Lateef', serif; */

  @import url(https://fonts.googleapis.com/earlyaccess/scheherazade.css);
  /*font-family: 'Scheherazade', serif;*/

  @import url(https://fonts.googleapis.com/earlyaccess/thabit.css);
  /* font-family: 'Thabit', serif; */ --}}


    <style>
        .isrequired{
            border-radius: 5px;
            border: 2px solid red !important;
        }
        .deleteImg{
            position: absolute;
            bottom:0;
            margin-right: 5px;
        }
        .imgItem{
            margin-top: 10px;
            margin-bottom: 10px;
        }
        body {
            font-family: 'Droid Arabic Naskh', serif!important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 31px;
            right: 94%;
        }
        h3.card-title {
            float: right;
            padding: 7px;
        }
        .navbar-secondary {
            background-color: #007bff;
            color: #fff;
        }
        .navbar-light .navbar-nav .nav-link {
            color: #fff;
        }
        .select2-container--default .select2-results__group {
            background: #343a40;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
        }
        .select2-container--default .select2-results__option[aria-selected=true], .select2-container--default .select2-results__option[aria-selected=true] {
            color: #444;
            padding-right: 20px;
        }

        .alert-warning, .alert-warning>a, .bg-warning, .bg-warning>a {
                    color: #fff!important;
        }
        @media print {
            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
            @page{
                size: auto;
                height:auto;
                margin-left: .3cm;
                margin-right: 0.3cm;
                margin-top: .3cm;
                margin-bottom: .3cm;
                padding: 0cm!important;
            }

            /* body { margin: .5cm;} */
            .printHeader{
                display: block!important;
            }
            a[href]:after {
                content: none !important;display: none !important;
            }
            .main-footer,.dt-buttons,.dataTables_filter{
                display: none ;display: none !important;
            }

            #footer{visibility: visible;display: none !important;}
            a{
                visibility:hidden;display: none !important;
            }
            .table {
                border: 1px solid black !important;
                font-weight: bold;
            }
            .table td,.table th {
                border: 1px solid #020202 !important;
            }


            html, body { height: auto!important; }
            .dt-print-table, .dt-print-table thead, .dt-print-table th, .dt-print-table tr
            {
                border: 0 none !important;
            }
            .card {
                border: 0!important;
            }
            thead {display: table-header-group;}
            tfoot {display: table-footer-group;}
        }
        @media print {
        .col-md-1,.col-md-2,.col-md-3,.col-md-4,
        .col-md-5,.col-md-6,.col-md-7,.col-md-8,
        .col-md-9,.col-md-10,.col-md-11,.col-md-12 {
            float: left;
        }

        .col-md-1 {
            width: 8%;
        }
        .col-md-2 {
            width: 16%;
        }
        .col-md-3 {
            width: 25%;
        }
        .col-md-4 {
            width: 33%;
        }
        .col-md-5 {
            width: 42%;
        }
        .col-md-6 {
            width: 50%;
        }
        .col-md-7 {
            width: 58%;
        }
        .col-md-8 {
            width: 66%;
        }
        .col-md-9 {
            width: 75%;
        }
        .col-md-10 {
            width: 83%;
        }
        .col-md-11 {
            width: 92%;
        }
        .col-md-12 {
            width: 100%;
        }
        }
    </style>
    @stack('css')
</head>
