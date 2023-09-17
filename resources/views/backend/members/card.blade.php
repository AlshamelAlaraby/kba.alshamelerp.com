<tr>
    <td><span class="text-bold">الجنسية:</span> {{ optional($record->nationality)->name }}</td>
    <td><span class="text-bold">النادى:</span> {{ optional($record->family)->name }}</td>
    <td><span class="text-bold">اللقب:</span> {{ optional($record->category)->name }}</td>
    <td><span class="text-bold">الهاتف1:</span> {{ $record->mobile1 }}</td>
    <td><span class="text-bold">الايميل:</span> {{ $record->email }}</td>

    <td><span class="text-bold">التشكيل:</span> {{ optional($record->region)->name }}</td>
    <td><span class="text-bold">الحاله:</span> {{ optional($record->status)->name }}</td>
</tr>
<tr>
    <td><span class="text-bold">تاريخ الميلاد:</span> {{ $record->birth_date }}</td>
    <td><span class="text-bold">تاريخ التسجيل:</span> {{ $record->register_date }}</td>
</tr>
<tr>
    <td><span class="text-bold">الرقم المدنى:</span> {{ $record->idnum }}</td>
    <td><span class="text-bold">ت انتهاء الرقم المدنى:</span> {{ $record->idnum_expirerd_date }}</td>
    <td><span class="text-bold">جواز السفر:</span> {{ $record->passport }}</td>
</tr>
<tr>
</tr>
<tr>
    <td colspan="4"><span class="text-bold">الموسم:</span> {{ optional($record->session)->name }}</td>
</tr>
