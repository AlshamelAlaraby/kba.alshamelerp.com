<div class="form-group">
    <label for="name">الاسم</label>
    <input value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="name" class="form-control" id="name" placeholder="Enter Name" required>
</div>
<div class="form-group">
    <label for="email">البريد الالكترونى</label>
    <input value="<?php echo e(old('email')?old('email'):(isset($record)?$record->email:'')); ?>" name="email" type="email" class="form-control" id="email" placeholder="Enter Email" required>
</div>
<div class="form-group">
    <label for="password">كلمة السر</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password"  minlength="6">
</div>
<div class="form-group">
    <label for="Role">الصلاحية</label>
    <select class="form-control" id="Role" name="role">
        <option value="">--- إختر الصلاحية ---</option>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($role); ?>" <?php echo e($record->first_role->name == $role ? 'selected="selected"':''); ?> > <?php echo e($role); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/admins/_form.blade.php ENDPATH**/ ?>