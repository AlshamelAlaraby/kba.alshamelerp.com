<div class="row">
<?php $__currentLoopData = $settingsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($setting->key=="logo"): ?>
        <div class="form-group col-md-12">
            <label for="Logo">اللوجو</label>

            <div class="custom-file">
                <input name="logo" type="file" class="custom-file-input" id="Logo">
                <label class="custom-file-label" for="Logo">إختار اللوجو</label>
            </div>

            <div class="mt-2">
                <?php if($setting->value): ?>
                    <div class="pull-left">
                        <img style="width: 150px;" src="<?php echo e(\Illuminate\Support\Facades\Storage::disk('public')->url('logo/'.$setting->value)); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="form-group col-md-6">
            <label for="<?php echo e($setting->key); ?>"><?php echo e($setting->name); ?></label>
            <input type="text" class="form-control" id="<?php echo e($setting->key); ?>"
                name="<?php echo e($setting->key); ?>" value="<?php echo e(old($setting->key,$setting->value)); ?>">
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/settings/_form.blade.php ENDPATH**/ ?>