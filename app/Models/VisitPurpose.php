<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitPurpose extends Model
{
    protected $primaryKey = "purpose";
    protected $fillable = [
        'purpose'
    ];
    use HasFactory;
    public $timestamps = false;
}
