@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Conversation avec {{ $friend_profile->username }}</div>
                <div class="panel-body">

                    <div style="max-height: 550px; overflow-x: auto;">
                        @foreach ($messages as $msg)
                            @if ($msg->sender_id == $profile->id)
                                <div class="panel panel-success">
                                    <div class="panel-heading" style="display: flex; align-items: center; justify-content: flex-end;">
                                        <h5 style="position: relative; right: 60%;">{{ $msg->sendDateTime }}</h5>
                                        <h3 class="panel-title">{{ $profile->username }}</h3>
                                        <div class="col-md-1">
                                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($profile->profilePicture)) }}"
                                                 width="30" height="30" class="img-rounded">
                                        </div>
                                    </div>
                                    <div class="panel-body" style="display: flex; align-items: center;">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @else
                                <div class="panel panel-info ">
                                    <div class="panel-heading" style="display: flex; align-items: center;">
                                        <div class="col-md-1">
                                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($friend_profile->profilePicture)) }}"
                                                 width="30" height="30" class="img-rounded">
                                        </div>
                                        <h3 class="panel-title">{{ $friend_profile->username }}</h3>
                                        <h5 style="position: relative; left: 60%;">{{ $msg->sendDateTime }}</h5>
                                    </div>
                                    <div class="panel-body" style="display: flex; align-items: center;">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('sendMessage') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="message" class="control-label">Message</label>

                                <div class="col-md-13">
                                    <textarea style="resize: none" id="message" class="form-control" name="message" cols="50" rows="5" required autofocus>{{ old('message') }}</textarea>

                                    @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <input type="hidden" id="friend_id" name="friend_id" value="{{$friend_profile->id}}">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
