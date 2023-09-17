@extends('backend.layouts.app')
@section('title','تصعيد اللاعبين')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>التصعيد</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">التصعيد</li>
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
                                <a title="إضافة سجل جديد" href="{{route('backend.escalations.create')}}" class="btn btn-success btn btn-sm"><i class="fa fa-plus"></i> جديد</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="clientSideDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم اللاعب</th>
                                        <th>النادى</th>
                                        <th>تصعيد من</th>
                                        <th>تصعيد إلى</th>
                                        <th>تاريخ التصعيد</th>
                                        <th>الحالة</th>
                                        <th>ملحوظة</th>
                                        <th class="no-sort">العملية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{optional($item->player)->name}}</td>
                                            <td>{{optional($item->player)->family->name}}</td>
                                            <td>{{optional($item->from)->name}}</td>
                                            <td>{{optional($item->to)->name}}</td>
                                            <td>{{$item->date}}</td>
                                            <td>{{$item->status}}</td>
                                            <td>{{$item->note}}</td>
                                            <td>
                                                <a title="تعديل" href="{{route('backend.escalations.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a title="حذف" href="#" data-action="{{route('backend.escalations.destroy',$item->id)}}" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
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