<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{URL::asset('base.css')}}">
    @stack('css')

  </head>
<body>
    <header class="p-3 bg-dark text-white mb-3">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{route('home')}}" class="nav-link px-2 @if ($current_view == 'home') text-secondary @else text-white @endif">Galeria</a></li>
          <li><a href="{{route('upload')}}" class="nav-link px-2 @if ($current_view == 'produtos-create') text-secondary @else text-white @endif">Inserir Produto</a></li>
        </ul>
      </div>
    </div>
  </header>

    <div class="container">
        <div class="row">
            <h1>@yield('h1')</h1>
            <hr>
        </div>

        <!-- Conteúdo -->
        @yield('content')

    </div>
</body>

@stack('scripts')

</html>