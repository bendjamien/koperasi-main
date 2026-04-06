<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensi::with('user');

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->orderBy('jam_masuk', 'desc')->paginate(20)->withQueryString();
        $users = User::where('role', 'kasir')->get();
        
        return view('absensi.index', compact('absensis', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_absen' => 'required|string'
        ]);

        $user = User::where('kode_absen', $request->kode_absen)->first();

        if (!$user) {
            return back()->with('error', 'Kode Absen tidak valid.');
        }

        if ($user->id !== Auth::id() && Auth::user()->role !== 'admin') {
             return back()->with('error', 'Anda hanya bisa melakukan absensi untuk akun Anda sendiri.');
        }

        $today = Carbon::today('Asia/Jakarta');
        $now = Carbon::now('Asia/Jakarta');

        $absensi = Absensi::where('user_id', $user->id)
            ->where('tanggal', $today->toDateString())
            ->first();

        $jamMasukSetting = Setting::where('key', 'jam_masuk')->first()?->value ?? '08:00';
        $jamPulangSetting = Setting::where('key', 'jam_pulang')->first()?->value ?? '17:00';

        // Jika user mencoba melakukan aksi tapi statusnya sudah masuk, namun dia mengirimkan request absensi baru
        // Kita perlu membedakan apakah ini niatnya mau Pulang atau tidak sengaja klik Masuk lagi.
        
        if (!$absensi) {
            // ... logic masuk tetap sama ...
            // Absen Masuk
            $entryTime = Carbon::createFromFormat('H:i', $jamMasukSetting, 'Asia/Jakarta');
            $currentTime = Carbon::createFromFormat('H:i', $now->format('H:i'), 'Asia/Jakarta');
            
            $status = 'hadir';
            $lateMinutes = 0;

            if ($currentTime->greaterThan($entryTime)) {
                $status = 'terlambat';
                $lateMinutes = $currentTime->diffInMinutes($entryTime);
            }
            
            Absensi::create([
                'user_id' => $user->id,
                'tanggal' => $today->toDateString(),
                'jam_masuk' => $now->toTimeString(),
                'status' => $status,
                'late_minutes' => $lateMinutes
            ]);

            $msg = $status == 'terlambat' ? "Berhasil Absen Masuk. Anda terlambat $lateMinutes menit." : "Berhasil Absen Masuk tepat waktu.";
            return back()->with('success', $msg);
        } else {
            // Absen Pulang
            if ($absensi->jam_pulang) {
                return back()->with('error', 'Anda sudah melakukan absen pulang hari ini.');
            }

            // Jika user mencoba submit kode tapi jam_pulang belum ada, 
            // kita cek apakah ini percobaan klik Masuk kedua kali atau mau Pulang.
            // Jika diklik sebelum jam pulang, kita asumsikan dia tidak sengaja klik Masuk lagi.
            
            $exitTime = Carbon::createFromFormat('H:i', $jamPulangSetting, 'Asia/Jakarta');
            $currentTime = Carbon::createFromFormat('H:i', $now->format('H:i'), 'Asia/Jakarta');

            if ($currentTime->lessThan($exitTime)) {
                return back()->with('error', "Anda sudah melakukan absen masuk pada jam $absensi->jam_masuk. Belum saatnya pulang (Jam pulang: $jamPulangSetting).");
            }

            $absensi->update([
                'jam_pulang' => $now->toTimeString()
            ]);

            return back()->with('success', 'Berhasil Absen Pulang. Sampai jumpa besok!');
        }
    }

    public function scan(Request $request)
    {
        return $this->store($request);
    }
}
