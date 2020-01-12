<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $event = null;
        $event = EventModel::all();
        return view('home')->with('user', $user)->with(['event'=>$event]);
    }

    public function close($id)
    {
        $event = EventModel::where('id_event', $id)->update(['status'=>0]);
        return redirect()->route('home');
    }

    public function add(Request $request){
        $event = new EventModel();
        $event->email = $request->email;
        $event->id_event = $request->idevent;
        $event->nama = $request->nama;
        $event->status = 1;
        $event->save();

        return redirect()->route('home');
    }
}
