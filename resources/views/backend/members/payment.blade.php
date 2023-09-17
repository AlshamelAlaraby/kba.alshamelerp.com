@extends('backend.layouts.app')
@section('title','تجديد الاشتراك')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تجديد الاشتراك</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('backend.members.index') }}">الأعضاء</a></li>
                        <li class="breadcrumb-item active">دفع</li>
                    </ol>
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
                        
                        <form enctype="multipart/form-data" action="{{route('backend.members.addPayment')}}" method="post">
                            <div class="card-body row">
                                {{ csrf_field() }}
                                
                                <div class="form-group col-md-6">
                                    <label>إختر العضو</label>
                                    <select required name="member_id" class="form-control membersList select2">
                                        <option value="">--- إختر ---</option>
                                        @foreach(App\Models\Member::get() as $mem)
                                                <option end_date = "{{ $mem->end_date }}" category_id="{{ $mem->category_id }}"  value="{{$mem->id}}">{{$mem->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>توع العضويه</label>
                                    <select disabled name="category_id" class="form-control catList">
                                        <option value="">--- إختر ---</option> 
                                        @foreach(App\Modules\Category\Models\Category::whereNull('parent_id')->get() as $parent)
                                            <optgroup label="{{$parent->name}}">
                                                
                                                @foreach ($parent->descendants as $category)
                                                <option renew_price="{{ $category->renew_price }}" monthes="{{ $category->monthes }}" rel="{{ $category->value }}"  {{$category->id==$member->category_id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                          </optgroup>
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">تاريخ الدفع</label>
                                    <input autocomplete="off" required value="{{ date('Y-m-d') }}" name="paid_at" type="date" class="form-control" >
                                </div>

                                <div class="form-group col-md-6">
                                    <label>رقم الايصال</label>
                                    <input autocomplete="off" required value="" name="note" type="text" class="form-control" placeholder="أكتب رقم الإيصال">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date">تاريخ البدايه</label>
                                    <input readonly id="paidfrom"  autocomplete="off" required value="{{ $from }}" name="start_date" type="date" class="form-control" >
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="date">تاريخ الانتهاء</label>
                                    <input id="paidto"  autocomplete="off" required value="{{ $to }}" name="end_date" type="date" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label>المبلغ المطلوب سداده</label>
                                    <input id="paidValue" readonly autocomplete="off" required value="{{ $totalValue }}" name="value" type="text" class="form-control"  placeholder="أكتب المبلغ">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>طريقة الدفع</label>
                                    <select required name="payment_id" class="form-control select2">
                                        <option value="">--- إختر ---</option>
                                        @foreach(App\Models\Payment::get() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Logo">الصور</label>
                                    
                                    <div class="custom-file">
                                        <input multiple name="images[]" type="file" class="custom-file-input" id="Logo">
                                        <label class="custom-file-label" for="Logo">إختار المرفقات</label>
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

            @if(count($member->transactions))
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-0 pt-1">
                                <h3 class="card-title">
                                    سجل النشاطات
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="clientSideDataTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>رقم الايصال</th>
                                            <th>تاريخ الدفع</th>
                                            <th>طريقة الدفع</th>
                                            <th>المبلغ</th>
                                            <th>الصور</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($member->transactions as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->note}}</td>
                                                <td>{{$item->paid_at}}</td>
                                                <td>{{optional($item->payment)->name}}</td>
                                                <td>{{$item->value}}</td>
                                                <td>
                                                    <div class="row">
                                                        @foreach($item->getMedia('images') as $m)
                                                            <div class="mt-2 col-md-2">
                                                                <a href="{{$m->getUrl()}}" target="_blank">
                                                                    <img width="100px" src="{{$m->getUrl()}}"/>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            
        </div>
    </section>
@endsection
@push('js')
<script>
    $(".select2").select2();

    $(document.body).on("change",".membersList",function(){
        var selectedOption  = $('option:selected', this);
        var end_date = selectedOption.attr('end_date'); 
        var category_id = selectedOption.attr('category_id'); 
        $(".catList").val(category_id);
        var renew_price  = $('option:selected', '.catList').attr('renew_price');
        var monthes  = $('option:selected', '.catList').attr('monthes');
        $("#paidfrom").val(end_date);
        var start_date = new Date();
        var from_date = new Date(end_date);
        var toDate = new Date(start_date.setMonth(start_date.getMonth()+parseInt(monthes)));
        $("#paidto").val(formatDate(toDate));
        var diff = monthDiff(from_date,toDate);

        totalValue = (parseInt(renew_price) / parseInt(monthes)) * parseInt(diff) ;
        $("#paidValue").val(totalValue);
        
    });
    function getTotalValue(){
        var end_date  = $('option:selected', '.membersList').attr('end_date');
        var renew_price  = $('option:selected', '.catList').attr('renew_price');
        var monthes  = $('option:selected', '.catList').attr('monthes');
        var from_date = new Date(end_date);
        var toDate = new Date($("#paidto").val());
        var diff = monthDiff(from_date,toDate);
        totalValue = (parseInt(renew_price) / parseInt(monthes)) * parseInt(diff) ;
        $("#paidValue").val(totalValue);
    }
    $("#paidto").change(function () {
        getTotalValue();
    });

    $("#paidto").keypress(function (e) {
        $(this).off('change blur');

        $(this).blur(function () {
            getTotalValue();
        });

        if (e.keyCode === 13) {
            getTotalValue();
            return false;
        }
    });
    
    function stringToDate(_date,_format,_delimiter)
    {
                var formatLowerCase=_format.toLowerCase();
                var formatItems=formatLowerCase.split(_delimiter);
                var dateItems=_date.split(_delimiter);
                var monthIndex=formatItems.indexOf("mm");
                var dayIndex=formatItems.indexOf("dd");
                var yearIndex=formatItems.indexOf("yyyy");
                var month=parseInt(dateItems[monthIndex]);
                month-=1;
                var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
                return formatedDate;
    }
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function monthDiff(d1, d2) {
        var months;
        months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth();
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
    }

</script>
@endpush
