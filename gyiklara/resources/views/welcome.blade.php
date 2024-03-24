@extends('layout')
@section('content')
<main class="container">
    <section>
       <h2 class="my-4">Legutóbbi kérdések:</h2>
       <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
            @foreach ($result as $row)
            <a href="/tema/{{$row->id}}">
                <div class="col">
                    <div class="card bg-secondary p-2 mb-2">
                    <h5 class="text-center">@if ($row->anonim ==1) anonim @else {{$row->name}} @endif</h5>
                    <p class="fs-5">
                        {{$row->question}}
                    </p>
                    </div>
                </div>
            </a>
            @endforeach
       </div>
    </section>
    <section>
      <h2 class="my-4"><span class="material-symbols-rounded">add_notes</span>új téma</h2>
      <p class="fs-5">új téma létrehozása: <a href="/letrehozas">link</a></p>
    </section>
 </main>
@endsection
