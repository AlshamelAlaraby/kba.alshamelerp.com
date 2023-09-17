<!DOCTYPE html>
<html>
@include('backend.layouts._partial.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
        @include('backend.layouts._partial.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
        @include('backend.layouts._partial.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="row printHeader" style="margin-bottom: 20px;display: none;">
                <div class="col-md-3">
                    <img style="max-width: 100%;float: right;" src="{{ asset('logo.png') }}">
                </div>
                <div class="col-md-3">
                    <h5 style="margin-top: 60px;">الاتحاد الكويتى لكرة السلة</h5>
                    <h5> عضو الاتحاد الدولى</h5>
                </div>
                <div class="col-md-4">
                    <h5 style="margin-top: 60px;">Kuwait Basketball Association</h5>
                    <h5>Member Of FIBA 1958</h5>
                </div>
                <div class="col-md-2" >
                    <img class="rounded-circle" style="width: 150px;float: left;" src="{{ asset('ahmedsaba7.png') }}">
                </div>
        </div>
        <div class="row printHeader" style="margin-bottom: 10px;display: none;">
            <div class="col-md-12 text-center">
                <h4>@yield('title')</h4>
            </div>


        </div>
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    @include('backend.layouts._partial.footer')

</div>
<!-- ./wrapper -->
@include('backend.layouts._partial.script')
</body>
</html>
