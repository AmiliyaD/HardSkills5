<?php

namespace App\Http\Controllers;
use App\Models\Channel;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Room;
class RoomController extends Controller
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
        $channel = Channel::where('event_id', $id)->get();
        $oneEv = Event::where('id', $id)->first();
        return view('rooms/createRoom', ['roomEvent'=>$oneEv, 'channelGet'=>$channel]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'capacity'=>'required'
        ]);
        $room = new Room;
        $room->channel_id = intval($request->channel);
        $room->name = $request->name;
        $room->capacity = $request->capacity;
        $room->save();
        $request->session()->flash('info', "Room $request->name успешно создан");
        return redirect()->route('detail', ['id'=>$request->event_id]);
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
    public function edit($id)
    {
        //
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
