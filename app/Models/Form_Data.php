<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_Data extends Model
{
    use HasFactory;
    protected $fillable=['Name','Email','Image','Gender','Skills'];
}
