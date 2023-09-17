<div style="margin-top: 10px;margin-bottom: 10px;" class="col-md-12">
    <div id="fileList" class="row">
        <div class="col-md-12">
            <a id="AddFile" class="btn btn-success" href="#"><i class="fa fa-plus"></i> أضف ملف </a>
        </div>

        @foreach($record->getMedia('files') as $m)
        @php
            $type = $m->getCustomProperty('type');
            $note = $m->getCustomProperty('note');
            $date = $m->getCustomProperty('date');
        @endphp
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>قاموس الملفات</label>
            <select name="type2[]" class="form-control">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\ImgLookup::get() as $item)
                        <option  {{$item->name==$type?'selected':''}} value="{{$item->name}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>البيان</label>
            <input type="text" value="{{ $note }}" name="note2[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>التاريخ</label>
            <input type="date" value="{{ $date }}" name="date2[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
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
                    <a class="btn btn-warning"  href="{{$m->getUrl()}}" target="_blank">
                        <i class="fa fa-eye"></i>
                        ملف #{{ $loop->iteration }}
                    </a>
                    <a class="btn btn-danger btn-sm deleteImg" rel="{{ $m->id }}" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

