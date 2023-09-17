<div class="tab-content" id="custom-tabs-one-tabContent">
    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
        <div class="form-group">
            <label for="name">الاسم</label>
            <input required value="{{old('name')?old('name'):(isset($record)?$record->name:'')}}" name="name" type="name" class="form-control" id="name" placeholder="أكتب الأسم">
        </div>
    </div>
</div>
