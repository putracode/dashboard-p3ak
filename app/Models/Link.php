<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $table = 'links';

    protected function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
