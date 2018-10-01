<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('guest.includes.head-content')
    <!-- Page Specific CSS -->
    @yield('pg-specific-css')
</head>
<body id="body-guest">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" id="navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="font-weight: bold;color: maroon; ">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
  <div class="container-fluid" style="padding:0;margin:0;">
    @include('guest.includes.messages')
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>
        
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="firstname" class="col-md-4 col-form-label text-md-right">Firstname</label>
        
                                    <div class="col-md-6">
                                        <input id="firstname" type="text" class="form-control{{ $errors->has('str_first_name') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('str_first_name') }}" required autofocus>
                                        @if ($errors->has('str_first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('str_first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="middlename" class="col-md-4 col-form-label text-md-right">Middlename</label>
        
                                    <div class="col-md-6">
                                        <input id="middlename" type="text" class="form-control{{ $errors->has('str_middle_name') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('str_middle_name') }}" required autofocus>
                                        @if ($errors->has('str_middle_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('str_middle_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-right">Lastname</label>
        
                                    <div class="col-md-6">
                                        <input id="lastname" type="text" class="form-control{{ $errors->has('str_last_name') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('str_last_name') }}" required autofocus>
                                        @if ($errors->has('str_first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('str_first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
        
                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control{{ $errors->has('str_username') ? ' is-invalid' : '' }}" name="username" value="{{ old('str_username') }}" required autofocus>
                                        @if ($errors->has('str_username'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('str_username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        <p class="form-text text-muted">Note: Password must be consists of at least six characters (and the more characters, the stronger the password) that are a combination of letters, numbers and symbols (@, #, $, %, etc.).</p>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        @captcha
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
  </div>
  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.0.min.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('vali/js/plugins/pace.min.js') }}"></script>
  <!-- Page Specific Javascripts -->
  @yield('pg-specific-js')
  
</body>
</html>

