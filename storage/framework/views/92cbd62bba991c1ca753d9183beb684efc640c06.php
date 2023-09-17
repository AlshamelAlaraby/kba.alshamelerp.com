<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php echo $__env->yieldPushContent('datatables'); ?>

<!-- daterangepicker -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/moment/moment.min.js"></script>
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Toastr -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/backend')); ?>/dist/js/adminlte.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?php echo e(asset('assets/backend')); ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('assets/backend')); ?>/dist/js/demo.js"></script>
<?php echo $__env->yieldPushContent('js'); ?>
<script>
    <?php if(session()->has('alert-success')): ?>
    toastr.success("<?php echo e(session('alert-success')); ?>");
    <?php elseif(session()->has('alert-danger')): ?>
    toastr.error("<?php echo e(session('alert-danger')); ?>");
    <?php endif; ?>

    $('.datePickerInput').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $(document).on("click",".deleteRecord",function(e){
        e.preventDefault();
        var element = $(this);
        var tableId = element.closest('table').attr('id');
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من التراجع عن هذا!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'لا',
            confirmButtonText: 'نعم ، احذفها!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: element.data('action'),
                    type: 'DELETE',
                    data: {_token: "<?php echo e(csrf_token()); ?>"},
                    success: function () {
                        if(tableId==undefined){
                            location.reload();
                        }else{
                            var table = $("#"+tableId).DataTable();
                            table.row( element.closest('tr') ).remove().draw();
                        }

                        Swal.fire(
                            'نجحت العملية!',
                            'تم الحذف بنجاح',
                            'success'
                        )
                    }
                });
            }
        });
    });
    $(document).on('click','button[type="submit"]',function (e) {
        e.preventDefault();
        var errorFound = false;
        if($(".card-tabs").length) {
            $('input,select').each(function () {
                var attr = $(this).attr('required');
                if (typeof attr !== 'undefined' && attr !== false) {
                    if(!$(this).val()){
                        errorFound = true;
                        $(this).addClass('isrequired');
                        $(this).parent('div.form-group').find('.select2-container--default').addClass('isrequired');
                    }else{
                        $(this).removeClass('isrequired');
                        $(this).parent('div.form-group').find('.select2-container--default').removeClass('isrequired');
                    }
                }
                if($(".isrequired").length){
                    $(".isrequired:first").focus();
                }
            });
        }
        if(!errorFound){
            $(this).closest('form').submit();
        }
    });
    heigligtMenu();
    function heigligtMenu(){
        var current = window.location.href;
        current = current.replace(/\/$/, "");
        $("ul.nav-sidebar a.active").removeClass('active');
        $('a[href="'+current+'"]').closest('.has-treeview').addClass('menu-open');
        $('a[href="'+current+'"]').closest('.has-treeview').find(".nav-link:first").addClass('active');
        $('a[href="'+current+'"]').addClass('active');
    }
    $(document).on('click','.remoteModal',function(e) {
        e.preventDefault();
        // reset modal body with a spinner or empty content
        spinner = "<div class='text-center'><i class='fa fa-spinner fa-spin fa-5x fa-fw'></i></div>"
        var url = $(this).attr('href');
        $("#remoteModal .modal-body").html(spinner)
        $("#remoteModal .modal-body").load(url);
        $("#remoteModal").modal("show");
    });
    $(document).on('click',".deleteImg",function(e){
        e.preventDefault();
        var mediaId = $(this).attr('rel');
        var parent = $(this).closest('.imageContainer');
        parent.closest('form').append('<input type="hidden" value="'+mediaId+'" class="form-control" name="mediaTodelete[]">');
        parent.fadeOut();
        if($(".img"+mediaId).length){
            $(".img"+mediaId).remove();
        }
    });
    $(document).on('click','#AddImg',function(e) {
        e.preventDefault();
        var cloneDiv = $("#imgContainer .imgItem").clone();
        $("#imgList").append(cloneDiv);
    });
    $(document).on('click','#AddFile',function(e) {
        e.preventDefault();
        var cloneDiv = $("#fileContainer .imgItem").clone();
        $("#fileList").append(cloneDiv);
    });
    $(document).on('click','.removeImg',function(e) {
        e.preventDefault();
        $(this).closest('.imgItem').remove();
    });

</script>
<div id="imgContainer" style="display: none">
    <div class="col-md-12 imgItem">
        <div class="row">
            <div class="form-group col-md-3">
                <label>قاموس الصور</label>
                <select name="type[]" class="form-control">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\ImgLookup::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>البيان</label>
                <input type="text" name="note[]" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>التاريخ</label>
                <input type="date" name="date[]" class="form-control">
            </div>
            <div class="form-group col-md-3">
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
            </div>
        </div>
        <a style=" position: absolute; left: 0; top: 32px;" class="btn btn-xs btn-danger removeImg" href="#">-</a>
    </div>
</div>
<div id="fileContainer" style="display: none">
    <div class="col-md-12 imgItem">
        <div class="row">
            <div class="form-group col-md-3">
                <label>قاموس الملفات</label>
                <select name="type2[]" class="form-control">
                    <option value="">--- إختر ---</option>
                    <?php $__currentLoopData = App\Models\ImgLookup::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->name); ?>"><?php echo e($item->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>البيان</label>
                <input type="text" name="note2[]" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>التاريخ</label>
                <input type="date" name="date2[]" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="images">الملف</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="files[]" type="file" class="custom-file-input" multiple id="images">
                        <label class="custom-file-label" for="Logo">إختر الملف</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">رفع</span>
                    </div>
                </div>
            </div>
        </div>
        <a style=" position: absolute; left: 0; top: 32px;" class="btn btn-xs btn-danger removeImg" href="#">-</a>
    </div>
</div>
<?php /**PATH /home/alshemvf/kba.alshamelerp.com/resources/views/backend/layouts/_partial/script.blade.php ENDPATH**/ ?>