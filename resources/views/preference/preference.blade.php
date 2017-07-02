@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Préférences</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="@if($preferences) {{ route('preferenceUpdate') }} @else {{ route('preferenceCreate') }} @endif" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if ($race == 'human')
                        <div class="form-group{{ $errors->has('race') ? ' has-error' : '' }}">
                            <label for="race" class="col-md-4 control-label">Quelle(s) race(s) d'animal/animaux souhaitez-vous rencontrer ? (Plusieurs choix possibles)</label>

                            <div class="col-md-6">
                                <select id="race" class="form-control" name="races[]" size="7" multiple required>
                                    <option value="dog">Chien</option>
                                    <option value="cat">Chat</option>
                                    <option value="horse">Cheval</option>
                                    <option value="redpanda">Panda Roux</option>
                                    <option value="turtle">Tortue</option>
                                    <option value="bird">Oiseau</option>
                                    <option value="mouse">Souris</option>
                                </select>
                            </div>
                        </div>
                        @endif

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">Sexe</label>

                            <div class="col-md-6">
                                <select id="sex" class="form-control" name="sex" required>
                                    <option {{ $preferences->sex == 0 ? 'selected' : '' }} value='0'>Male</option>
                                    <option {{ $preferences->sex == 1 ? 'selected' : '' }} value='1'>Femelle</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Ville</label>

                            <div class="col-md-6">
                                <input type="text" id="location" class="form-control" name="location" value="{{ $preferences->location }}" required autofocus>

                                @if ($errors->has('location'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Mettre à jour les préférences
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
