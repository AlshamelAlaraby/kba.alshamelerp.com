@extends('backend.layouts.app')
@section('title','لوحة التحكم')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            @php 
              $bg = ['bg-info','bg-success','bg-warning','bg-danger','bg-primary'];
              $no = count($bg);

            @endphp
            @foreach($summery as $status)
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                  <span class="info-box-icon {{ $bg[$loop->iteration % $no] }} elevation-1"><i class="fas fa-user"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">{{ $status->title }}</span>
                    <span class="info-box-number">
                      {{ $status->count }}
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
            @endforeach
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
