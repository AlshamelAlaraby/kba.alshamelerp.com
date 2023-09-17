<div class="col-md-12">
    <div id="imgList" class="row">
        <div class="col-md-12">
            <a style="margin-top: 10px;" id="AddImg" class="btn btn-success" href="#"><i class="fa fa-plus"></i> أضف صورة </a>
        </div>

        @foreach($record->getMedia('images') as $m)
        @php
        $type = $m->getCustomProperty('type');
        $note = $m->getCustomProperty('note');
        $date = $m->getCustomProperty('date');
        @endphp
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>قاموس الصور</label>
            <select  name="type[]" class="form-control">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\ImgLookup::get() as $item)
                        <option  {{$item->name==$type?'selected':''}} value="{{$item->name}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>البيان</label>
            <input type="text" value="{{ $note }}" name="note[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
            <label>التاريخ</label>
            <input type="date" value="{{ $date }}" name="date[]" class="form-control">
        </div>
        <div class="form-group col-md-3 img{{ $m->id }}">
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
                    <a href="{{$m->getUrl()}}" target="_blank">
                        <img width="100px" src="{{$m->getUrl()}}"/>
                    </a>
                    <a style="position: absolute;bottom:0" class="btn btn-danger btn-sm deleteImg" rel="{{ $m->id }}" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

