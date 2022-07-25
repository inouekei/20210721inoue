<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['content'];
    public function todos(){
        return $this->hasMany('App\Models\Todo');
    }
}
