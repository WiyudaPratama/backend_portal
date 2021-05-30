<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'statuses';

    protected $fillable = ['status', 'news_id'];

    public function news()
    {
        return $this->belongsTo(News::class, 'id');
    }
}
