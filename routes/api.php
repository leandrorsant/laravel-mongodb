<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Models\CustomerMongoDB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello_world/', function (Request $request) {
    return ['msg' => 'hello_world'];
});

Route::get('/ping', function (Request  $request) {    
    $connection = DB::connection('mongodb');
    $msg = 'MongoDB is accessible!';
        try {  
        $connection->command(['ping' => 1]);  
        } catch (\Exception  $e) {  
        $msg = 'MongoDB is not accessible. Error: ' . $e->getMessage();
        }
        return ['msg' => $msg];
});

Route::get('/create_eloquent_mongo/', function (Request $request) {
    try {
        $success = CustomerMongoDB::create([
            'guid'        => 'cust_1111',
            'first_name'  => 'John',
            'family_name' => 'Doe',
            'email'       => 'j.doe@gmail.com',
            'address'     => '123 my street, my city, zip, state, country'
        ]);
        $msg = "OK";
    }
    catch (\Exception $e) {
        $msg =  'Create user via Eloquent MongoDB model. Error: ' . $e->getMessage();
    }

    return ['status' => 'executed', 'data' => $msg];
});

Route::get('/update_eloquent/', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', 'cust_1111')->update( ['first_name' => 'Jimmy'] );
});
   
   Route::get('/delete_eloquent/', function (Request  $request) {
    $result = CustomerMongoDB::where('guid', 'cust_1111')->delete();
});
