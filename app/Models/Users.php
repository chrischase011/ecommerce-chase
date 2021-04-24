<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Shetabit\Visitor\Traits\Visitable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable, Visitable;
    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['username', 'password','email','fname','lname','mi','address','pic_location','gender','bday','billing1', 'billing2'];
     protected $hidden = [
        'password', 
    ];
    
}
