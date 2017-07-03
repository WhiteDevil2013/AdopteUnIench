@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{ route('profile') }}">
                <div class="panel panel-info">
                    <div class="panel-heading">

                        <h3 class="panel-title">
                            <div class="col-md-8 form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <input id="username" type="text" class="form-control" name="username" value="{{ $profile->username }}" required autofocus>
                                @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </h3><br/><br/>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="col-md-8">
                                <div class="col-md-12 form-group{{ $errors->has('race') ? ' has-error' : '' }}">
                                    <label class="col-md-7 control-label">Genre</label>
                                    <select id="race" class="form-control" name="race" required>
                                        <option value="human">Humain</option>
                                        <option value="dog">Chien</option>
                                        <option value="cat">Chat</option>
                                        <option value="horse">Cheval</option>
                                        <option value="redpanda">Panda Roux</option>
                                        <option value="turtle">Tortue</option>
                                        <option value="bird">Oiseau</option>
                                        <option value="mouse">Souris</option>
                                    </select>
                                    @if ($errors->has('race'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('race') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                    <label class="col-md-7 control-label">Sexe</label>
                                    <select id="sex" class="form-control" name="sex" required>
                                        <option value="0">Mâle</option>
                                        <option value="1">Femelle</option>
                                    </select>
                                    @if ($errors->has('sex'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('sex') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label class="col-md-7 control-label">Description</label>
                                    <textarea style="resize: none" id="description" class="form-control" name="description" cols="50" rows="10" required autofocus>{{ $profile->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                    <label class="col-md-7 control-label">Ville</label>
                                    <input type="text" id="location" class="form-control" name="location" value="{{ $profile->location }}" required autofocus><br/>
                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group{{ $errors->has('birthDate') ? ' has-error' : '' }}">
                                    <label class="control-label">Date de naissance</label>
                                    <input type="date" placeholder="jj/mm/aaaa" id="birthDate" class="form-control" name="birthDate" value="{{ $profile->birthDate }}" required autofocus><br/>
                                    @if ($errors->has('birthDate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($profile->profilePicture)) }}"
                                 alt="Profile Image" width="200" height="200" class="img-rounded">
                        </div>
                        <div class="col-md-12" style="justify-content: center; display:flex;">
                            <button type="submit" class="btn btn-success" style="margin-right: 10px;">Valider</button>
                            <button type="button" class="btn btn-warning" onclick='window.location="{{ route("profile") }}"'>Retour</button>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
