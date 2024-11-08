<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanKebun extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'lahan_kebuns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'no_kebun',
        'nama_pemilik',
        'luas',
        'jumlah_produksi',
        'jenis_jagung',
        'varietas_jagung',
        'geom',
    ];

    protected $casts = [
        'luas' => 'float',
        'jumlah_produksi' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewed()
    {
        return $this->hasMany(LahanReviewed::class, 'lahan_kebun_id');
    }
}
