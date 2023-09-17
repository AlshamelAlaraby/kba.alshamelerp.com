<div class="form-group">
    <label for="name">الاسم</label>
    <input value="{{old('name')?old('name'):(isset($record)?$record->name:'')}}" name="name" type="name" class="form-control" id="name" placeholder="Enter Name" required>
</div>
<div class="form-group">
    <label for="email">البريد الالكترونى</label>
    <input value="{{old('email')?old('email'):(isset($record)?$record->email:'')}}" name="email" type="email" class="form-control" id="email" placeholder="Enter Email" required>
</div>
<div class="form-group">
    <label for="password">كلمة السر</label>
    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Password"  minlength="6">
</div>
<div class="form-group">
    <label for="Role">الصلاحية</label>
    <select class="form-control" id="Role" name="role">
        <option value="">--- إختر الصلاحية ---</option>
        @foreach($roles as $role)
            <option value="{{$role}}" {{ $record->first_role->name == $role ? 'selected="selected"':'' }} > {{$role}} </option>
        @endforeach
    </select>
</div>
