<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        return view("pages.setting.index", [
            "setting" => Setting::first()
        ]);
    }


    public function store(Request $request)
    {

        $imageName = "";

        if ($request->hasFile('image')) {
            $rand = str::random(8);
            $file_name = $rand . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('storage/upload/setting/', $file_name);
            $imageName = $file_name;
        } else {
            $imageName = "";
        }

        $setting = Setting::first();

        if ($setting == null) {
            $setting = Setting::create([
                "image" => $imageName,
                "scholl_name" => $request->scholl_name,
                "address" => $request->address,
                "phone_number" => $request->phone_number
            ]);
            Session::flash("success", "Setting perpustakaan berhasil di buat");
            return redirect()->back();
        }
        $setting->update([
            "image" => $imageName,
            "scholl_name" => $request->scholl_name,
            "address" => $request->address,
            "phone_number" => $request->phone_number
        ]);
        Session::flash("success", "Setting perpustakaan berhasil di buat");
        return redirect()->back();
    }
}
