<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        "visitor_id",
        "purpose_of_visit",
        "person_to_see",
        "sacco_id",
        "time_in",
        "time_out"
    ];
    public $timestamps = false;
}
