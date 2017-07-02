@extends('layouts.app')

@section('content')
<?php use AdopteUnIench\Http\Controllers\ProfileController;?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Menu Principal</div>

                <div class="panel-body">
                    <h3>Ces profils peuvent vous intéresser :</h3>
                    <br />
                    @foreach ($profiles as $profile)
                    @if ($profile->id != Auth::user()->profile_id)
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                {{ $profile->username }}
                                @if ($profile->sex == 0)
                                    <img src="images/male.svg" width="10" height="10">
                                @else
                                    <img src="images/female.svg" width="10" height="10">
                                @endif
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-9">
                                <p><strong>{{ ProfileController::tradRace($profile->race) }}</strong></p>
                                <p>{{ $profile->description }}</p>
                                <p>Habite à {{ $profile->location }}</p>
                                <br />
                                <div class="row">
                                <div class="col-md-2">
                                    <form method="GET" action="{{ route('profileShow', $profile->id) }}">
                                        <button type="submit" class="btn btn-info">
                                            Voir plus
                                        </button>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">
                                        Matcher
                                    </button>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($profile->profilePicture)) }}"
                                     width="140" height="140" class="img-rounded">
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
