<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="form-group">
            <label for="name">الاسم</label>
            <input required value="<?php echo e(old('name')?old('name'):(isset($record)?$record->name:'')); ?>" name="name" type="name" class="form-control" id="name" placeholder="أكتب الأسم">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>عدد اللاعبين المفعلين</label>
                    <input required value="<?php echo e(old('active_num')?old('active_num'):(isset($record)?$record->active_num:'')); ?>" name="active_num" type="number" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>عدد الاعبين الذين يمكن تصعيدهم</label>
                    <input required value="<?php echo e(old('esclation_num')?old('esclation_num'):(isset($record)?$record->esclation_num:'')); ?>" name="esclation_num" type="number" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/groups/_form.blade.php ENDPATH**/ ?>