<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="form-group">
            <label for="name">الاسم</label>
            <input required value="{{old('name')?old('name'):(isset($record)?$record->name:'')}}" name="name" type="name" class="form-control" id="name" placeholder="أكتب الأسم">
        </div>
        <div class="form-group">
            <label>الجنس</label>
            <select required name="gender" class="form-control">
                <option  {{$record->gender=='رجالى'?'selected':''}} value="رجالى">رجالى</option>
                <option  {{$record->gender=='نسائى'?'selected':''}} value="نسائى">نسائى</option>
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
            @if(optional($record->getFirstMedia('profile'))->getUrl())
                <div class="row">
                    <div class="mt-2 col-md-2 imageContainer">
                        <a href="{{optional($record->getFirstMedia('profile'))->getUrl()}}" target="_blank">
                            <img width="100px" src="{{optional($record->getFirstMedia('profile'))->getUrl()}}"/>
                        </a>
                        <a class="btn btn-danger btn-sm deleteImg" rel="{{ optional($record->getFirstMedia('profile'))->id }}" href="#"><i class="fa fa-trash close_button"></i></a>
                    </div>
                </div>
            @endif

            @include('backend.layouts._partial.img')

            @include('backend.layouts._partial.file')
        </div>
    </div>
</div>
