<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Voucher; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;

class PengaturanController extends Controller
{
    public function index()
    {
        $keys = [
            'ppn_tax_rate' => '0.11', 
            'company_name' => 'MenuKhas',
            'company_website' => 'www.menukhas.com',
            'company_email' => 'menukhas@gmail.com',
            'company_phone' => '+62 5722136836',
            'company_address' => 'Cianjur, Jawa Barat, Indonesia - 43284',
            'company_tax_id' => '00XXXX1234X0XX',
            'loyalty_points_per_nominal' => '10000',
            'member_silver_threshold' => '500',
            'member_gold_threshold' => '2000',
            'jam_masuk' => '08:00',
            'jam_pulang' => '17:00',
            'hero_background' => null,
            'login_logo' => null,
        ];

        $settings = [];
        foreach ($keys as $key => $defaultValue) {
            $setting = Setting::firstOrCreate(['key' => $key], ['value' => $defaultValue]);
            
            if ($key == 'ppn_tax_rate') {
                $settings[$key] = (float) $setting->value * 100;
            } else {
                $settings[$key] = $setting->value;
            }
        }

        $vouchers = Voucher::orderBy('id', 'desc')->get();

        return view('pengaturan.index', compact('settings', 'vouchers'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'ppn_tax_rate' => 'required|numeric|min:0|max:100',
            'company_name' => 'required|string|max:100',
            'company_website' => 'nullable|string|max:100',
            'company_email' => 'nullable|email|max:100',
            'company_phone' => 'nullable|string|max:30',
            'company_address' => 'nullable|string|max:255',
            'company_tax_id' => 'nullable|string|max:100',
            'loyalty_points_per_nominal' => 'required|integer|min:1',
            'member_silver_threshold' => 'required|integer|min:0',
            'member_gold_threshold' => 'required|integer|min:0',
            'jam_masuk' => 'required|string',
            'jam_pulang' => 'required|string',
            'hero_background' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'login_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle File Uploads
        if ($request->hasFile('hero_background')) {
            $file = $request->file('hero_background');
            $filename = 'hero_bg_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            
            Setting::updateOrCreate(
                ['key' => 'hero_background'],
                ['value' => 'uploads/settings/' . $filename]
            );
            Cache::forget('hero_background');
        }

        if ($request->hasFile('login_logo')) {
            $file = $request->file('login_logo');
            $filename = 'login_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/settings'), $filename);
            
            Setting::updateOrCreate(
                ['key' => 'login_logo'],
                ['value' => 'uploads/settings/' . $filename]
            );
            Cache::forget('login_logo');
        }

        foreach ($validated as $key => $value) {
            if (in_array($key, ['hero_background', 'login_logo'])) {
                continue;
            }
            
            if ($key == 'ppn_tax_rate') {
                $value = $value / 100;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );

            Cache::forget($key);
        }
        
        Cache::forget('all_settings'); 

        return Redirect::route('pengaturan.index')
                         ->with('toast_success', 'Pengaturan berhasil diperbarui!');
    }
}