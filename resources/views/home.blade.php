@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Menu Principal</div>

                <div class="panel-body">
                    <h3>Ces profils peuvent vous interesser :</h3>
                    <br />
                    @foreach ($profiles as $profile)
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $profile->username }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-9">
                                <p>{{ $profile->race }}</p>
                                <p>{{ $profile->description }}</p>
                                <p>Habite à {{ $profile->location }}</p>
                                <br />
                                <div class="row">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-info">
                                        Voir plus
                                    </button>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
