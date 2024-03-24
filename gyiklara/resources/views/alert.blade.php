@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3 class="text-center">Szia {{$name}}! ;)</h3>
        <p>Biztos, hogy törlöd a felhasználódat? Pedig annyi szép élmény vár még rád itt!</p>
        <p>
            <a href="/del" class="btn btn-danger">Igen</a>
            <a href="/profil" class="btn btn-success">Nem</a>
        </p>
    </div>
</main>
@endsection
