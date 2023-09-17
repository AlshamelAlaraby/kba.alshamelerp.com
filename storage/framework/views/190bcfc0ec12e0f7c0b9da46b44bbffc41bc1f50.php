<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="name">الاسم</label>
                <input required value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="text" class="form-control"  placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>درجة الحكم</label>
                <select required name="degree_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Degree::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->degree_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="display: none;" class="form-group col-md-4">
                <label for="name">الدرجه</label>
                <input value="<?php echo e(old('degree')?old('degree'):(isset($record)?$record->degree:'')); ?>" name="degree" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>الرقم المدنى</label>
                <input required value="<?php echo e(old('idnum')?old('idnum'):(isset($record)?$record->idnum:'')); ?>" name="idnum" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>الحساب البنكى</label>
                <input required value="<?php echo e(old('account_number')?old('account_number'):(isset($record)?$record->account_number:'')); ?>" name="account_number" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>IBAN</label>
                <input required value="<?php echo e(old('iban')?old('iban'):(isset($record)?$record->iban:'')); ?>" name="iban" type="text" class="form-control" placeholder="">
            </div>
            <div class="form-group col-md-4">
                <label>البنك</label>
                <select required name="bank_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Bank::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->bank_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group col-md-12">
                <label>الكود</label>
                <input required value="<?php echo e(old('code')?old('code'):(isset($record)?$record->code:'')); ?>" name="code" type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="Logo">الصورة الشخصية</label>
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
            </div>

            <?php echo $__env->make('backend.layouts._partial.img', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('backend.layouts._partial.file', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php /**PATH D:\xampp\htdocs\Alshamel-kba\resources\views/backend/refrees/_form.blade.php ENDPATH**/ ?>