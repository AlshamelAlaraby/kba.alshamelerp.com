<?php
namespace App\Http\Controllers\Backend;
use App\Models\Setting;
use Illuminate\Http\Request;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends BaseController
{



    public function index()
    {
        $settingsData = Setting::get();
        return view('backend.settings.edit', compact('settingsData'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method','') as $key => $setting) {
            if($key=='logo' && $request->hasFile('logo'))
            {
                $file = $request->file('logo');
                $filename = 'logo'.'.'.$file->getClientOriginalExtension();
                $file->storeAs('logo',$filename,'public');
                $setting = $filename;
            }
            Setting::where('key', $key)->update(['value' => $setting]);
        }

        $request->session()->flash('alert-success', 'تم تعديلات الاعدادات');

        return back()->withInput();
    }
    public function deleteLogo()
    {
        Storage::delete(Setting::findByKey('logo'));
        Setting::where('key','logo')->update(['value'=>null]);
        return back();
    }

}
