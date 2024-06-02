<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sermon extends Model
{
    use HasFactory;

    protected $table = "sermons";

    protected $guarded = [];

    public function scopeTrending($query)
    {
        $weekAgo = Carbon::now()->subWeek();

        return $query->where('created_at', '>=', $weekAgo)
                     ->orderBy('views', 'desc');
    }
}
