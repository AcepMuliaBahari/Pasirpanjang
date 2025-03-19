<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Development extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'budget',
        'progress',
        'status',
        'location',
        'pic_name',
        'pic_contact',
        'photo',
    ];

    public static function getStatuses()
    {
        return [
            'Belum Dimulai',
            'Proses', 
            'Selesai',
            'Tertunda'
        ];
    }

    protected $casts = [
        'start_date' => 'datetime',       // Sesuaikan dengan tipe date di migration
        'end_date' => 'datetime',         // (bukan datetime)
        'budget' => 'decimal:2',
        'progress' => 'integer',
    ];

    // Accessor untuk URL foto lengkap (jika diperlukan)
    protected function photoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['photo'] 
                ? asset($attributes['photo'])
                : null,
        );
    }
}
