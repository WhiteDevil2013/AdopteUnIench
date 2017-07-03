@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Messagerie</div>
                <div class="panel-body">

                        @foreach ($conversation as $conv)
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $conv->username }}</h3>
                            </div>
                            <div class="panel-body" style="display: flex; align-items: center;">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <form method="GET" action="{{ route('profileShow', $conv->id) }}">

                                                <input type="hidden" name="profile_id" id="profile_id" value="{{ $conv->id }}">

                                                <button type="submit" class="btn btn-info">
                                                    Accèder au profil
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-3">
                                            <form class="form-horizontal" method="GET" action="{{ route('discuss') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="profile_id" id="profile_id" value="{{ $conv->id }}">

                                                <button type="submit" class="btn btn-success">
                                                    Discuter
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <form class="form-horizontal" method="POST" action="{{ route('delete') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="profile_id" id="profile_id" value="{{ $conv->id }}">

                                                <button type="submit" class="btn btn-danger">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img src="data:image/jpeg;base64,{{ base64_encode(Storage::disk('images')->get($conv->profilePicture)) }}"
                                         width="140" height="140" class="img-rounded">
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
