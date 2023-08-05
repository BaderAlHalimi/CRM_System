<?php

namespace App\Models;

use App\Models\Scopes\UserAuthScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'birthdate',
        'user_id',
        'notes'
    ];
    protected static function booted()
    {
        static::addGlobalScope(new UserAuthScope);
    }
}
