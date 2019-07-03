<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['make','model','produced_on'];
    //one to many relationship, review
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
}
