<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="row">
        <div class="form-group col-md-4">
            <label>اللاعب</label>
            <select required data-url="{{route('backend.getPlayerList')}}" class="form-control ajaxSelect2" name="player_id">
                @if(isset($player) && !empty($player))
                    <option selected value="{{$player->id}}">{{$player->name}}</option>
                @endif
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>تصعيد إلى</label>
            <select required class="form-control select2" name="to_id">
                @foreach (\App\Models\Group::get() as $group)
                    <option {{ $record->to_id==$group->id?'selected':'' }} value="{{$group->id}}">{{$group->name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>تاريخ التصعيد:</label>
            <div class="input-group date" id="startAtDate" data-target-input="nearest">
                <input required value="{{old('date')?old('date'):$record->date??''}}" name="date" type="text" class="form-control" data-target="#startAtDate" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#startAtDate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>ملاحظات</label>
        <textarea rows="5" class="form-control" name="note">{{old('note')?old('note'):(isset($record)?$record->note:'')}}</textarea>
    </div>
    @push('js')
        <script>
            $('.date').datetimepicker({
                format: 'DD-MM-YYYY'
            });
            $('.select2').select2();
            $('.ajaxSelect2').select2({
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
