<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Event extends Model
{
    use Searchable;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sport_id',
        'type',
        'date',
        'time',
        'location',
        'description',
        'max_participants'
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'events_users');
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'date' => $this->date,
            'location' => $this->location
        ];
    }

}
