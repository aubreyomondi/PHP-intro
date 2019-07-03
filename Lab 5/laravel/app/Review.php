<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['make','model','review','car_id'];
    //one to one relationship, car
    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}
