@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user->role =='eo')
                    <fieldset>
                        <p>Add Event</p>
                        <form action="{{url('/add')}}" method="post">
                            @csrf
                            <input type="text" name="idevent" id="eventid" placeholder="ID" value="">
                            <input type="text" name="nama" id="namaevent" placeholder="Nama" value="">
                            <input type="hidden" name="email" value="{{$user->email}}">
                            <input type="submit" value="Add">
                        </form>
                    </fieldset></br></br>
                        <table> 
                            <tr>
                                <th style="text-align:center;"colspan="5">Event Anda</th>
                             </tr>
                            <?php $no=1; ?>
                            <tr>
                                <th>No</th>
                                <th colspan='2'>Event</th>
                                <th>Lihat</th>
                                <th>Close</th>
                            </tr>
                        @if(!$event->isEmpty())
                            @foreach($event as $myevent)
                            @if($user->email == $myevent->email)
                            <tr>
                                <td>{{$no}}</td>
                                <td colspan=2>{{$myevent->nama}}</td>
                                <td><a href='{{url("/detail/$myevent->status/$myevent->id_event")}}'>Lihat</a></td>
                                    @if($myevent->status == '1')
                                        <td><a href='{{url("/close/$myevent->id_event")}}'>Close Vote</a></td>
                                            @else
                                            <td>Closed</td>
                                    @endif
                                @php
                                    $no++
                                @endphp
                            </tr>
                            @endif
                            @endforeach
                        @else
                            <tr>
                                <td style="text-align:center;"colspan="5">No Data</td>
                            </tr>
                        @endif
                        </table>
                    @else  
                        <table>
                            <tr>
                                <th style="text-align:center;"colspan=4>Vote Now</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            <tr>
                                <th>No</th>
                                <th colspan=2>Nama Event</th>
                                <th>Vote</th>
                            </tr>
                            @foreach ($event as $myevent)
                            @if ($myevent->status == 1)
                            <tr>
                                <td>{{$no++}}</td>
                                <td colspan=2>{{$myevent->nama}}</td>
                                <td><a href={{url("/detail/$myevent->status/$myevent->id_event")}}>Vote</a></td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
