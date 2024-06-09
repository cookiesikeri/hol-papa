<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PapaContactMessage extends Model
{
    use HasFactory;

    protected $table = "papa_contact_messages";

    protected $guarded = [];
}
