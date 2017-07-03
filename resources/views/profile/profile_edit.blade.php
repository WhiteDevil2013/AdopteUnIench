@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('profile') }}">
                <div class="panel panel-info">
                    <div class="panel-heading">

                        <h3 class="panel-title">
                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $profile->username }}" required autofocus>
                            </div>
                            <div class="col-md-3">
                                <button style="max-width: 50px; max-height: 50px;"><img src="{{ URL::to('/') }}/images/validate.svg"/></button>
                                <button style="max-width: 50px; max-height: 50px;"><img src="{{ URL::to('/') }}/images/delete.svg"/></button>
                            </div>
                        </h3><br/><br/>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="col-md-8">
                                <select id="race" class="form-control" name="race" required>
                                    <option value="human">Humain</option>
                                    <option value="dog">Chien</option>
                                    <option value="cat">Chat</option>
                                    <option value="horse">Cheval</option>
                                    <option value="redpanda">Panda Roux</option>
                                    <option value="turtle">Tortue</option>
                                    <option value="bird">Oiseau</option>
                                    <option value="mouse">Souris</option>
                                </select><br/>
                                <select id="sex" class="form-control" name="sex" required>
                                    <option value="0">Mâle</option>
                                    <option value="1">Femelle</option>
                                </select><br/>
                                <textarea style="resize: none" id="description" class="form-control" name="description" cols="50" rows="10" required autofocus>{{ $profile->description }}</textarea><br/>

                                <label class="col-md-7 control-label">Ville</label>
                                <input type="text" id="location" class="form-control" name="location" value="{{ $profile->location }}" required autofocus><br/>

                                <label class="col-md-7 control-label">Date de naissance</label>
                                <input type="date" placeholder="jj/mm/aaaa" id="birthDate" class="form-control" name="birthDate" value="{{ $profile->birthDate }}" required autofocus><br/>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($profile->profilePicture)) }}"
                                 alt="Profile Image" width="200" height="200" class="img-rounded">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
