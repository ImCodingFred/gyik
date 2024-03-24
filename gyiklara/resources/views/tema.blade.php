@extends('layout')
@section('content')
<header>
    <main class="container">
        <div class="mt-5 w-75 mx-auto">
            <h3>Új téma létrehozása:</h3>
            <form action="/letrehozas" method="post">
                @csrf
                <textarea name="question" cols="100" rows="5" class="form-control fs-5"></textarea>
                @error('question')
                    <p class="text-danger"><b>{{$message}}</b></p>
                @enderror
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="anonim">
                    <label class="form-check-label" for="anonim">
                        Anonim
                    </label>
                </div>
                <button type="submit" class="btn btn-secondary mt-3 fs-4">Beküldés</button>
            </form>
        </div>
     </main>
@endsection
