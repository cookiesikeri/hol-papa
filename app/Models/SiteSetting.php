<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    protected $connection = 'mysql';
    protected $table = "papa_site_settings";

}
