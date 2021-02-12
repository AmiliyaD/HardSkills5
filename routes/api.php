<?php

use App\Http\Controllers\apiController\ApiTicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\EvenResource;
use App\Http\Resources\EventTicketResource;
use App\Http\Resources\OrganizerResource;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Channel;
use App\Models\EventTicket;
use App\Models\SessionRegistration;
use Illuminate\Support\Facades\DB;
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

Route::get('/user', function (Request $request) {
    return $request;
});
// EVENTS
Route::get('/v1/events', function () {
    return   EvenResource::collection(Event::all());
});
// EVENT - CHANNEL - SESSION
Route::get('/v1/organers/{slug}/events/{event_slug}', function ($id,$ev_slug) {
    $some = EventResource::collection(Event::where('organizer_id', $id)->where('slug', $ev_slug)->get());

$ev = Event::where('organizer_id', $id)->get();
$evOg = Event::where('organizer_id', $id)->where('slug', $ev_slug)->get();
// проверка на  организатора
if ($ev->count() == 0) {
    return response()->json(['message'=>'организатор не найден'], 404);
}
// проверка на событие
else if ($evOg->count() == 0) {
    return response()->json(['message'=>'событие не найдено'], 404);
 } 
else {
    return $some;
}


});


Route::post('/v1/login', [AttendeeController::class, 'login']);
Route::middleware('api')->post('/v1/logout', [AttendeeController::class, 'logout']);
// СДЕЛАТЬ ГЕНЕРАЦИЮ API_TOKEN ПОСЛЕ АВТОРИЗАЦИИ

Route::post('/v1/organers/{org_id}/events/{ev_id}/registration', [ApiTicketController::class, 'getTicket']);

Route::post('/v1/registration',[ApiTicketController::class, 'getRegistration']);

Route::post('/v1/num', function () {
   
   $ss = SessionRegistration::where('registration_id', '>', 10)->get('id')->modelKeys();
    $ses = DB::table('session_registrations')->select('id')->where('registration_id','>', 10)->get();
    return $ss;
  
});
// registration лиормормормор

// получить все собыитя, на которые зарегестрирован пользователь
// сделать проверку, есть ли среди полученных событий, событие на которое хочет зарегестроивать пользватель // if (true)  - ОШИБКА 