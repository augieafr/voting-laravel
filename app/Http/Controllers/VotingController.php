<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VotingModel;
class VotingController extends Controller
{
    public function index($status, $id){
        $peserta = VotingModel::where('id_event', $id)->get();

        return view('voting')->with('user', auth()->user())->with('id', $id)->with('status', $status)->with(['peserta'=>$peserta]);
    }

    public function addParticipant(Request $request){
        $peserta = new VotingModel();
        $peserta->nama_peserta = $request->nama;
        $peserta->id_event = $request->idevent;
        $peserta->score = 0;
        $peserta->save();
        
        return redirect()->route('participant', ['id'=>$peserta->id_event,'status'=>1 ]);
    }

    public function vote($id, $iduser){
        $peserta = VotingModel::find($id);
        $peserta->score = 1 + $peserta->score;
        $peserta->id_user = $iduser;
        $peserta->save();

        return redirect()->route('participant', ['id'=>$peserta->id_event,'status'=>1 ]);
    }
}
