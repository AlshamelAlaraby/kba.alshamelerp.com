<div style="margin-top: 10px;margin-bottom: 10px;" class="col-md-12">
    <div id="fileList" class="row">
        <div class="col-md-12">
            <a id="AddFile" class="btn btn-success" href="#"><i class="fa fa-plus"></i> أضف ملف </a>
        </div>

        <?php $__currentLoopData = $record->getMedia('files'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $type = $m->getCustomProperty('type');
            $note = $m->getCustomProperty('note');
            $date = $m->getCustomProperty('date');
        ?>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>قاموس الملفات</label>
            <select name="type2[]" class="form-control">
                <option value="">--- إختر ---</option>
                <?php $__currentLoopData = App\Models\ImgLookup::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($item->name==$type?'selected':''); ?> value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>البيان</label>
            <input type="text" value="<?php echo e($note); ?>" name="note2[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>التاريخ</label>
            <input type="date" value="<?php echo e($date); ?>" name="date2[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label for="images">المف</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="files[]" type="file" class="custom-file-input" multiple id="images">
                    <label class="custom-file-label" for="Logo">إختر الصورة</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">رفع</span>
                </div>
            </div>
            <div class="row">
                <div class="mt-2 col-md-12 imageContainer">
                    <a class="btn btn-warning"  href="<?php echo e($m->getUrl()); ?>" target="_blank">
                        <i class="fa fa-eye"></i>
                        ملف #<?php echo e($loop->iteration); ?>

                    </a>
                    <a class="btn btn-danger btn-sm deleteImg" rel="<?php echo e($m->id); ?>" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/layouts/_partial/file.blade.php ENDPATH**/ ?>