<?php $__env->startSection('title','النادى'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>النادى</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                        <li class="breadcrumb-item active">النادى</li>
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
                                <a title="إضافة سجل جديد" href="<?php echo e(route('backend.family.create')); ?>" class="btn btn-success btn btn-sm"><i class="fa fa-plus"></i> جديد</a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="clientSideDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>اللوجو</th>
                                        <th class="no-sort">العملية</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td>
                                                <?php if(optional($item->getFirstMedia('profile'))->getUrl()): ?>
                                                    <a href="<?php echo e(optional($item->getFirstMedia('profile'))->getUrl()); ?>" target="_blank">
                                                        <img width="100px" src="<?php echo e(optional($item->getFirstMedia('profile'))->getUrl()); ?>"/>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a title="تعديل" href="<?php echo e(route('backend.family.edit',$item->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                                <a title="حذف" href="#" data-action="<?php echo e(route('backend.family.destroy',$item->id)); ?>" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts._partial.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/family/index.blade.php ENDPATH**/ ?>