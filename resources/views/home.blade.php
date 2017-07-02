@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Menu Principal</div>

                <div class="panel-body">
                    Vous êtes maintenant connecté !

                    <h3>Ces profils peuvent vous interesser :</h3>
                    @foreach ($profiles as $profile)
                    <p>{{ $profile->username }} : {{ $profile->race}}</p>
                    <p>{{ $profile->description }}</p>
                    <p>Habite à {{ $profile->location }}</p>
                    <br />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
