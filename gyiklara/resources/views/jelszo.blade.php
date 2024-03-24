@extends('layout')
@section('content')
<main class="container">
    <div class="mt-5 w-75 mx-auto">
        <h3>Jelszó módosítása:</h3>
        <form action="/jelszomod" method="post">
            @csrf
            @error('alert')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror
            @error('success')
                <p class="text-center text-success">{{$message}}</p>
            @enderror

            <label for="old" class="form-label">Régi Jelszó</label>
            <input type="password" name="old" class="form-control">
            @error('old')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="password" class="form-label">Új Jelszó</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <label for="password_confirmation" class="form-label">Új Jelszó megerősítése</label>
            <input type="password" name="password_confirmation" class="form-control">
            @error('password_confirmation')
                <p class="text-center text-danger">{{$message}}</p>
            @enderror

            <button type="submit" class="btn btn-secondary mt-3 fs-4">Mentés</button>
        </form>
    </div>
</main>
@endsection
