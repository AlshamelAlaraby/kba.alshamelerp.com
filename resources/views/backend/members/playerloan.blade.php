<table id="clientSideDataTable" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>اسم اللاعب</th>
            <th>النادى الاصلى</th>
            <th>النادى المعار إليه</th>
            <th>الفترة من</th>
            <th>الفترة إلى</th>
            <th>رقم الملف</th>
            <th>ملحوظة</th>
            <th class="no-sort">العملية</th>
        </tr>
    </thead>
    <tbody>
        @foreach($record->loans as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{optional($item->player)->name}}</td>
                <td>{{optional($item->from)->name}}</td>
                <td>{{optional($item->to)->name}}</td>
                <td>{{$item->start}}</td>
                <td>{{$item->end}}</td>
                <td>{{$item->filenumber}}</td>
                <td>{{$item->note}}</td>
                <td>
                    <a title="تعديل" href="{{route('backend.loans.edit',$item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <a title="حذف" href="#" data-action="{{route('backend.loans.destroy',$item->id)}}" class="btn btn-danger deleteRecord btn-sm"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
