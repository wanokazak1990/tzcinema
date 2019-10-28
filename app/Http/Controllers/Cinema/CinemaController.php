<?php

namespace App\Http\Controllers\Cinema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cinema;
use App\Http\Requests\CinemaSearchRequest;

class CinemaController extends Controller
{
    public function index()
    {
    	$cinemas = Cinema::orderBy('seans_date')->orderBy('room')->get();
    	$ratings = Cinema::distinct()->pluck('years');
    	return view('cinema.index',compact('cinemas','ratings'));
    }

    public function search(CinemaSearchRequest $request)
    {
    	$query = Cinema::orderBy('seans_date')->orderBy('room');
    	if($request->years)
    		$query->where('years',$request->years);
    	if($request->price)
    		$query->where('price','<',$request->price);
    	if($request->seans_time)
    		$query->where('seans_time','>=',$request->seans_time);
    	$cinemas = $query->get();

    	return response()->json(view('cinema.afisha', compact('cinemas'))->render());
    }
}
