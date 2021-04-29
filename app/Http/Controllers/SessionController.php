<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\NotificationServiceProvider;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Room;
use App\Models\Channel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use App\Http\Requests\RoomDateRequest;
use App\Rules\RoomDate;
use App\Rules\RoomEnd;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $rooms = Room::all();
        $eve = Event::where('id', $id)->first();
        $e = Session::find($id)->evId;
        $channelSes = Channel::where('event_id', $id)->get();
        return view('sessions/createSession', ['evSes'=>$eve,'ee'=>$e, 'channelSession'=>$channelSes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $session = new Session;
        // 'start'=>Rule::unique('sessions, start')->where(function ($query) {
        //     $query->where('room_id', $this->get('room_id'));
        // }),
        
 
        // Rule::unique('start')->where(function($query) {
        //     return $query->where($session->room, $request->room);
        // }),
   
        $roo = $request->room;
        $val = $request->validate([
            'type'=>'required',
            'title'=>'required',
            'speaker'=>'required',
            'room'=>'required',
            'cost'=>'required|numeric',
            'end' => ['required', new RoomEnd($request->room)]
   
        ]);
       
        $session->type = $request->type;
        $session->title = $request->title;
        $session->speaker = $request->speaker;
        $session->room_id = $request->room;
        $session->start = $request->start;
        $session->cost = $request->cost;
        $session->end = $request->end;
        $session->description = $request->description;
        $session->save();
        $request->session()->flash('info', "Сессия  $request->title успешно создана");
        return  redirect()->route('detail', ['id'=>$request->event_id]);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $sessionId)
    {
        $channelSes = Channel::where('event_id', $id)->get();
        $eve = Event::where('id', $id)->first();
        $sess = Session::where('id', $sessionId)->first();
        return view('sessions/editSession', ['event'=>$eve, 'session'=>$sess, 'channelSession'=>$channelSes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $val = $request->validate([
            'type'=>'required',
            'title'=>'required',
            'speaker'=>'required',
            'room'=>'required',
            'cost'=>'required|numeric',
        //     'start'=>Rule::unique('sessions, start')->where(function ($query) use ($roo)  {
        //     $query->where('room_id', $roo);
        // }),
            'start'=>'required|unique:sessions,start, room_id'."$request->room",
            'end'=>'required|unique:sessions,end, room_id'
        ]);
        $sess = Session::find($id);
        $sess->type = $request->type;
        $sess->title = $request->title;
        $sess->speaker = $request->speaker;
        $sess->room_id = $request->room;
        $sess->cost = $request->cost;
        $sess->start = $request->start;
        $sess->end = $request->end;
        $sess->save();
        $request->session()->flash('info', "Сессия  $request->title успешно обновлена");
        return  redirect()->route('detail', ['id'=>$request->event_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
