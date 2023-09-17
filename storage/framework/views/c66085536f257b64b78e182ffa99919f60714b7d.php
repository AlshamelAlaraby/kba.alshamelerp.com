<!DOCTYPE html>
<html>
<?php echo $__env->make('backend.layouts._partial.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
        <?php echo $__env->make('backend.layouts._partial.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
        <?php echo $__env->make('backend.layouts._partial.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="row printHeader" style="margin-bottom: 20px;display: none;">
                <div class="col-md-3">
                    <img style="max-width: 100%;float: right;" src="<?php echo e(asset('logo.png')); ?>">
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
                    <img class="rounded-circle" style="width: 150px;float: left;" src="<?php echo e(asset('ahmedsaba7.png')); ?>">
                </div>
        </div>
        <div class="row printHeader" style="margin-bottom: 10px;display: none;">
            <div class="col-md-12 text-center">
                <h4><?php echo $__env->yieldContent('title'); ?></h4>
            </div>


        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.content-wrapper -->
    <?php echo $__env->make('backend.layouts._partial.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<!-- ./wrapper -->
<?php echo $__env->make('backend.layouts._partial.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/layouts/app.blade.php ENDPATH**/ ?>