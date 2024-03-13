<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "phone_number",
        "ID/Passport_number",
        "purpose_of_visit",
        "sacco_id",
        "person_to_visit"
    ];
}
