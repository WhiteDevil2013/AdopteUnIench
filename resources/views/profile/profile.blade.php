@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $profile->username }}</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        @if($profile->isAnimal)
                            @if(!$profile->sexe)
                                <p>{{ $profile->race }} mâle</p>
                            @else
                                <p>{{ $profile->race }} femelle</p>
                            @endif
                        @else
                            @if($profile->sexe)
                                <p>Homme</p>
                            @else
                                <p>Femme</p>
                            @endif
                        @endif

                        <p>{{ $profile->description }}</p>
                        <p>Habite à {{ $profile->location }}</p>
                        <p>Né le {{ $profile->birthDate }}</p>
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
