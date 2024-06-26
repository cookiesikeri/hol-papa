<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapaGallery extends Model
{
    use HasFactory;

    protected $table = "papa_galleries";

    protected $fillable = ['title', 'image'];
}
