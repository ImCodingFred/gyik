@extends('layout')
@section('content')
    <main class="container">
        <div class="bg-secondary mt-5 py-5 pt-5 pb-2 text-center border border-dark rounded-3">
        <p class="fs-1">
            <q>{{$question->question}}</q>
        </p>
            <p class="text-end pe-4 mylink">- @if ($question->anonim==1)anonim @else {{$quser->name}}@endif</p>
        </div>
        @foreach ($answer as $row)
            <div class="bg-accent mt-5 my-5 p-3 border border-dark rounded-3  w-75 mx-auto">
                <p class="fs-4 mb-0">{{$row->answer}}</p>
                <p class="text-end pe-4 mylink">-  @if ($row->anonim==1)anonim @else {{$row->name}} @endif</p>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{$answer->links('pagination::bootstrap-4')}}
        </div>
        <div class="mt-5 w-75 mx-auto">
            <h3>Válasz:</h3>
            @guest
                <p>A válasz írásához <a href="/belepes">jelentkezzen be!</a></p>
            @else
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$question->id}}">
                    <textarea name="answer" cols="100" rows="5" class="form-control fs-5"></textarea>
                    @error('answer')
                    <p class="text-danger"><b>{{$message}}</b></p>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="anonim">
                        <label class="form-check-label" for="anonim">
                            Anonim válasz
                        </label>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3 fs-4">Beküldés</button>
                </form>
            @endguest
        </div>
    </main>
@endsection
