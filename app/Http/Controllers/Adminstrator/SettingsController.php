<?php

namespace App\Http\Controllers\Adminstrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting_Apk;
use App\Models\Setting_Title_Apk;

class SettingsController extends Controller
{
    /* General Settings Website */
    public function general_seetings() {
        $data = Setting_Apk::all();
        return view('Adminstrator.settings.general_settings.list', compact('data'));
    }

    public function settingscreate() {
        return view('Adminstrator.settings.general_settings.create');
    }

    public function settingscreateproses(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tanggal_kerja' => 'required|string|max:255',
            'copyright' => 'required|string|max:255',
        ]); 
    
        // Create a new Setting_Apk record
        $setting = new Setting_Apk();
        $setting->phone = $request->input('phone');
        $setting->email = $request->input('email');
        $setting->tanggal_kerja = $request->input('tanggal_kerja');
        $setting->copyright = $request->input('copyright');
        $setting->save();
    
        // Redirect to the settings list with a success message
        return redirect()->route('settings')->with('success', 'Setting created successfully.');
    }

    public function settingsedit($id) {
        $setting = Setting_Apk::findOrFail($id);
        return view('Adminstrator.settings.general_settings.edit', compact('setting'));
    }

    public function settingsupdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'tanggal_kerja' => 'required|string|max:255',
            'copyright' => 'required|string|max:255',
        ]);

        // Find the specific Setting_Apk record
        $setting = Setting_Apk::findOrFail($id);
        $setting->phone = $request->input('phone');
        $setting->email = $request->input('email');
        $setting->tanggal_kerja = $request->input('tanggal_kerja');
        $setting->copyright = $request->input('copyright');
        $setting->save();

        // Redirect to the settings list with a success message
        return redirect()->route('settings')->with('success', 'Setting updated successfully.');
    }

    public function delete($id)
    {
        $setting = Setting_Apk::findOrFail($id);
        $setting->delete();

        return redirect()->route('settings')->with('success', 'Setting deleted successfully.');
    }

    /* Settings Title APK */
    public function settings_title() {
        $data = Setting_Title_Apk::all();
        return view('Adminstrator.settings.settings_title.list', compact('data'));
    }

    public function settings_titlecreate() {
        return view('Adminstrator.settings.settings_title.create');
    }

    public function settings_titlecreateproses(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'title_nama' => 'required|string|max:255',
        ]);

        // Create a new Setting_Title_Apk record
        $settingTitle = new Setting_Title_Apk();
        $settingTitle->title_nama = $request->input('title_nama');
        $settingTitle->save();

        // Redirect to the settings title list with a success message
        return redirect()->route('settings_title')->with('success', 'Title setting created successfully.');
    }

    public function settings_titleedit($id) {
        $settingTitle = Setting_Title_Apk::findOrFail($id);
        return view('Adminstrator.settings.settings_title.edit', compact('settingTitle'));
    }    

    public function settings_titleupdate(Request $request, $id) {
        // Validate the request data
        $validatedData = $request->validate([
            'title_nama' => 'required|string|max:255',
        ]);

        // Find the existing Setting_Title_Apk record
        $settingTitle = Setting_Title_Apk::findOrFail($id);
        $settingTitle->title_nama = $request->input('title_nama');
        $settingTitle->save();

        // Redirect to the settings title list with a success message
        return redirect()->route('settings_title')->with('success', 'Title setting updated successfully.');
    }

    public function settings_titledelete($id)
    {
        $setting = Setting_Title_Apk::findOrFail($id);
        $setting->delete();

        return redirect()->route('settings_title')->with('success', 'Setting deleted successfully.');
    }
}
