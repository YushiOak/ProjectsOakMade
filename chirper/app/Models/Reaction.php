<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'chirp_id', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chirp()
    {
        return $this->belongsTo(Chirp::class);
    }
}
