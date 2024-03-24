@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3 class="text-center">Szia {{$name}}! Legyen szép napod!! ;)</h3>
        <div class="row">
            <div class="col-sm-3">
                @if ($profil_pic == 0)
                    <p>
                        <img src="{{asset('assets/img/blank.jpg')}}" alt="blank.jpg" class="rounded-3 w-100">
                    </p>
                @else
                    <p>
                        <img src="{{$profil_pic}}" alt="blank.jpg" class="rounded-3 w-100">
                    </p>
                @endif
            </div>
            <div class="col-sm-9">
                <p><b>Felhasználónév:</b> {{$name}}</p>
                <p><b>Email:</b> <a href="mailto:{{$email}}">{{$email}}</a></p>
                <p><b>Szín:</b> @if ($color==0) - @else {{$color}} @endif</p>
                <p><b>Neme:</b> @if ($gender==0) Nő @elseif($gender==1) Férfi @else Egyéb/Nem adta meg @endif</p>
                <p><b>Születési dátum:</b> {{$birth}}</p>
                <p>
                    <a href="/mod">Profil módosítása</a> &nbsp;||&nbsp;
                    <a href="/jelszomod">Jelszó módosítása</a> &nbsp;||&nbsp;
                    <a href="/profil-torles">Profil törlése</a> &nbsp;||&nbsp;
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
