<div class="form-group">
    <label for="name">الاسم</label>
    <input type="text" class="form-control" id="name" name="name" value=" {{ $record->name }}" required>
</div>
<div class="form-group">
    <label for="selectAll">إختر الكل</label>
    <input type="checkbox" id="selectAll">
</div>
@if(count($permissions))
    @foreach( string_grouping($permissions) as $permission_base_name => $permission_data)
        @if(is_array($permission_data))
            <div class="form-group rowItem">
                <div class="col-xs-12">
                    <input id="{{ $permission_base_name }}" type="checkbox" class="selectAllItems">
                    <label for="{{ $permission_base_name }}" >{{ trans('front.'.$permission_base_name) }}</label>
                </div>
                <div class="row">
                    @foreach( $permission_data as $permission_value => $permission_name)
                        @if(!empty($permission_name))
                            <div class="col-md-2">
                                <input type="checkbox" name="permissions[]" value="{{ $permission_value }}" id="{{$permission_value}}" @if($record->hasPermissionTo($permission_value)) checked @endif >
                                <label for="{{$permission_value}}">{{trans('front.'.$permission_name)}}</label>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        @else
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="{{$permission_base_name}}">{{$permission_data}}</label>
                    <input type="checkbox" name="permissions[]" value="{{ $permission_base_name }}" id="{{$permission_base_name}}" @if($record->hasPermissionTo($permission_base_name)) checked @endif >
                </div>
            </div>
        @endif
        <br>
        <br>
    @endforeach

@endif
@push('js')
    <script>
        var checkboxes_status = [];
        $("input[type=checkbox]").each(function(){
            checkboxes_status[$(this).attr('id')] = $(this).is(':checked');
        });
        $("#selectAll").change(function(){
            if( $(this).is(":checked") ){
                $("input[type=checkbox]").prop('checked',true);
            }else{
                $("input[type=checkbox]").each(function(){
                    $(this).prop('checked',checkboxes_status[$(this).attr('id')]);
                });
            }
        });
        $(".selectAllItems").change(function(){
            var row = $(this).closest('.rowItem');
            if( $(this).is(":checked") ){
                row.find("input[type=checkbox]").prop('checked',true);
            }else{
                row.find("input[type=checkbox]").each(function(){
                    $(this).prop('checked',false);
                });
            }
        });

    </script>
@endpush
