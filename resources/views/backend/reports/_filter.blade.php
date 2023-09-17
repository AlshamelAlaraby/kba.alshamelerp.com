<form action="">
    <div class="row">
        <div class="form-group col-md-4">
            <label>اللقب</label>
            <select id="Category" name="category_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Modules\Category\Models\Category::get() as $category)
                    @if($category->id==request('category_id'))
                        @section('Category','اللقب: '.$category->name)
                    @endif
                    <option  {{$category->id==request('category_id')?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>النادى</label>
            <select id="Family"  name="family_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Family::get() as $item)
                    @if($item->id==request('family_id'))
                        @section('Family','النادى: '.$item->name)
                    @endif
                    <option  {{$item->id==request('family_id')?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>حالة اللاعب</label>
            <select id="Status" name="status_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Status::get() as $item)
                    @if($item->id==request('status_id'))
                        @section('Status','حالة اللاعب: '.$item->name)
                    @endif
                        <option  {{$item->id==request('status_id')?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>التشكيل</label>
            <select  id="Region" name="region_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Region::get() as $item)
                    @if($item->id==request('region_id'))
                        @section('Region','التشكيل: '.$item->name)
                    @endif
                        <option  {{$item->id==request('region_id')?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>الجنسية</label>
            <select id="Nationality" name="nationality_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Nationality::get() as $item)
                    @if($item->id==request('nationality_id'))
                        @section('Nationality','الجنسية: '.$item->name)
                    @endif
                        <option  {{$item->id==request('nationality_id')?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>درجة اللاعب</label>
            <select id="Group" name="group_id" class="form-control select2">
                <option value="">--- إختر ---</option>
                @foreach(App\Models\Group::get() as $item)
                    @if($item->id==request('group_id'))
                        @section('Group','درجة اللاعب: '.$item->name)
                    @endif
                    <option  {{$item->id==request('group_id')?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
     </div>
     <button type="submit" class="btn btn-success">بحث</button>
</form>
@push('js')
    <script>
        $(".select2").select2({width:"100%"});
    </script>
@endpush
@push('css')

    <style>
       @media print {
                table{
                    max-width: 100%!important;
                }
                .printHeader{
                    display: block!important;
                }
                .table-bordered{
                    margin-bottom: 0px!important;
                }
                a[href]:after {
                    content: none !important;
                }
                .main-footer,.dt-buttons,.dataTables_filter{
                    display: none ;
                }

                #footer{visibility: visible;}
                a{
                    visibility:hidden;
                }
                .box{
                    border-top:none!important;
                }
                .table {
                    border: 1px solid #020202 !important;
                }
                .table td,.table th {
                    border: 1px solid #020202 !important;
                }
                @media print {
                    .printHeader{
                        display: block!important;
                    }
                    table  {
                        font-size: 14px !important;
                        page-break-after:auto;
                    }
                    tr    { page-break-inside:avoid; page-break-after:auto }
                    td    { page-break-inside:avoid; page-break-after:auto }
                    thead { display:table-header-group;page-break-inside: avoid; }
                    tfoot { display:table-footer-group }



                    body  {
                    padding-top: 72px;
                    padding-bottom: 72px ;
                    }
                    .panel-default{
                        border: none;
                    }
                    .hideprint{
                        visibility:hidden;
                        margin:0;
                    }
                }
                .dataTables_length,.box-tools,.dataTables_info,.table.dataTable thead .sorting:after,.table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after
                {
                    display: none!important;
                }
                .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
                    text-align: center;
                }
                a[href]:after {
                    content: none !important;
                }
                @page {
                    size: A4;
                    margin-top: 5mm;
                    margin-bottom: 3mm;
                    margin-left: 5mm;
                    margin-right: 5mm;
                    /* background-image: url('../../images/logo_small.png'); */
                    /* background-repeat: no-repeat;
                    background-position: 40px 10px; */
                    @bottom-center {
                        content: counter(page) ' of ' counter(pages);
                    }
                }
                html, body {
                    height:max-content;
                    width: 100vh;
                    margin: 0 !important;
                    padding: 0 !important;
                }

            }
        </style>
@endpush
