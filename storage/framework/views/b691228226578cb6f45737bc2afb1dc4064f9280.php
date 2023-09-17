<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="row">


        <div class="form-group col-md-4">
            <label>التاريخ:</label>
            <div class="input-group date" id="startAtDate" data-target-input="nearest">
                <input autocomplete="off" required value="<?php echo e(old('date')?old('date'):$record->date??''); ?>" name="date" type="text" class="form-control" data-target="#startAtDate" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#startAtDate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label>البطولة</label>
            <select required class="form-control normalselect2" name="championship_id">
                <?php $__currentLoopData = \App\Models\Championship::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $champ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php echo e($record->championship_id==$champ->id?'selected':''); ?> value="<?php echo e($champ->id); ?>"><?php echo e($champ->name); ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>الدرجة</label>
            <select id="groupList" required name="group_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                <?php $__currentLoopData = App\Models\Group::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($item->id==$record->group_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>النادى الأول</label>
            <select id="clubone" required name="club1_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                <?php $__currentLoopData = App\Models\Family::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($item->id==$record->club1_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>النادى الثانى</label>
            <select id="clubtwo" required name="club2_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                <?php $__currentLoopData = App\Models\Family::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option  <?php echo e($item->id==$record->club2_id?'selected':''); ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>لاعبين النادى الاول  </label>
            <select id="playerOne" required data-url="<?php echo e(route('backend.getPlayerList')); ?>" class="form-control player1select2">
                <?php if(isset($player) && !empty($player)): ?>
                    <option selected value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>لاعبين النادى الثانى  </label>
            <select id="playerTwo" required data-url="<?php echo e(route('backend.getPlayerList')); ?>" class="form-control player2select2">
                <?php if(isset($player) && !empty($player)): ?>
                    <option selected value="<?php echo e($player->id); ?>"><?php echo e($player->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الكود</th>
                        <th>اللاعب</th>
                        <th>العملية</th>
                    </tr>
                </thead>
                <tbody id="Players1ListSelected">
                    <?php if(isset($selectedPlayers1) && !empty($selectedPlayers1)): ?>
                    <?php $__currentLoopData = $selectedPlayers1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="tr<?php echo e($u->id); ?>">
                            <td>
                                <input type="hidden" name="players1[]" value="<?php echo e($u->id); ?>">
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td><?php echo e($u->id); ?></td>
                            <td><?php echo e($u->code.' - '.$u->name); ?></td>
                            <td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>م</th>
                        <th>اللاعب</th>
                        <th>العملية</th>
                    </tr>
                </thead>
                <tbody id="Players2ListSelected">
                    <?php if(isset($selectedPlayers2) && !empty($selectedPlayers2)): ?>
                    <?php $__currentLoopData = $selectedPlayers2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="tr<?php echo e($u->id); ?>">
                            <td>
                                <input type="hidden" name="players2[]" value="<?php echo e($u->id); ?>">
                                <?php echo e($loop->iteration); ?>

                            </td>
                            <td><?php echo e($u->id); ?></td>
                            <td><?php echo e($u->code.' - '.$u->name); ?></td>
                            <td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="form-group col-md-4">
            <label>المرحلة السنية</label>
            <input required name="level" type="text" class="form-control" value="<?php echo e($record->level??''); ?>">
        </div>
        <div class="form-group col-md-4">
            <label>نوع المبارة</label>
            <input required name="type" type="text" class="form-control" value="<?php echo e($record->type??''); ?>">
        </div>
        <div class="form-group col-md-4">
            <label>رقم الاسكور شيت</label>
            <input required name="score_sheet_num" type="text" class="form-control" value="<?php echo e($record->score_sheet_num??''); ?>">
        </div>
        <div class="form-group col-md-6">
            <label>اسم المسجل</label>
            <input required name="registrar_name" type="text" class="form-control" value="<?php echo e($record->registrar_name??''); ?>">
        </div>
        <div class="form-group col-md-6">
            <label>اسم مساعد المسجل</label>
            <input required name="registrar_assistant" type="text" class="form-control" value="<?php echo e($record->registrar_assistant??''); ?>">
        </div>
        <div class="form-group col-md-6">
            <label>اسم الميقاتى</label>
            <input required name="timer" type="text" class="form-control" value="<?php echo e($record->timer??''); ?>">
        </div>
        <div class="form-group col-md-6">
            <label>اسم ميقاتى 24</label>
            <input required name="timer24" type="text" class="form-control" value="<?php echo e($record->timer24??''); ?>">
        </div>

        <div class="form-group col-md-6">
            <label>الحكم الاول</label>
            <select required data-url="<?php echo e(route('backend.getRefereeList')); ?>" class="form-control select2" name="referee1_id">
                <?php if(isset($record->ref1) && !empty($record->ref1)): ?>
                    <option selected value="<?php echo e($record->ref1->id); ?>"><?php echo e($record->ref1->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الثانى</label>
            <select required data-url="<?php echo e(route('backend.getRefereeList')); ?>" class="form-control select2" name="referee2_id">
                <?php if(isset($record->ref2) && !empty($record->ref2)): ?>
                    <option selected value="<?php echo e($record->ref2->id); ?>"><?php echo e($record->ref2->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الثالث</label>
            <select required data-url="<?php echo e(route('backend.getRefereeList')); ?>" class="form-control select2" name="referee3_id">
                <?php if(isset($record->ref3) && !empty($record->ref3)): ?>
                    <option selected value="<?php echo e($record->ref3->id); ?>"><?php echo e($record->ref3->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الرابع</label>
            <select required data-url="<?php echo e(route('backend.getRefereeList')); ?>" class="form-control select2" name="referee4_id">
                <?php if(isset($record->ref4) && !empty($record->ref4)): ?>
                    <option selected value="<?php echo e($record->ref4->id); ?>"><?php echo e($record->ref4->name); ?></option>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>ملاحظات</label>
        <textarea rows="5" class="form-control" name="note"><?php echo e(old('note')?old('note'):(isset($record)?$record->note:'')); ?></textarea>
    </div>
    <div class="form-group">
        <label for="Logo">مرفقات</label>
        <div class="input-group">
            <div class="custom-file">
                <input name="image" type="file" class="custom-file-input" id="Logo">
                <label class="custom-file-label" for="Logo">إختر الملف</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">رفع</span>
            </div>
        </div>
        <?php if(optional($record->getFirstMedia('images'))->getUrl()): ?>
            <div class="row">
                <div class="mt-2 col-md-2 imageContainer">
                    <a href="<?php echo e(optional($record->getFirstMedia('images'))->getUrl()); ?>" target="_blank">
                        <img width="100px" src="<?php echo e(optional($record->getFirstMedia('images'))->getUrl()); ?>"/>
                    </a>
                    <a class="btn btn-danger btn-sm deleteImg" rel="<?php echo e(optional($record->getFirstMedia('images'))->id); ?>" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php $__env->startPush('js'); ?>
        <script>
            $('.date').datetimepicker({
                format: 'YYYY-MM'
            });
            $('.select2').select2({
                ajax: {
                    url: function () {
                        return $(this).attr('data-url');
                    },
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                    minimumInputLength: 1,
                }
            });
            $('.normalselect2').select2();

            $('.player1select2').select2({
                allowClear: true,
                placeholder: "إختر لاعبين النادى الاول",
                ajax: {
                    url: function () {
                        return $(this).attr('data-url');
                    },
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term,
                            club_id:$('#clubone').val(),
                            group_id:$('#groupList').val(),
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                    width:"100%",
                }
            }).on('change',function(){
                var selectedVal = $("#playerOne option:selected").val();
                if(!selectedVal) return false;
                var counter = $("#Players1ListSelected tr").length+1;
                var selectedText = $("#playerOne option:selected").text();
                if(!$(".tr"+selectedVal).length)
                    $("#Players1ListSelected").append('<tr class="tr'+selectedVal+'"><td><input type="hidden" name="players1[]" value="'+selectedVal+'">'+counter+'</td><td>'+selectedVal+'</td><td>'+selectedText+'</td><td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td></tr>');
            });

            $('.player2select2').select2({
                allowClear: true,
                placeholder: "إختر لاعبين النادى الثانى",
                ajax: {
                    url: function () {
                        return $(this).attr('data-url');
                    },
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term,
                            club_id:$('#clubtwo').val(),
                            group_id:$('#groupList').val(),
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true,
                    width:"100%",
                }
            }).on('change',function(){
                var selectedVal = $("#playerTwo option:selected").val();
                if(!selectedVal) return false;
                var counter = $("#Players2ListSelected tr").length+1;

                var selectedText = $("#playerTwo option:selected").text();
                if(!$(".tr"+selectedVal).length)
                    $("#Players2ListSelected").append('<tr class="tr'+selectedVal+'"><td><input type="hidden" name="players2[]" value="'+selectedVal+'">'+counter+'</td><td>'+selectedVal+'</td><td>'+selectedText+'</td><td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td></tr>');
            });

            $(document).on("click",".btn-danger",function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                var counter = $("#Players1ListSelected tr").length+1;
                $(".countbtn").html("Selected Count= "+counter);
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php /**PATH D:\xampp\htdocs\Alshamel-kba\resources\views/backend/matches/_form.blade.php ENDPATH**/ ?>