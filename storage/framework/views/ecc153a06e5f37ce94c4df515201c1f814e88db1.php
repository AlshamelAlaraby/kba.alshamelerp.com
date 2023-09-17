
<div class="modal fade" id="<?php echo e($id ?? 'importExcel'); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e($route); ?>" method="post" enctype="multipart/form-data" >
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Import Excel File </h4>
                </div>
                <div class="modal-body">
                    <?php if(!empty($fields)): ?>
                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="form-group">
                                <label for="<?php echo e($field['label']); ?>"> <?php echo e($field['label']); ?> </label>
                                <?php if($field['type'] == 'select'): ?>
                                    <select name="<?php echo e($field['name']); ?>" id="<?php echo e($field['label']); ?>" class="form-control">
                                        <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <?php else: ?>
                                    <input type="<?php echo e($field['type'] ?? 'text'); ?>" name="<?php echo e($field['name']); ?>" id="<?php echo e($field['label']); ?>"  class="form-control">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="ExcelFileInput"> Select File </label>
                        <?php echo csrf_field(); ?>
                        <input type="file" id="ExcelFileInput" name="file" accept=".xlsx, .xls" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH D:\xampp\htdocs\Alshamel-kba\resources\views/backend/layouts/_partial/import.blade.php ENDPATH**/ ?>