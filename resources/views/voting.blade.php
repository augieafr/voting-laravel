@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Event</div>
                <div class="card-body">
                    @if($status != 0 && $user->role == 'eo')
                    <fieldset>
                        <p>Add Participant</p>
                        <form action="{{url('/addparticipant')}}" method="post">
                            @csrf
                        <input type="hidden" name="idevent" id="eventid" value="{{$id}}">
                            <input type="text" name="nama" id="namaevent" placeholder="Nama" value="">
                            <input type="submit" value="Add">
                        </form>
                    </fieldset></br></br>
                    @endif
                        <table> 
                            <tr>
                                <th style="text-align:center;"colspan="5">Participant</th>
                             </tr>
                            <?php $no=1; ?>
                            <tr>
                                <th>No</th>
                                <th colspan='2'>Nama</th>
                                @if ($user->role == 'eo')
                                    <th>Score</th>
                                    @else
                                        <th>Vote</th>    
                                @endif
                                
                            </tr>
                        @if(!$peserta->isEmpty())
                            @foreach($peserta as $participant)
                            <tr>
                                <td><?php echo($no) ?></td>
                                <td colspan=2>{{$participant->nama_peserta}}</td>
                                @if($user->role == 'eo')
                                    <td>{{$participant->score}}</td>
                                    @else
                                    @if($user->id != $participant->id_user)
                                    <td><a href="{{url("/vote/$participant->id/$user->id")}}">Vote</a></td>
                                    @else
                                        <td>Voted</td>
                                    @endif
                                @endif
                                <?php $no++ ?>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td style="text-align:center;"colspan="5">No Data</td>
                            </tr>
                        @endif
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
