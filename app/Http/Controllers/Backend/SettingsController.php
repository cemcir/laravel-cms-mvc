<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        $data['adminSettings'] = Settings::all()->sortBy('settings_must');
        return view('backend.settings.index', compact('data'));
    }

    public function sortable()
    {
//        print_r($_POST['item']);

        foreach ($_POST['item'] as $key => $value) {
            $settings = Settings::find(intval($value));
            $settings->settings_must = intval($key);
            $settings->save();
        }

        echo true;
    }

    public function destroy($id)
    {
        $settings = Settings::find($id);
        $file_name='images/settings/'.$settings->settings_value;
        if ($settings->delete()) {
            @unlink($file_name);
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }

    public function edit($id)
    {
        $settings=Settings::where('id',$id)->first();
        return view('backend.settings.edit')->with('settings',$settings);
    }

    public function update(Request $request,$id)
    {
        $setting=$request->except('_token');

        $old_file=Settings::where('id','=',$id)->first()->settings_value;
        if ($request->hasFile('settings_value'))
        {
            $request->validate([
                'settings_value' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name=uniqid().'.'.$request->settings_value->getClientOriginalExtension();
            $request->settings_value->move(public_path('images/settings'),$file_name);
            $setting['settings_value']=$file_name;
        }
        /*
        $settings=Settings::Where('id','=',$id)->update([
            'settings_value'=>$request->settings_value
        ]);
        */
        $settings=Settings::Where('id','=',$id)->update($setting);
        
        if ($settings) {
            $path='images/settings/'.$old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
            return back()->with("success","Düzenleme İşlemi Başarılı");
        }
        return back()->with("error","Düzenleme İşlemi Başarısız");
    }
}
