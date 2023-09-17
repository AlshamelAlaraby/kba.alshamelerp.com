<div class="col-md-12">
    <div id="imgList" class="row">
        <div class="col-md-12">
            <a style="margin-top: 10px;" id="AddImg" class="btn btn-success" href="#"><i class="fa fa-plus"></i> أضف صورة </a>
        </div>

        <?php $__currentLoopData = $record->getMedia('images'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $type = $m->getCustomProperty('type');
        $note = $m->getCustomProperty('note');
        $date = $m->getCustomProperty('date');
        ?>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>قاموس الصور</label>
            <select  name="type[]" class="form-control">
                <option value="">--- إختر ---</option>
                <?php $__currentLoopData = App\Models\ImgLookup::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($item->name==$type?'selected':''); ?> value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>البيان</label>
            <input type="text" value="<?php echo e($note); ?>" name="note[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label>التاريخ</label>
            <input type="date" value="<?php echo e($date); ?>" name="date[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img<?php echo e($m->id); ?>">
            <label for="images">الصورة</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="images[]" type="file" class="custom-file-input" multiple id="images">
                    <label class="custom-file-label" for="Logo">إختر الصورة</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">رفع</span>
                </div>
            </div>
            <div class="row">
                <div class="mt-2 col-md-2 imageContainer">
                    <a href="<?php echo e($m->getUrl()); ?>" target="_blank">
                        <img width="100px" src="<?php echo e($m->getUrl()); ?>"/>
                    </a>
                    <a style="position: absolute;bottom:0" class="btn btn-danger btn-sm deleteImg" rel="<?php echo e($m->id); ?>" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/layouts/_partial/img.blade.php ENDPATH**/ ?>