@extends('backend.layouts.app')
@section('title','قائمة بيانات اللاعبين')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>اللاعبين</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">اللاعبين</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.reports._filter')
                    <div class="card">
                        <div class="card-header p-0 pt-1">
                            <h3 class="card-title">
                                تقرير اللاعبين
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <input type="hidden" id="playerCount" value=""/>
                            <table id="serverSideDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>رقم البطاقة</th>
                                        <th>الرقم المدنى</th>
                                        <th>تاريخ الميلاد</th>
                                        <th>تاريخ التسجيل</th>
                                        <th>الجنسية</th>
                                        <th>اللقب</th>
                                        <th>النادى</th>
                                        <th>درجة اللاعب</th>
                                        <th>الحاله</th>
                                        <th>التشكيل</th>
                                        <th>الموسم</th>
                                        <th>ملاحظات</th>
                                        <th class="no-sort">العملية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
<script>
    var pageUrl = "{{route('backend.members.getMembersReport')}}";
    var columns =  [];
    columns.push(
        {data: "id", name: "id"},
        {data: "name", name: "name"},
        {data: "code", name: "code"},
        {data: "idnum", name: "idnum"},
        {data: "birth_date", name: "birth_date"},
        {data: "register_date", name: "register_date"},
        {data: "nationality.name", name: "nationality.name"},
        {data: "category.name", name: "category.name"},
        {data: "cfamily", name: "cfamily"},
        {data: "group.name", name: "group.name"},
        {data: "status.name", name: "status.name"},
        {data: "regionName", name: "region.name"},
        {data: "sessionName", name: "session.name"},
        {data: "note", name: "note"},
        {data:'actions',name:'actions', orderable: false, searchable: false}
    );
</script>
@include('backend.layouts._partial.datatables')
@push('css')
<style>
    @page {
        @bottom-left {
            content: counter(page) ' of ' counter(pages);
        }
    }
</style>
@endpush


