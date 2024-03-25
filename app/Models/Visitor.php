<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visitor extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        "name",
        "phone_number",
        "email",
        "ID/Passport_number",
        "purpose_of_visit",
        "sacco_id",
        "person_to_visit"
    ];
    public $timestamps = false;
}

