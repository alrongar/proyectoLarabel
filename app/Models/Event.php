<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'description',
        'category',
        'start_time',
        'end_time',
        'location',
        'latitude',
        'longitude',
        'max_attendees',
        'price',
        'image_url',
    ];

    // Define la relación con el modelo Organizer
    public function organizer()
    {
        return $this->belongsTo(User::class);
    }

}
