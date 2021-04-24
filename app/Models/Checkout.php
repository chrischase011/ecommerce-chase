<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Checkout extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'checkout';
    public $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['tracking_number','user_id','name','cart_id','tax','discount','subtotal','grand_total','address','city','country','contact','payment_method','noc','ccaddress','ccnumber','expiry','cvc','status','courier','delivery','shipping_fee',];
}
