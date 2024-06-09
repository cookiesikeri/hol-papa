<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PapaSiteSetting extends Model
{
    protected $guarded = [];

    protected $connection = 'mysql';
    protected $table = "papa_site_settings";

}
