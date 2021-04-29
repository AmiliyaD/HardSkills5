<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Channel;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eve = Event::where('organizer_id', Auth::id())->orderBy('date', 'desc')->get();
 
        return view('index', ['event'=>$eve]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:events,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'date'=>'required',
        ]);
        $saveE = new Event;
        $saveE->name = $request->name;
        $saveE->slug= $request->slug;
        $saveE->date = $request->date;
        $saveE->organizer_id = Auth::id();
        $saveE->save();
        $request->session()->flash('info', 'Событие успешно создано!');
        return redirect()->route('detail', ['id'=>$saveE->id]);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, $id)
    {
        $oneEv = Event::where('id', $id)->first();
        $channel = Channel::where('event_id', $id)->get();
        $oneTick = EventTicket::where('event_id', $id)->get();
        // вытянуть остальные таблицы tickets, rooms,sessions
        if (!empty(Channel::find($id)->Session)) {
            $session = Channel::find($id)->Session;
            $room = Channel::find($id)->Rooms;
            return view('event/detail', ['one'=>$oneEv, 'oneTick'=>$oneTick, 'channel'=>$channel, 'get'=>$room, 'session'=> $session]);
            
        }
      if (!empty($oneTick)) {
        return view('event/detail', ['one'=>$oneEv, 'oneTick'=>$oneTick]);
      }
      if (!empty($channel) || !empty($oneTick)) {
        return view('event/detail', ['one'=>$oneEv, 'oneTick'=>$oneTick, 'channel'=>$channel]);
      }
      if (!empty($channel) || !empty($oneTick) || !empty(Channel::find($id)->Rooms)) {
          $room = Channel::find($id)->Rooms;
        return view('event/detail', ['one'=>$oneEv, 'oneTick'=>$oneTick, 'channel'=>$channel, 'get'=>$room]);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, $id)
    {
        $oneEv = Event::where('id', $id)->first();
        // $event->session()->flash('info', "Event обновлен");
        return view("event/editEvent", ['event'=>$oneEv]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $a = $request->validate([
            'name'=>'required',
            'slug'=>'required',
            'date'=>'required'
        ]);
        $eventOne = Event::find($id);
        $eventOne->name = $request->name;
        $eventOne->slug = $request->slug;
        $eventOne->date = $request->date;
        $eventOne->save();
        $request->session()->flash('info', "Событие $request->name успешно обновлено");
        return redirect()->route('detail', $request->event_id);
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    public function apiGet()
    {   
        $ev = Event::all();
        $ev = $ev->fresh();
        $ev = $ev->fresh('organizers');
        // $org = $ev->load(['organizers']);
        return $ev;
        // $org = Organizer::all();
        // $mass = [
        //     'Even'=> $ev,
        //     'Organizer'=>$org

        // ];
        // return $mass;
        # code...
    }
}
