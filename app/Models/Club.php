<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['api_id', 'name', 'badge'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
