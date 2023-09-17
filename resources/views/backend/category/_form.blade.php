<div class="form-group">
    <label>الاسم</label>
    <input required value="{{old('name')?old('name'):(isset($record)?$record->name:'')}}" name="name" type="text" class="form-control"  placeholder="الاسم">
</div>
<div class="form-group">
    <label for="parent">الفئة الرئيسية</label>
    <select name="parent_id" class="form-control select2">
        <option value="">--- الرئيسية ---</option>
        @foreach($categoryList as $category)
            @if($record->id!=$category->id)
                <option  {{$category->id==$record->parent_id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
            @endif
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>رسوم التجديد</label>
    <input value="{{old('renew_price')?old('renew_price'):isset($record)?$record->renew_price:''}}" name="renew_price" step="any" type="number" class="form-control">
</div>
<div class="form-group">
    <label>المدة بالشهور</label>
    <input value="{{old('monthes')?old('monthes'):isset($record)?$record->monthes:''}}" name="monthes" step="any" type="number" class="form-control">
</div>
@push('js')
    <script>
        $(".select2").select2();
    </script>
@endpush
