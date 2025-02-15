@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <table><tr><td width=90%><h4>The Happening Parties</h4></td>
                    <td><a href="{{route('events.create')}}" class="btn btn-success btn-sm glyphicon glyphicon-plus">Post Your Event</a>
                    </td></tr></table>
                </div>
        
        
        
        <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                
                 
                <div class="w3-row-padding w3-theme">
                @foreach($event as $event => $value)            
                    
                        <div class="w3-card-4">
                                <div class="w3-container">
                                    <h4><strong>{{ $value->title }}</strong></h4>
                                    <p>{{ $value->description }}</p>
                                    <p>Date <strong>{{ $value->date }}</strong></p>
                                    <p>Venue <strong>{{ $value->venue }}</strong></p>
                                    <img src="{{url($value->image? 'uploads/'.$value->image:'images/noimage.jpg')}}" style="width:100%">
                                    <br><hr>

                                    <?php
                                        //$event = App\User::find(1);
                                        $number_of_attendants=0;
                                        foreach ($value->users as $attendant)
                                        {
                                            $number_of_attendants++;
                                        }
                                    ?>
                                    <p>
                                    <button class="w3-button w3-green w3-round-large" style="width:100%"><h3>Attending( {{ $number_of_attendants }} )</h3>
                                    </button>
                                    </p>
                                    
                                    <?php
                                        $listcomments = $value->comments()->get();
                                        
                                    ?>

                                    @foreach ($listcomments as $listcomments) 
                                    <?php
                                        $commentwriters = $listcomments->user()->pluck('name');
                                    ?>
                                        <p><strong>{{ $commentwriters }}</strong> {{ $listcomments->comment }}</p>
                                    @endforeach
                                    
                                    {{ Form::open(['route'=>'comments.store', 'method'=>'POST','files'=> true]) }}
                                        <input type="hidden" name="event_id" value="{{ $value->id }}">

                                        @include('comments.form_master')
                                            
                                    {{ form::close() }}
                                    
                                    
                                
                                </div>
                        </div>
                <br><br> 
                @endforeach
                
                </div>

        </div>
        </div>
    </div>
</div>
@endsection