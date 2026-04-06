<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'late_minutes',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
