<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYÍKoldal</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mystyle.css')}}">
    <script src="{{asset('assets/js/bootstrap.bundle.js')}}"></script>
    <link rel="shortcut icon" href="{{asset('assets/img/gyik.png')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
   <header>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="/">
            <img src="{{asset('assets/img/gyik.png')}}" alt="gyik.png">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="/temak">Témák</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/letrehozas">Téma létrehozása</a>
              </li>
            </ul>
          </div>
          <div class="icons">
            <a href="/kereses"><span class="material-symbols-rounded">search</span></a>
            @guest
            <a href="/belepes"><span class="material-symbols-rounded">login</span></a>
            @else
            <a href="/kijelentkezes"><span class="material-symbols-rounded">logout</span></a>
            <a href="/profil"><span class="material-symbols-rounded">account_circle</span></a>
            @endguest
          </div>
        </div>
      </nav>
   </header>
   @yield('content')
   <footer class="container mt-5">
      <hr class="w-50 mx-auto mt-4 mb-1">
      <div class="d-flex justify-content-center">
        <ul>
          <li><a href="/szabalyzat">szabályzat</a></li>
          <li><a href="/impresszum">impresszum</a></li>
          <li><a href="/jog">Jogi nyilatkozat</a></li>
          <li><a href="/adatvedelem">Adatvédelmi nyilatkozat</a></li>
        </ul>

      </div>
   </footer>
</body>
</html>
