<?php $__env->startSection('title','قائمة بيانات اللاعبين'); ?>
<?php $__env->startSection('content'); ?>
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
                    <?php echo $__env->make('backend.reports._filter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->stopSection(); ?>
<script>
    var pageUrl = "<?php echo e(route('backend.members.getMembersReport')); ?>";
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
<?php echo $__env->make('backend.layouts._partial.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startPush('css'); ?>
<style>
    @page  {
        @bottom-left {
            content: counter(page) ' of ' counter(pages);
        }
    }
</style>
<?php $__env->stopPush(); ?>



<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/reports/members.blade.php ENDPATH**/ ?>