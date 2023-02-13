<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{asset('css/login.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">
    <form method="POST" action="adlogin">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') fild_danger @enderror" name="email" autocomplete="email" autofocus required value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>                                     
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') fild_danger @enderror" name="password" autocomplete="current-password" required>
                                @error('password')
                                <span class="text-danger">{{$message}}</span>  
                                @enderror
                            </div>
                        </div>
                        @if(Session::has('error'))
                                    <span>
                                        <strong class="text-danger">{{ Session('error') }}</strong>
                                    </span>
                                @endif

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
</form>
    </body>
</html>
