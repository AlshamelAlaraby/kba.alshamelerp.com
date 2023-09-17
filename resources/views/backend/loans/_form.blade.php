<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="row">
        <div class="form-group col-md-6">
            <label>اللاعب</label>
            <select required data-url="{{route('backend.getPlayerList')}}" class="form-control select2" name="player_id">
                @if(isset($player) && !empty($player))
                    <option selected value="{{$player->id}}">{{$player->name}}</option>
                @endif
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>النادى المعار إليه</label>
            <select required data-url="{{route('backend.getClubList')}}" class="form-control select2" name="to_id">
                @if(isset($clubto) && !empty($clubto))
                    <option selected value="{{$clubto->id}}">{{$clubto->name }} </option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-12">
            <label>رقم الملف</label>
            <input required name="filenumber" type="text" class="form-control" value="{{$record->filenumber??''}}">
        </div>
        <div class="form-group col-md-6">
            <label>الفترة من:</label>
            <div class="input-group date" id="startAtDate" data-target-input="nearest">
                <input required value="{{old('start')?old('start'):$record->start_date??''}}" name="start" type="text" class="form-control" data-target="#startAtDate" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#startAtDate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>الفترة إلى:</label>
            <div class="input-group date" id="endAtDate" data-target-input="nearest">
                <input required value="{{old('end')?old('end'):$record->end_date??''}}" name="end" type="text" class="form-control" data-target="#endAtDate" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#endAtDate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>ملاحظات</label>
        <textarea rows="5" class="form-control" name="note">{{old('note')?old('note'):(isset($record)?$record->note:'')}}</textarea>
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
        @if(optional($record->getFirstMedia('images'))->getUrl())
            <div class="row">
                <div class="mt-2 col-md-2 imageContainer">
                    <a href="{{optional($record->getFirstMedia('images'))->getUrl()}}" target="_blank">
                        <img width="100px" src="{{optional($record->getFirstMedia('images'))->getUrl()}}"/>
                    </a>
                    <a class="btn btn-danger btn-sm deleteImg" rel="{{ optional($record->getFirstMedia('images'))->id }}" href="#"><i class="fa fa-trash close_button"></i></a>
                </div>
            </div>
        @endif
    </div>
    @push('js')
        <script>
            $('.date').datetimepicker({
                format: 'DD-MM-YYYY'
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
        </script>
    @endpush
