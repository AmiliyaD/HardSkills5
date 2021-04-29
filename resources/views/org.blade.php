<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <title>Event Backend</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <base href="./">
    <!-- Bootstrap core CSS -->
    {{-- @include('flash') --}}
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-6 mx-sm-auto px-4">
            <div class="pt-3 pb-2 mb-3 border-bottom text-center">
                <h1 class="h2">Платформа WorldSkills</h1>
            </div>

            <form class="form-signin" method="POST" action="{{ route('check') }}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Авторизируйтесь</h1>
                {{-- <x-label for="email" :value="__('Email')" /> --}}
                <label for="inputEmail" class="sr-only">Емайл</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Емайл" required autofocus>

                <label for="inputPassword" class="sr-only">Пароль</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required placeholder="Пароль">
                <button class="btn btn-lg btn-primary btn-block" id="login" type="submit">{{ __('Login') }}</button>
            </form>
          
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        </main>
    </div>
</div>
</body>
</html>
