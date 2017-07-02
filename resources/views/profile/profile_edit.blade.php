@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ $profile->username }}
                        <a href="{{ route('profile') }}">
                            <img src="{{ URL::to('/') }}/images/validate.svg" width="15" height="15">
                            <img src="{{ URL::to('/') }}/images/delete.svg" width="17" height="17">
                        </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        @if($profile->isAnimal)
                            @if($profile->sex)
                                <p>{{ $profile->race }} femelle</p>
                            @else
                                <p>{{ $profile->race }} mâle</p>
                            @endif
                        @else
                            @if($profile->sex)
                                <p>Femme</p>
                            @else
                                <p>Homme</p>
                            @endif
                        @endif

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea style="resize: none" id="description" class="form-control" name="description" cols="50" rows="10" required autofocus>{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-md-4 control-label">Ville</label>

                            <div class="col-md-6">
                                <input type="text" id="location" class="form-control" name="location" value="{{ old('location') }}" required autofocus>

                                @if ($errors->has('location'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birthDate') ? ' has-error' : '' }}">
                            <label for="birthDate" class="col-md-4 control-label">Date de naissance</label>

                            <div class="col-md-6">
                                <input type="date" placeholder="jj/mm/aaaa" id="birthDate" class="form-control" name="birthDate" value="{{ old('birthDate') }}" required autofocus>

                                @if ($errors->has('birthDate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($profile->profilePicture)) }}"
                             alt="Profile Image" width="200" height="200" class="img-rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
