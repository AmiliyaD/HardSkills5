<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventTicket;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
class TicketController extends Controller
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
        $eve = Event::where('id', $id)->first();
        return view('tickets/createTicket', ['event'=>$eve]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $val = $request->validate([
            'name'=>'required',
            'cost'=>'required',
            'special_validity'=>'required'

        ]);
        $tick = new EventTicket;
        $tick->event_id = $id;
        $tick->name = $request->name;
        $tick->cost = $request->cost;
        $tick->special_validity = $request->special_validity;
        $tick->max_sold = $request->amount;
        $tick->date_until = $request->valid_until;
        $tick->save();
        $request->session()->flash('info', "Ticket $request->name успешно создан!");
        return redirect()->route('detail', $request->event_id);
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
