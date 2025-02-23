<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Properties;
use App\Models\cms;
use App\Models\User;
use App\Mail\GeneralMail;

class HomeController extends Controller
{
    public function index(){

        $featured_images = DB::select("SELECT feature_image FROM `properties` ORDER BY id DESC LIMIT 3");
        $latest_properties = Properties::where('status',1)->with('type')->orderBy('id','desc')->get(); 
        $featured_property = Properties::where('featured',1)->first();

        if (!empty($featured_property)) {
           
            $description = (string) html_entity_decode($featured_property->description_en, ENT_QUOTES, 'UTF-8');
            $limit = Str::limit(strip_tags($description), 200);
			$featured_property->description_en = $limit;
        }
        // App::setLocale('nl');
        // return App::getLocale();

        return view('front.index',compact('featured_images','latest_properties','featured_property'));
    }

    public function change_lang($lang){

        App::setLocale($lang);

        // return App::getLocale();

        return redirect()->back();
    }
    public function property_details($slug){
        $property_info = Properties::where('slug',$slug)->first();

        if (empty($property_info)) {
            return redirect()->back()->withErrors('Sorry no record Found');
        }

        // if (!empty($property_info->youtube_url)) {
        //     # code...convertToEmbedUrl

        //     $url = $property_info->youtube_url;
        //     $property_info->youtube_url = self::convertToEmbedUrl($url);
        // }

        return view('front.property_details',compact('property_info'));
    }

    //Advance Search Functionality
    public function advance_search(Request $request){

        $request->validate(
            [
                'postal_code' => 'nullable',
                'province' => 'nullable',
                'property_type' => 'nullable',
                'bedrooms' => 'nullable',
                'bathrooms' => 'nullable',
                'min_price' => 'nullable',
                'max_price' => 'nullable',
            ]
            );

        $data = $request->all();

        // return $request->all();

        //Postal Code Filter 

        $postal_url = '';

        if (!empty($data['postalcode'])) {

            $code = $data['postalcode'];
           
            if (empty($postal_url)) {
                    
                    $postal_url .='&postalcode='.$code;
            }else{

                $postal_url .=','.$code;
            }
        }

        //Province Filter

        $province_url = '';

        if (!empty($data['province'])) {

           $code = $data['province'];
          
           
            if (empty($province_url)) {
                    
                   $province_url .='&province='.$code;
                //   $province_url .="&street_address LIKE '%$code%' OR city LIKE '%$code%'";
              //  exit;
            }else{

                $province_url .=','.$code;
               // echo $code;
                //exit;
            }
        }

        //property_type Filter 

        $property_type_url = '';

        if (!empty($data['property_type'])) {

            $code = $data['property_type'];
           
            if (empty($property_type_url)) {
                    
                    $property_type_url .='&property_type='.$code;
            }else{

                $property_type_url .=','.$code;
            }
        }

        //bedrooms Filter 

        $bedrooms_url = '';

        if (!empty($data['bedrooms'])) {

            $code = $data['bedrooms'];
           
            if (empty($bedrooms_url)) {
                    
                    $bedrooms_url .='&bedrooms='.$code;
            }else{

                $bedrooms_url .=','.$code;
            }
        }

        //bathrooms

        $bathrooms_url = '';

        if (!empty($data['bathrooms'])) {

            $code = $data['bathrooms'];
           
            if (empty($bathrooms_url)) {
                    
                    $bathrooms_url .='&bathrooms='.$code;
            }else{

                $bathrooms_url .=','.$code;
            }
        }

        //min_price

         $price_url = '';

        if (!empty($data['min_price']) && !empty($data['max_price'])) {

            $code = $data['min_price']."-".$data['max_price'];
           
            if (empty($price_url)) {
                    
                    $price_url .='&price='.$code;
            }else{

                $price_url .=','.$code;
            }
        }

        $sortByUrl = '';
        if(!empty($data['sortBy'])){
           
            $sortByUrl .="&sortBy=".$data['sortBy'];
        }

        


        return redirect()->route('properties.list',$postal_url.$province_url.$property_type_url.$bedrooms_url.$bathrooms_url.$price_url.$sortByUrl);

    }

    public function properties_list(Request $request){

        $properties = Properties::query();

        if (!empty($_GET['postalcode']) || !empty($_GET['province']) || !empty($_GET['property_type']) || !empty($_GET['bedrooms']) || !empty($_GET['bathrooms']) || !empty($_GET['price']) || !empty($_GET['sortBy']) || !empty($_GET['type'])) {

            // return $_GET['province'];

            if (!empty($_GET['postalcode'])) {
            
               $properties = $properties->where('postcode',$_GET['postalcode'])->where(['status' => 1])->paginate(9);
             }

            if (!empty($_GET['province']) ) {
               $properties = $properties->where('street_address', 'like', '%'.$_GET['province'].'%')
                             ->where('status', 1)->paginate(9);
    
            }

            if (!empty($_GET['property_type'])) {
                
                $properties = $properties->where('property_type_id',$_GET['property_type'])->where(['status' => 1])->paginate(9);
            }

            if (!empty($_GET['bedrooms'])) {
                
                $properties = $properties->where('bedrooms',$_GET['bedrooms'])->where(['status' => 1])->paginate(9);
            }

            if (!empty($_GET['bathrooms'])) {
                
                $properties = $properties->where('bathrooms',$_GET['bathrooms'])->where(['status' => 1])->paginate(9);
            }

            if (!empty($_GET['price'])) {
               
                $price = explode('-',$_GET['price']);
            
                $price[0] = floor($price[0]);
                $price[1] = ceil($price[1]);

                $properties = $properties->whereBetween('price',$price)->where(['status' => 1])->paginate(9);
            }

            if(!empty($_GET['sortBy'])){
                $sort=$_GET['sortBy'];
                if($sort == 'priceAsc'){
                    $properties = $properties->where(['status' => 1])->orderBy('price', 'ASC')->paginate(9);
                }
                if ($sort == 'priceDesc') {
                    $properties = $properties->where(['status' => 1])->orderBy('price', 'DESC')->paginate(9);
                }
            }

            if (!empty($_GET['type'])) {
                
                $type = $_GET['type'];

                $properties = $properties->where(['status' => 1,'property_type_id' => $type])->paginate(9);
            }
            
        }else{

            $properties = Properties::where('status',1)->paginate(9);

        }

        return view('front.property_list',compact('properties'));

    }

  function contact_us(){

    return view('front.contact_us');
  }
  //
  public function contact_us_post(Request $request){

    $request->validate(
        [
            'name' => 'required',
            'email' => 'required',
        ]
        );

        $message = '<p>'.$request->message;
        
        $mail_subject = "New Contact Us Mail";

        // $receiver,$subject,$message

        Mail::to( $request->email )->send(new GeneralMail($request->name,"Message Received","<p>Thank you for contacting us. You will get the required informations soon.</p>"));

        $admins = User::where('role','admin')->get();

        foreach($admins as $admin){

            Mail::to( $admin->email )->send(new GeneralMail($admin->first_name." ".$admin->last_name,$mail_subject,$message)); 
        }



       session()->flash('success','Your Message has been successfully sent');

       return redirect()->back();
  }
  function cms_page($slug){
     return view('front.cms_page')->with('cms_page',cms::where('slug',$slug)->first());
  }
}
 