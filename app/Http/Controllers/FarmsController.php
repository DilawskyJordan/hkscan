<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class FarmsController extends BaseController {

	public $factory;

    public function __construct() {
        $this->factory = app('firebase.firestore');
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		"real_id" => "required"
    	]);
    	$document = $this->factory->database()->collection("farms")->newDocument();
    	$document->set([
            "real_id"   =>  $request->input("real_id"),
            "name"      =>  $request->input("name"),
            "location"  =>  $request->input("location"),
            "date"      =>  Carbon::now()->toFormattedDateString()
    	]);
    	return ["docuemnt_id" => $document->id()];
    }

    public function get($id) {
        $collection = $this->factory->database()->collection("farms");
        foreach($collection->where("real_id", "=", $id)->documents() as $document) {
            return ["docuemnt_id" => $document->id()];
        }
    }
}
