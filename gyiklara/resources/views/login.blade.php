@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3>Belépés:</h3>
        <form action="/belepes" method="post">
            @csrf
            @error('msg')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="credential" class="form-label">Felhasználónév vagy Email</label>
            <input type="text" name="credential" class="form-control">
            @error('credential')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-secondary mt-3 fs-4">Belépés</button>
        </form>
        <p class="mt-5">Ha regisztrálni szeretne <a href="/regisztracio">kattintson ide!</a></p>
    </div>
</main>
@endsection
