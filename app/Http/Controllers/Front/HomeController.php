<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Properties;

class HomeController extends Controller
{
    public function index(){

        $featured_images = DB::select("SELECT feature_image FROM `properties` ORDER BY id DESC LIMIT 3");
        $latest_properties = Properties::where('status',1)->with('type')->orderBy('id','desc')->get(); 
        return view('front.index',compact('featured_images','latest_properties'));
    }
    public function property_listing(Request $request){

    }
    public function property_details($slug){
        $property_info = Properties::where('slug',$slug)->first();

        if (empty($property_info)) {
            return redirect()->back()->withErrors('Sorry no record Found');
        }

        return view('front.property_details',compact('property_info'));
    }
}
 