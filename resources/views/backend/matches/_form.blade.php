<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="row">


        <div class="form-group col-md-4">
            <label>التاريخ:</label>
            <div class="input-group date" id="startAtDate" data-target-input="nearest">
                <input autocomplete="off" required value="{{old('date')?old('date'):$record->date??''}}" name="date" type="text" class="form-control" data-target="#startAtDate" data-toggle="datetimepicker"/>
                <div class="input-group-append" data-target="#startAtDate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label>البطولة</label>
            <select required class="form-control normalselect2" name="championship_id">
                @foreach (\App\Models\Championship::get() as $champ)
                    <option {{ $record->championship_id==$champ->id?'selected':'' }} value="{{$champ->id}}">{{$champ->name }} </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>الدرجة</label>
            <select id="groupList" required name="group_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Group::get() as $item)
                        <option  {{$item->id==$record->group_id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>النادى الأول</label>
            <select id="clubone" required name="club1_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Family::get() as $item)
                        <option  {{$item->id==$record->club1_id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>النادى الثانى</label>
            <select id="clubtwo" required name="club2_id" class="form-control normalselect2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Family::get() as $item)
                        <option  {{$item->id==$record->club2_id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>لاعبين النادى الاول  </label>
            <select id="playerOne" required data-url="{{route('backend.getPlayerList')}}" class="form-control player1select2">
                @if(isset($player) && !empty($player))
                    <option selected value="{{$player->id}}">{{$player->name}}</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>لاعبين النادى الثانى  </label>
            <select id="playerTwo" required data-url="{{route('backend.getPlayerList')}}" class="form-control player2select2">
                @if(isset($player) && !empty($player))
                    <option selected value="{{$player->id}}">{{$player->name}}</option>
                @endif
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
                    @if(isset($selectedPlayers1) && !empty($selectedPlayers1))
                    @foreach ($selectedPlayers1 as $u)
                        <tr class="tr{{ $u->id }}">
                            <td>
                                <input type="hidden" name="players1[]" value="{{$u->id}}">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{$u->id}}</td>
                            <td>{{$u->code.' - '.$u->name}}</td>
                            <td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    @endif
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
                    @if(isset($selectedPlayers2) && !empty($selectedPlayers2))
                    @foreach ($selectedPlayers2 as $u)
                        <tr class="tr{{ $u->id }}">
                            <td>
                                <input type="hidden" name="players2[]" value="{{$u->id}}">
                                {{ $loop->iteration }}
                            </td>
                            <td>{{$u->id}}</td>
                            <td>{{$u->code.' - '.$u->name}}</td>
                            <td><a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="form-group col-md-4">
            <label>المرحلة السنية</label>
            <input required name="level" type="text" class="form-control" value="{{$record->level??''}}">
        </div>
        <div class="form-group col-md-4">
            <label>نوع المبارة</label>
            <input required name="type" type="text" class="form-control" value="{{$record->type??''}}">
        </div>
        <div class="form-group col-md-4">
            <label>رقم الاسكور شيت</label>
            <input required name="score_sheet_num" type="text" class="form-control" value="{{$record->score_sheet_num??''}}">
        </div>
        <div class="form-group col-md-6">
            <label>اسم المسجل</label>
            <input required name="registrar_name" type="text" class="form-control" value="{{$record->registrar_name??''}}">
        </div>
        <div class="form-group col-md-6">
            <label>اسم مساعد المسجل</label>
            <input required name="registrar_assistant" type="text" class="form-control" value="{{$record->registrar_assistant??''}}">
        </div>
        <div class="form-group col-md-6">
            <label>اسم الميقاتى</label>
            <input required name="timer" type="text" class="form-control" value="{{$record->timer??''}}">
        </div>
        <div class="form-group col-md-6">
            <label>اسم ميقاتى 24</label>
            <input required name="timer24" type="text" class="form-control" value="{{$record->timer24??''}}">
        </div>

        <div class="form-group col-md-6">
            <label>الحكم الاول</label>
            <select required data-url="{{route('backend.getRefereeList')}}" class="form-control select2" name="referee1_id">
                @if(isset($record->ref1) && !empty($record->ref1))
                    <option selected value="{{$record->ref1->id}}">{{$record->ref1->name}}</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الثانى</label>
            <select required data-url="{{route('backend.getRefereeList')}}" class="form-control select2" name="referee2_id">
                @if(isset($record->ref2) && !empty($record->ref2))
                    <option selected value="{{$record->ref2->id}}">{{$record->ref2->name}}</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الثالث</label>
            <select required data-url="{{route('backend.getRefereeList')}}" class="form-control select2" name="referee3_id">
                @if(isset($record->ref3) && !empty($record->ref3))
                    <option selected value="{{$record->ref3->id}}">{{$record->ref3->name}}</option>
                @endif
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>الحكم الرابع</label>
            <select required data-url="{{route('backend.getRefereeList')}}" class="form-control select2" name="referee4_id">
                @if(isset($record->ref4) && !empty($record->ref4))
                    <option selected value="{{$record->ref4->id}}">{{$record->ref4->name}}</option>
                @endif
            </select>
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
    @endpush
