
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>تعديل البيانات</h1>
            </div>
            <div class="col-sm-6">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-tabs">
                    <form action="{{route('backend.admins.update',$record->id)}}" method="post">
                        <div class="card-body">
                            @csrf
                            {{ method_field('PUT')  }}
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">الأسم</label>
                                    <input value="{{old('name')?old('name'):(isset($record)?$record->name:'')}}" name="name" type="name" class="form-control" id="name" placeholder="Enter Name" required>
                                </div>
                                <input name="role" type="hidden" value="{{$record->first_role->name}}">
                                <div class="form-group col-md-6">
                                    <label for="email">البريد الألكترونى</label>
                                    <input value="{{old('email')?old('email'):isset($record)?$record->email:''}}" name="email" type="email" class="form-control" id="email" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">كلمة السر</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password"  minlength="6">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
