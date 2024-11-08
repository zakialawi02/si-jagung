<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LahanReviewed extends Model
{
    use HasFactory;

    protected $table = 'lahan_revieweds';
    protected $primaryKey = 'id';

    protected $fillable = [
        'lahan_kebun_id',
        'reviewed',
        'reviewed_at'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function kebun()
    {
        return $this->belongsTo(LahanKebun::class, 'lahan_kebun_id');
    }
}
