<?php

use Illuminate\Support\Facades\Route;
use App\Models\Person;
use App\Models\Pair;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/santa/{id}', function ($id) {
	$pair = Pair::where('people_id', (int)$id)->first();
	if (isset($pair)) {

		$person = Person::find($pair->people_id);
		$santa = Person::find($pair->santa_id);
		$result = ["person" => $person->name, "santa" => $santa->name];
		return response()->json($result);
	}
	#$pair = Person::find($id);
	return response()->json(["404"]);

});
