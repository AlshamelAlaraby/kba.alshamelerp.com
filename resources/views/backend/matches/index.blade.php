@extends('backend.layouts.app')
@section('title','المباريات')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>المباريات</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">المباريات</li>
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
                                <a title="إضافة سجل جديد" href="{{route('backend.matches.create')}}" class="btn btn-success btn btn-sm"><i class="fa fa-plus"></i> جديد</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="clientSideDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>التاريخ</th>
                                        <th>الاسكور شيت</th>
                                        <th>البطولة</th>
                                        <th>المرحلة </th>
                                        <th>نوع المبارة</th>
                                        <th>اسم المسجل</th>
                                        <th>مساعد المسجل</th>
                                        <th>ح اول</th>
                                        <th>ح ثان</th>
                                        <th>ح ثالث</th>
                                        <th>ح رابع</th>
                                        <th class="no-sort">العملية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->date}}</td>
                                            <td>{{$item->score_sheet_num}}</td>
                                            <td>{{optional($item->championship)->name}}</td>
                                            <td>{{$item->level}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->registrar_name}}</td>
                                            <td>{{$item->registrar_assistant}}</td>
                                            <td>{{optional($item->ref1)->name}}</td>
                                            <td>{{optional($item->ref2)->name}}</td>
                                            <td>{{optional($item->ref3)->name}}</td>
                                            <td>{{optional($item->ref4)->name}}</td>
                                            <td>
                                                <a title="تعديل" href="{{route('backend.matches.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a title="حذف" href="#" data-action="{{route('backend.matches.destroy',$item->id)}}" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
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
