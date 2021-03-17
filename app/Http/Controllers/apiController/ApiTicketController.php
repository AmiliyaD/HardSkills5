<?php

namespace App\Http\Controllers\apiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Resources\ChannelResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\EvenResource;
use App\Http\Resources\EventTicketResource;
use App\Http\Resources\ApiEventResource;
use App\Http\Resources\RegistrationResource;
use App\Http\Resources\OrganizerResource;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Registration;
use App\Models\Organizer;
use App\Models\Channel;
use App\Models\EventTicket;
use App\Models\Session;
use App\Models\SessionRegistration;
use Mockery\Undefined;

class ApiTicketController extends Controller
{
    // ДОБАВИТЬ НОВОГО ПОЛЬЗОВАТЕЛЯ
    public function getTicket(Request $request, $org_id, $ev_id)
    {
    $evNew = ApiEventResource::collection(Event::where('organizer_id', $org_id)->where('id', $ev_id)->get());   
    $att = Attendee::where('login_token', $request->login_token)->first();

    $tick = EventTicket::where('id', $request->ticket_id)->where('event_id', $ev_id)->get();
    $a = [];
if ($request->session_id) {
    $a = $request->session_id;
}


    $tickAtt = Registration::where('ticket_id', $request->ticket_id)->where('attendee_id', $att->id)->get();
if (!$att) {
    return response()->json(['message'=>'пользователя нет']);
}


if ($tickAtt->count() > 0) {
    return  response()->json(['message'=>'пользователь уже зарегестрирован на это событие'], 401);
}

if ($tick->count() == 0) {
    return  response()->json(['message'=>'билета нет'], 401);
}


    $newTick = new Registration;
    $newTick->attendee_id = $att->id;
    $newTick->ticket_id = $tick[0]->id;
    $newTick->save();
    
    $tickAt = Registration::where('ticket_id', $request->ticket_id)->where('attendee_id', $att->id)->first();

    if (count($a) > 0) {
        for ($i = 0; $i < count($a); $i++) {
            $ses = new SessionRegistration;
            $ses->session_id = $a[$i];
            $ses->registration_id = $tickAt->id;
            $ses->save();
        }
        
        
    }
    return  response()->json(['message'=>'регистрация прошла успешно', 'ev'=>$a, 'tickAtt'=>$tickAt], 200);
    }



    // ВЫВЕСТИ ВСЕ БИЛЕТЫ ПОЛЬЗОВАТЕЛЯ
    public function getRegistration(Request $request)
    {
    
        $att = Attendee::where('login_token', $request->login_token)->first();
        if (!$att) {
            return response()->json(['message'=>'пользователь не вошел в систему'], 401);
        }
        $reg = Registration::where('attendee_id', $att->id)->get();
       
        return 
        
        [
            'reg'=>Registration::where('attendee_id', $att->id)->with('eventTick.event.organizers')->get()->map(function($res) {
                return [
                    'event'=>$res->eventTick->event,
                    'session_ids'=>$res->sessions->pluck('session_id')
                ];
            })
            // 'registrations'=>RegistrationResource::collection(Registration::where('attendee_id', $att->id)->get())
        ];
     
        // $r = {"registrations":
        //      [{"event": 
        //         {"id": 1, 
        //             "name": "someText", 
        //             "slug": "some-text", 
        //             "date": "2019-08-15",
        //              "организатор":
        //               {"id": 1,
        //                  "name": "someText",
        //                   "slug": "some-text"}},
                          
        //                    "session_ids":
        //                              [1, 2, 3]}]}
        # code...
    }
    public function sessions($id)
    {
        $ses = Session::where('id', $id)->get();
        return [
            'sessionInfo'=> $ses
        ];
        # code...
    }
}
