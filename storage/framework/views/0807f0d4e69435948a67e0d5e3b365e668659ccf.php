<div class="form-group">
    <label>الاسم</label>
    <input required value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="text" class="form-control"  placeholder="الاسم">
</div>
<div class="form-group">
    <label for="parent">الفئة الرئيسية</label>
    <select name="parent_id" class="form-control select2">
        <option value="">--- الرئيسية ---</option>
        <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($record->id!=$category->id): ?>
                <option  <?php echo e($category->id==$record->parent_id?'selected':''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="form-group">
    <label>رسوم التجديد</label>
    <input value="<?php echo e(old('renew_price')?old('renew_price'):isset($record)?$record->renew_price:''); ?>" name="renew_price" step="any" type="number" class="form-control">
</div>
<div class="form-group">
    <label>المدة بالشهور</label>
    <input value="<?php echo e(old('monthes')?old('monthes'):isset($record)?$record->monthes:''); ?>" name="monthes" step="any" type="number" class="form-control">
</div>
<?php $__env->startPush('js'); ?>
    <script>
        $(".select2").select2();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/category/_form.blade.php ENDPATH**/ ?>