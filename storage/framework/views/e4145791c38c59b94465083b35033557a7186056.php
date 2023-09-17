<nav class="main-header navbar navbar-expand navbar-secondary navbar-light">
    <!-- Left navbar links -->


    <!-- SEARCH FORM -->
    <div class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <h4><?php echo e($settings['name']??''); ?></h4>
        </div>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" style="position: absolute; left: 0px;">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a data-toggle="modal" class="nav-link remoteModal" href="<?php echo e(route('backend.admins.edit',auth()->user()->id)); ?>">
                <i class="fa fa-user"></i> حسابى
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="<?php echo e(route('backend.auth.logout')); ?>">
                <i class="fa fa-sign-out-alt"></i> تسجيل خروج
            </a>
        </li>
    </ul>
</nav>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/layouts/_partial/navbar.blade.php ENDPATH**/ ?>