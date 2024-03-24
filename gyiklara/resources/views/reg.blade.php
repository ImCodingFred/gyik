@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3>Regisztráció:</h3>
        <form action="/regisztracio" method="post">
            @csrf
            <label for="name" class="form-label">Felhasználónév:</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
            @error('name')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" class="form-control" value="{{old('email')}}">
            @error('email')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="password" class="form-label">Jelszó</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="password_confirmation" class="form-label">Jelszó megerősítése</label>
            <input type="password" name="password_confirmation" class="form-control">
            @error('password_confirmation')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="option" class="form-label">Neme:</label>
            <div class="w-100">
                <input type="radio" class="btn-check" name="option" id="option1" value="1" autocomplete="off" checked>
                <label class="btn btn-checkBox" for="option1">Férfi</label>

                <input type="radio" class="btn-check" name="option" id="option2" value="0" autocomplete="off">
                <label class="btn btn-checkBox" for="option2">Nő</label>

                <input type="radio" class="btn-check" name="option" id="option3" value="2" autocomplete="off">
                <label class="btn btn-checkBox" for="option3">Egyéb</label>
            </div>
            <label for="birth" class="form-label">Születési dátum:</label>
            <input type="date" name="birth" class="form-control" value="{{old('birth')}}">
            @error('birth')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-secondary mt-3 fs-4">Regisztráció</button>
        </form>
        <p class="mt-5">Van már fiókja? Akkor<a href="/belepes">jelentkezen be!</a></p>
    </div>
</main>
@endsection
