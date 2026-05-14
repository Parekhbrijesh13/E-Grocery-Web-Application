<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['site_name' => 'FreshCart']);
        }
        return view("Admin.settings.index", compact('setting'));
    }

    public function update(SettingRequest $request){
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create(['site_name' => 'FreshCart']);
        }

        $validatedData = $request->validated();
        $data = $validatedData;

        // Handle Site Logo
        if ($request->hasFile('site_logo')) {
            if ($setting->site_logo && Storage::disk('public')->exists($setting->site_logo)) {
                Storage::disk('public')->delete($setting->site_logo);
            }
            $data['site_logo'] = $request->file('site_logo')->store('Setting_imgs', 'public');
        }

        // Handle Favicon
        if ($request->hasFile('favicon')) {
            if ($setting->favicon && Storage::disk('public')->exists($setting->favicon)) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $data['favicon'] = $request->file('favicon')->store('Setting_imgs', 'public');
        }

        $setting->update($data);

        session()->flash('success', 'Settings updated successfully!');
        return redirect()->back();
    }
}
