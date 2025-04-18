<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tache extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'completed','user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
