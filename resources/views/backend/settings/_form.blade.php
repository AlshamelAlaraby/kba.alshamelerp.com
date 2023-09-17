<div class="row">
@foreach($settingsData as $setting)
    @if($setting->key=="logo")
        <div class="form-group col-md-12">
            <label for="Logo">اللوجو</label>

            <div class="custom-file">
                <input name="logo" type="file" class="custom-file-input" id="Logo">
                <label class="custom-file-label" for="Logo">إختار اللوجو</label>
            </div>

            <div class="mt-2">
                @if($setting->value)
                    <div class="pull-left">
                        <img style="width: 150px;" src="{{\Illuminate\Support\Facades\Storage::disk('public')->url('logo/'.$setting->value)}}">
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="form-group col-md-6">
            <label for="{{ $setting->key  }}">{{ $setting->name }}</label>
            <input type="text" class="form-control" id="{{ $setting->key  }}"
                name="{{ $setting->key  }}" value="{{ old($setting->key,$setting->value)  }}">
        </div>
    @endif
@endforeach
</div>
