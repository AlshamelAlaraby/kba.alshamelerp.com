<?php if(empty($subMenus)): ?>
<li class="nav-item">
    <a href="<?php echo e($link); ?>" class="nav-link">
        <i class="<?php echo e($iconClass); ?>"></i>
        <p>
            <?php echo e($title); ?>

        </p>
    </a>
</li>
<?php else: ?>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="<?php echo e($iconClass); ?>"></i>
        <p>
            <?php echo e($title); ?>

            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <?php $__currentLoopData = $subMenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item">
                <a href="<?php echo e($m['link']); ?>" class="nav-link">
                    <i class="<?php echo e($m['iconClass']); ?>"></i>
                    <p><?php echo e($m['title']); ?></p>
                </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</li>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\Alshamel-kba\resources\views/backend/layouts/_partial/menuItem.blade.php ENDPATH**/ ?>