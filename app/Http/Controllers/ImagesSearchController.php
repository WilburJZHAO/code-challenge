<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Utilities\Unplash;

class ImagesSearchController extends Controller
{
    //
    public function imageSearch(){
        $pics = Unplash::getRandomImages();
        return view('test')->with('pics', $pics);

//             $pics = Unplash::getRandomImages();
//             return $pics;
    }

    public function aa(){
          return view('home');

    //             $pics = Unplash::getRandomImages();
    //             return $pics;
        }
}