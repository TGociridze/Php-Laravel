<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Amount extends Model
{
    use  HasFactory;
    protected $fillable = [
        'amount', 'user_id'

    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

}
