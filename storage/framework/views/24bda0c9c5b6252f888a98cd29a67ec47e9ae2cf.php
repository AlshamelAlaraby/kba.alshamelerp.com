<div class="form-group">
    <label for="name">الاسم</label>
    <input type="text" class="form-control" id="name" name="name" value=" <?php echo e($record->name); ?>" required>
</div>
<div class="form-group">
    <label for="selectAll">إختر الكل</label>
    <input type="checkbox" id="selectAll">
</div>
<?php if(count($permissions)): ?>
    <?php $__currentLoopData = string_grouping($permissions); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_base_name => $permission_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_array($permission_data)): ?>
            <div class="form-group rowItem">
                <div class="col-xs-12">
                    <input id="<?php echo e($permission_base_name); ?>" type="checkbox" class="selectAllItems">
                    <label for="<?php echo e($permission_base_name); ?>" ><?php echo e(trans('front.'.$permission_base_name)); ?></label>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $permission_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission_value => $permission_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!empty($permission_name)): ?>
                            <div class="col-md-2">
                                <input type="checkbox" name="permissions[]" value="<?php echo e($permission_value); ?>" id="<?php echo e($permission_value); ?>" <?php if($record->hasPermissionTo($permission_value)): ?> checked <?php endif; ?> >
                                <label for="<?php echo e($permission_value); ?>"><?php echo e(trans('front.'.$permission_name)); ?></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        <?php else: ?>
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="<?php echo e($permission_base_name); ?>"><?php echo e($permission_data); ?></label>
                    <input type="checkbox" name="permissions[]" value="<?php echo e($permission_base_name); ?>" id="<?php echo e($permission_base_name); ?>" <?php if($record->hasPermissionTo($permission_base_name)): ?> checked <?php endif; ?> >
                </div>
            </div>
        <?php endif; ?>
        <br>
        <br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php endif; ?>
<?php $__env->startPush('js'); ?>
    <script>
        var checkboxes_status = [];
        $("input[type=checkbox]").each(function(){
            checkboxes_status[$(this).attr('id')] = $(this).is(':checked');
        });
        $("#selectAll").change(function(){
            if( $(this).is(":checked") ){
                $("input[type=checkbox]").prop('checked',true);
            }else{
                $("input[type=checkbox]").each(function(){
                    $(this).prop('checked',checkboxes_status[$(this).attr('id')]);
                });
            }
        });
        $(".selectAllItems").change(function(){
            var row = $(this).closest('.rowItem');
            if( $(this).is(":checked") ){
                row.find("input[type=checkbox]").prop('checked',true);
            }else{
                row.find("input[type=checkbox]").each(function(){
                    $(this).prop('checked',false);
                });
            }
        });

    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/roles/_form.blade.php ENDPATH**/ ?>