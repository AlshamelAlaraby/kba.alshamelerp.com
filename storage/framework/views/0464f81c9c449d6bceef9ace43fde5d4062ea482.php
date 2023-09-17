<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="row">
            <div class="form-group col-md-4 required">
                <label for="name">الاسم</label>
                <input autocomplete="off" required value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="text" class="form-control required" id="name" placeholder="">
            </div>
            <div class="form-group col-md-4 required">
                <label>رقم البطاقة</label>
                <?php
                    $maxNum = App\Models\Member::max('code') + 1;
                ?>
                <input value="<?php echo e($record->code??$maxNum); ?>" name="code" type="text" class="form-control">
            </div>
            <div style="display: none;" class="form-group col-md-3 ">
                <label>رقم اللاعب</label>
                <input autocomplete="off" value="<?php echo e(old('playernum')?old('playernum'):(isset($record)?$record->playernum:'')); ?>" name="playernum" type="text" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>رقم الهاتف 1</label>
                <input autocomplete="off" value="<?php echo e(old('mobile1')?old('mobile1'):(isset($record)?$record->mobile1:'')); ?>" name="mobile1" type="text" class="form-control">
            </div>
            <div style="display: none;" class="form-group col-md-4">
                <label>رقم الهاتف 2</label>
                <input autocomplete="off" value="<?php echo e(old('mobile2')?old('mobile2'):(isset($record)?$record->mobile2:'')); ?>" name="mobile2" type="text" class="form-control">
            </div>
            <div class="form-group col-md-4 required">
                <label>الرقم المدنى</label>
                <input required autocomplete="off" value="<?php echo e(old('idnum')?old('idnum'):(isset($record)?$record->idnum:'')); ?>" name="idnum" type="text" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>تاريخ انتهاء الرقم المدنى </label>
                <div class="input-group date datePickerInput" id="date1" data-target-input="nearest">
                    <input autocomplete="off" name="idnum_expirerd_date" value="<?php echo e(old('idnum_expirerd_date')?old('idnum_expirerd_date'):(isset($record)?$record->idnum_expirerd_date:'')); ?>" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date1"/>
                    <div class="input-group-append" data-target="#date1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label>رقم جواز السفر</label>
                <input autocomplete="off" value="<?php echo e(old('passport')?old('passport'):(isset($record)?$record->passport:'')); ?>" name="passport" type="text" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label>تاريخ انتهاء جواز السفر</label>
                <div class="input-group date datePickerInput" id="date2" data-target-input="nearest">
                    <input autocomplete="off" name="passport_expirerd_date" value="<?php echo e(old('passport_expirerd_date')?old('passport_expirerd_date'):(isset($record)?$record->passport_expirerd_date:'')); ?>" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date2"/>
                    <div class="input-group-append" data-target="#date2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label>تاريخ الميلاد</label>
                <div class="input-group date datePickerInput" id="date3" data-target-input="nearest">
                    <input autocomplete="off" name="birth_date" value="<?php echo e(old('birth_date')?old('birth_date'):(isset($record)?$record->birth_date:'')); ?>" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date3"/>
                    <div class="input-group-append" data-target="#date3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label>تاريخ التسجيل</label>
                <div class="input-group date datePickerInput" id="date4" data-target-input="nearest">
                    <input autocomplete="off" name="register_date" value="<?php echo e(old('register_date')?old('register_date'):(isset($record)?$record->register_date:'')); ?>" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#date4"/>
                    <div class="input-group-append" data-target="#date4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4 required">
                <label>اللقب</label>
                <select required name="category_id" class="form-control select2 required">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Modules\Category\Models\Category::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($category->id==$record->category_id?'selected':''); ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-4 required">
                <label>النادى</label>
                <select required name="family_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Family::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->family_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-4 required">
                <label>حالة اللعب</label>
                <select required name="status_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Status::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->status_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>التشكيل</label>
                <select name="region_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Region::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->region_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3 required">
                <label>الجنسية</label>
                <select required name="nationality_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Nationality::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->nationality_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3 required">
                <label>درجة اللاعب</label>
                <select required name="group_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Group::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->group_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3 required">
                <label>الجنس</label>
                <select required name="gender" class="form-control required">
                    <option  <?php echo e($record->gender=='ذكر'?'selected':''); ?> value="ذكر">ذكر</option>
                    <option  <?php echo e($record->gender=='أنثى'?'selected':''); ?> value="أنثى">أنثى</option>
                </select>
            </div>
            <div class="form-group col-md-12 required">
                <label>الموسم</label>
                <select required  name="session_id" class="form-control select2">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\Session::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option  <?php echo e($item->id==$record->session_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label>ملاحظات</label>
                <textarea rows="5" class="form-control" name="membernote"><?php echo e(old('note')?old('note'):(isset($record)?$record->note:'')); ?></textarea>
            </div>
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
<?php $__env->startPush('css'); ?>
    <style>
        .form-group.required label:after {
            color: #d00;
            content: "*";
            position: absolute;
            margin-right: 5px;
            top:5px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('js'); ?>
    <script>
        $(".select2").select2();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\Alshamel-kba\resources\views/backend/members/_form.blade.php ENDPATH**/ ?>