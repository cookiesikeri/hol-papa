<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapaGeneralDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $connection = 'mysql';
    protected $table = "papa_generaldetails";
}
