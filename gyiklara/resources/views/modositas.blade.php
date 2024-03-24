@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3>Profil szerkesztése:</h3>
        <form action="/mod" method="post">
            @csrf
            @error('alert')
                <p class="text-center text-success">{{$message}}</p>
            @enderror
            <label for="color" class="form-label">Színe:</label>
            <input type="text" name="color" class="form-control" value="@if ($color<>0) {{$color}} @endif">

            <label for="option" class="form-label">Neme:</label>
            <div class="w-100">
                <input type="radio" class="btn-check" name="option" id="option1" value="1" autocomplete="off" @if ($gender == 1) checked @endif>
                <label class="btn btn-checkBox" for="option1">Férfi</label>

                <input type="radio" class="btn-check" name="option" id="option2" value="0" autocomplete="off" @if ($gender == 0) checked @endif>
                <label class="btn btn-checkBox" for="option2">Nő</label>

                <input type="radio" class="btn-check" name="option" id="option3" value="2" autocomplete="off" @if ($gender == 2) checked @endif>
                <label class="btn btn-checkBox" for="option3">Egyéb</label>
            </div>
            <label for="birth" class="form-label">Születési dátum:</label>
            <input type="date" name="birth" class="form-control" value="{{$birth}}">
            @error('birth')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <label for="profile_pic" class="form-label">Profil kép linkje:</label>
            <input type="text" name="profile_pic" class="form-control" value="@if ($profile_pic<>0) {{$profile_pic}} @endif">
            @error('profile_pic')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-secondary mt-3 fs-4">Regisztráció</button>
        </form>
        <p class="mt-5">Van már fiókja? Akkor<a href="/belepes">jelentkezen be!</a></p>
    </div>
</main>
@endsection
