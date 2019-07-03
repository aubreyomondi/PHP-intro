<?php

namespace App\Http\Controllers;
use App\Car;
use App\Review;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function allcars(){
        $cars = Car::all();
        //compact('cars', $cars)=['cars'=>$cars]
        return view('cars.allcars',['cars'=>$cars]);
    }

    public function particularcar($id){
        
    }
    /**
     * Show the form for creating a new car.
     *
     * @return \Illuminate\Http\Response
     */
    public function newcar(){
        return view('cars.newcar');
        
    }
    /**
     * Store a newly created car in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storecar(Request $request)
    {
        //Validate
        $request->validate([
            'make' => 'required|min:3',
            'model' => 'required',
            'produced_on' => 'required',
        ]);

        $car = Car::create(['make' => $request->make,'model' => $request->model,'produced_on' => $request->produced_on]);
        return redirect('/car/');
    }

    public function carIDreviews(Request $request){
        //Validate
        $request->validate([
            'car_id' => 'required',
        ]);
    $reviews = Review::all()->where('car_id',$request->car_id);
    //$user->posts()->where('active', 1)->get();
    return view('cars.carreviews',['reviews'=>$reviews]);
    //return redirect('/carreviews/');
    }
}
