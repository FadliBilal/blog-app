<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function index() {
        $sitesettings = SiteSetting::first();
        return view("dashboard.setting.site", compact("sitesettings"));
    }

    public function update(Request $request) {
        $validated = $request->validate([
            "site_title" => ["required", "string", "min:2", "max:255"],
            "tagline" => ["required", "string", "min:2", "max:255"],
            "description" => ["required", "string", "min:2", "max:300"],
            "copyright_text" => ["required", "string", "min:2", "max:300"],
            "enable_registration" => ["nullable", "integer"],
        ]);
        $sitesettings = SiteSetting::first();
        $sitesettings->site_title = $validated["site_title"];
        $sitesettings->tagline = $validated["tagline"];
        $sitesettings->description = $validated["description"];
        $sitesettings->copyright_text = $validated["copyright_text"];
        $sitesettings->enable_registration = Arr::has($validated, "enable_registration") ? "1" : "0";
        $sitesettings->save();
        return back()->with("success", "Site Settings updated!");
    }
}
