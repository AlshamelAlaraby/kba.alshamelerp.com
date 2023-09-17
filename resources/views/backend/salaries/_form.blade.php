<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="row">
            <div class="form-group col-md-12">
                <label>التاريخ:</label>
                <div class="input-group date" id="startAtDate" data-target-input="nearest">
                    <input autocomplete="off" required value="{{old('date')?old('date'):$record->date??''}}" name="date" type="text" class="form-control" data-target="#startAtDate" data-toggle="datetimepicker"/>
                    <div class="input-group-append" data-target="#startAtDate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            @php
                $levelList = ['دولي','أولي','ثانية','ثالثة'];
                $typeList = ['مراقبة','أرضي','طاولة'];
            @endphp
            <div class="form-group col-md-6">
                <label>الدرجة</label>
                <select required class="form-control" name="level">
                    @foreach ($levelList as $level)
                        <option {{ $record->level==$level?'selected':'' }} value="{{$level}}">{{$level}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>النوع</label>
                <select required class="form-control" name="type">
                    @foreach ($typeList as $type)
                        <option {{ $record->type==$type?'selected':'' }} value="{{$type}}">{{$type}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="name">المبلغ</label>
                <input required value="{{old('value')?old('value'):(isset($record)?$record->value:'')}}" name="value" type="number" class="form-control">
            </div>
        </div>
    </div>
</div>


@push('js')
<script>
    $('.date').datetimepicker({
        format: 'YYYY-MM'
    });
</script>
@endpush

