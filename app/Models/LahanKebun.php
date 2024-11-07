<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanKebun extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'lahan_kebuns';

    protected $fillable = [
        'user_id',
        'no_lahan',
        'nama_lahan',
        'luas_lahan',
        'kepemilikan_lahan',
        'status_lahan',
        'geom',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
