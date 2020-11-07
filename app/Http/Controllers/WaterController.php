<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class WaterController extends BaseController {

	public $factory;

    public function __construct() {
        $this->factory = app('firebase.firestore');
    }

    public function create(Request $request) {
    	$this->validate($request,[
            "user_for"      => "required",
            "animal_type"   => "required",
            "value"         => "required"
        ]);
    	$document = $this->factory->database()->collection("water_data")->newDocument();
    	$document->set([
    		"farm_id" 		=> 	$request->input("farm_id"), 
    		"animal_type" 	=> 	$request->input("animal_type"), 
    		"value" 		=> 	$request->input("value"),
            "used_for"      =>  $request->input("used_for"),
    		"date" 			=> 	Carbon::now()->toFormattedDateString()
    	]);
    	return ["docuemnt_id" => $document->id()];
    }

    public function delete(Request $request) {
    	$this->validate($request, ["document_id" => "required"]);
    	return $this->factory->database()->collection("water_data")->document($request->input("document_id"))->delete();
    }
}
