@extends('backend.layouts.app')
@section('title','اعارة اللاعبين')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>الاعارات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">الاعارات</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header p-0 pt-1">
                            <h3 class="card-title">
                                <a title="إضافة سجل جديد" href="{{route('backend.loans.create')}}" class="btn btn-success btn btn-sm"><i class="fa fa-plus"></i> جديد</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="clientSideDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم اللاعب</th>
                                        <th>النادى الاصلى</th>
                                        <th>النادى المعار إليه</th>
                                        <th>الفترة من</th>
                                        <th>الفترة إلى</th>
                                        <th>رقم الملف</th>
                                        <th>ملحوظة</th>
                                        <th class="no-sort">العملية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{optional($item->player)->name}}</td>
                                            <td>{{optional($item->from)->name}}</td>
                                            <td>{{optional($item->to)->name}}</td>
                                            <td>{{$item->start}}</td>
                                            <td>{{$item->end}}</td>
                                            <td>{{$item->filenumber}}</td>
                                            <td>{{$item->note}}</td>
                                            <td>
                                                <a title="تعديل" href="{{route('backend.loans.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a title="حذف" href="#" data-action="{{route('backend.loans.destroy',$item->id)}}" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@include('backend.layouts._partial.datatables')
