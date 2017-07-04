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
                        <br />
                        @if($profile->id != $user_profile_id)
                        <div class="row">
                            <div class="col-md-2">
                                @if (in_array($profile->id, $notMatched))
                                <form method="POST" action="{{ route('deleteMatch',  $profile->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-warning">
                                        En attente de match !
                                    </button>
                                </form>
                                @else
                                @if (in_array($profile->id, $matches))
                                <form class="form-horizontal" method="GET" action="{{ route('discuss') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="profile_id" id="profile_id" value="{{ $profile->id }}">

                                    <button type="submit" class="btn btn-success">
                                        Discuter
                                    </button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('profileMatch',  $profile->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info">
                                        Matcher
                                    </button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </div>
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
