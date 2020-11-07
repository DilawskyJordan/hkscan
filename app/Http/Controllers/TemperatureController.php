<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class TemperatureController extends BaseController {

	public $factory;

    public function __construct() {
        $this->factory = app('firebase.firestore');
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		"value" => "required"
    	]);
    	$document = $this->factory->database()->collection("temperatures")->newDocument();
    	$document->set([
    		"farm_id" 		=> 	$request->input("farm_id"), 
    		"value" 		=> 	$request->input("value") ,
    		"date" 			=> 	Carbon::now()->toFormattedDateString()
    	]);
    	return ["docuemnt_id" => $document->id()];
    }

    public function delete(Request $request) {
    	$this->validate($request, ["document_id" => "required"]);
    	return $this->factory->database()->collection("temperatures")->document($request->input("document_id"))->delete();
    }
}
