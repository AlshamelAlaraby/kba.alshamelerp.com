<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="form-group">
            <label for="name">الاسم</label>
            <input required value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="name" class="form-control" id="name" placeholder="أكتب الأسم">
        </div>
        <div class="form-group">
            <label>الجنس</label>
            <select required name="gender" class="form-control">
                <option  <?php echo e($record->gender=='رجالى'?'selected':''); ?> value="رجالى">رجالى</option>
                <option  <?php echo e($record->gender=='نسائى'?'selected':''); ?> value="نسائى">نسائى</option>
            </select>
        </div>
        <div class="form-group">
            <label for="Logo">اللوجو</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="profile" type="file" class="custom-file-input" id="Logo">
                    <label class="custom-file-label" for="Logo">إختر الملف</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">رفع</span>
                </div>
            </div>
            <?php if(optional($record->getFirstMedia('profile'))->getUrl()): ?>
                <div class="row">
                    <div class="mt-2 col-md-2 imageContainer">
                        <a href="<?php echo e(optional($record->getFirstMedia('profile'))->getUrl()); ?>" target="_blank">
                            <img width="100px" src="<?php echo e(optional($record->getFirstMedia('profile'))->getUrl()); ?>"/>
                        </a>
                        <a class="btn btn-danger btn-sm deleteImg" rel="<?php echo e(optional($record->getFirstMedia('profile'))->id); ?>" href="#"><i class="fa fa-trash close_button"></i></a>
                    </div>
                </div>
            <?php endif; ?>

            <?php echo $__env->make('backend.layouts._partial.img', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('backend.layouts._partial.file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/family/_form.blade.php ENDPATH**/ ?>