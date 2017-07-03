@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ $profile->username }}
                        @if($profile->id == $user_profile_id)
                            <a href="{{ route('profileEdit') }}">
                                <img src="{{ URL::to('/') }}/images/edit.svg" width="15" height="15">
                            </a>
                        @endif
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        @if($profile->isAnimal)
                            @if($profile->sex)
                                <p>{{ $profile->race }} Femelle</p>
                            @else
                                <p>{{ $profile->race }} Mâle</p>
                            @endif
                        @else
                            @if($profile->sex)
                                <p>Femme</p>
                            @else
                                <p>Homme</p>
                            @endif
                        @endif

                        <p>{{ $profile->description }}</p>
                        <p>Habite à {{ $profile->location }}</p>
                        @if($profile->sex)
                            <p>Née le {{ $profile->birthDate }}</p>
                        @else
                            <p>Né le {{ $profile->birthDate }}</p>
                        @endif
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
