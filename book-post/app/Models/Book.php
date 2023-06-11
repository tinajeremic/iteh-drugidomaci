<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'year',
        'writer_id',
        'user_id'
    ];

    public $timestamps = false;

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
