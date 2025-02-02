<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // Custom table name
    protected $guarded = [];
    //protected $fillable = ['name', 'price']; // Allow mass assignment for 'name' & 'price'
}
