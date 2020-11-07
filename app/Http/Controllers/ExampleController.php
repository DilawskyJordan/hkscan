<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;

class ExampleController extends Controller {

    public $factory;

    public function __construct() {
        $this->factory = app('firebase.firestore');
    }

    public function test() {
        return User::create(["email" => "test@test.com", "password" => Hash::make("test")]);

        exit;
        $database   =   $this->factory->database();
        $farm       =   $database->collection("farms")->document("Mbz4bgaY1wgmoLKG2TcH")->id();
        $values   =   ["8.1975", "2.165", "1.4425", "2.695", "0.7325", "0.35", "0.045"];
        foreach($values as $value) {
            $database->collection("co2_data")->newDocument()->set(["farm_id" => $farm, "animal_type" => "", "comments" => "", "value" => $value, "date" => date("Y-m-d")]);
        }
    }
}
