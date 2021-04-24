<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'products';
    public $primaryKey = 'id';
    public $timestamps = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = ['product_number','product_name', 'product_price','product_desc','category','product_imagelink','featured', 'sale','quantity','gender',];
}
