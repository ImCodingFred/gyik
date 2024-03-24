@extends('layout')
@section('content')
<section class="container">
    <h2 class="my-4"><span class="material-symbols-rounded fs-2 pt-3">search</span>Kereső</h2>
    <form action="/kereses" method="post">
        @csrf
      <div class="input-group">
        <input type="search" name="search" class="form-control fs-2 py-2" aria-describedby="search">
        <button type="submit" class="btn btn-success fs-2 py-2" id="search">Keresés</button>
      </div>
      @error('search')
        <div class="text-danger">{{ $message }}</div>
      @enderror
     <div class="w-100 text-center mt-3">
         <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked value="tema">
        <label class="btn btn-checkBox" for="option1">Téma</label>

        <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off" value="hozzaszolas">
        <label class="btn btn-checkBox" for="option2">Hozzászólás</label>

        <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" value="felhasznalo">
        <label class="btn btn-checkBox" for="option3">Felhasználó</label>
                      </div>
    </form>
  </section>
    <section class="container">
        @if ($_SERVER['REQUEST_METHOD'] == 'POST')
            <h2 class="my-4"><span class="material-symbols-rounded fs-2 pt-3">search</span>Keresési eredmények</h2>
        @endif
        <div class="row">
            @if (request()->options == 'tema')
                @foreach ($questions as $question)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Kérdés: {{ $question->question }}</h5>
                                <p class="card-text">Kérdező: {{ $question->name }}</p>
                                <a href="/tema/{{ $question->id }}" class="btn btn-secondary">Kérdés megnyitása</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @elseif (request()->options == 'hozzaszolas')
                @foreach ($answers as $answer)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Írta: {{ $answer->name }}</h5>
                                <p class="card-text">Üzenet: {{ $answer->answer }}</p>
                            </div>
                        </div>
                    </div>

                @endforeach
            @elseif (request()->options == 'felhasznalo')
                @foreach ($users as $user)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <img src="{{ $user->profil_pic }}" alt="" width="100px">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $user->name }}</h5>
                                <p class="card-text">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>

@endsection
