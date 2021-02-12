<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
    <title>Event Backend</title>
    @include('css')
    <base href="./">
    <!-- Bootstrap core CSS -->
    @include('flash')
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-6 mx-sm-auto px-4">
            <div class="pt-3 pb-2 mb-3 border-bottom text-center">
                <h1 class="h2">WorldSkills Event Platform</h1>
            </div>

            <form class="form-signin" method="POST" action="{{ route('getAuth') }}">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <x-label for="email" :value="__('Email')" />
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>

                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" required placeholder="Password">
                <button class="btn btn-lg btn-primary btn-block" id="login" type="submit">{{ __('Login') }}</button>
            </form>

        </main>
    </div>
</div>
</body>
</html>
