<?php

use App\Http\Controllers\ChannelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SessionController;
use Barryvdh\Debugbar\DataCollector\SessionCollector;

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
    return view('org');
})->name("home");

Route::get('thisHo', [EventController::class, 'apiGet']);
// index after auth
Route::get('/index', [EventController::class, 'index'])->middleware('auth')->name('index');

Route::get('event/create', [EventController::class,'create'])->middleware('auth')->name("create");
// view detail event
Route::post('event/detail', [EventController::class,'store'])->middleware('auth')->name('detail');

Route::get('event/detail/{id?}', [EventController::class, 'show'])->middleware('auth')->name('detail')->where('id', '[0-9]+');
// view edit event
Route::get('event/editEvent/{id?}',[EventController::class, 'edit'])->middleware('auth')->name('edit');

Route::post('event/editEvent/{id?}', [EventController::class,'update'])->middleware('auth')->name('update');

//view edit ticket
Route::get('tickets/createTicket/{id:event_id}', [TicketController::class,'create'])->name('ticket');
Route::post('tickets/createTicket/{id:event_id}', [TicketController::class,'store'])->name('ticketStore');


// view edit session
Route::get('session/createSession/{id}', [SessionController::class,'create'])->name('createSession');
Route::post('session', [SessionController::class, 'store'])->name('saveSession');
Route::get('sessions/editSession/{id}/{sessionId:id}', [SessionController::class, 'edit'])->name('editSession');
Route::post('sessions/updateSession/{id}', [SessionController::class, 'update'])->name('updateSession');
// view edit channel
Route::get('channels/createChannel/{id}', [ChannelController::class, 'create'])->name('channelCreate');
Route::post('event/detail/{id:event_id?}', [ChannelController::class, 'store'])->name("createChannel");

// view edit ROOM
Route::get('rooms/createRoom/{id?}', [RoomController::class, 'create'])->name('createRoom');
Route::post('rooms/createRoom/{id?}', [RoomController::class, 'store'])->name('storeRoom');

// view room capacity
Route::get('reports/indexReport/{id?}', [ReportController::class, 'index'])->name('report');
// Route::get('event/ticket/')
// Route::get('/index', function() {
//     return view('index');
// })->name('er');


require __DIR__.'/auth.php';
