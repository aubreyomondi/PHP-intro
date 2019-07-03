<?php

namespace App\Http\Controllers;
use App\Car;
use App\Review;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function allreviews(){
        $reviews = Review::all();
        //compact('cars', $cars)=['cars'=>$cars]
        return view('cars.allreviews',['reviews'=>$reviews]);
       
    }

    public function newreview(){
        return view('cars.newreview');   
    }

    public function storereview(Request $request)
    {
        //Validate
        $request->validate([
            'make' => 'required|min:3',
            'model' => 'required',
            'review' => 'required',
        ]); 
        $cars=Car::where('model',$request->model)->get(['id']);
        $car=$cars->pluck('id');
        $Review = Review::create(['make' => $request->make,'model' => $request->model,'review' => $request->review,'car_id'=>$car[0]]);
        return redirect('/review/');
    }

    public function cardetails(Request $request){
        //Validate
        $request->validate([
            'review_id' => 'required',
        ]);
        $cars=Review::where('id',$request->review_id)->get('car_id');
        $car=$cars->pluck('car_id');
        $cardetails = Car::where('id',$car)->get();
        return view('cars.cardetails',['cardetails'=>$cardetails]);
    }
}
