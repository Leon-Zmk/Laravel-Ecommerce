<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{asset("plugins/fontawesome-free/css/all.min.css")}}>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href={{asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{asset("css/admin_css/adminlte.min.css")}}>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Pandora</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register</p>
      @if(session("status"))
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Error </strong>
        {{session("status")}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif


      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row mb-2">
            <label for="name" class="col-md-12 col-form-label text-md-end">{{ __('Name') }}</label>

            <div class="col-md-12">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row 2">
            <label for="email" class="col-md-12 col-form-label text-md-end">Email Address</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row 2">
            <label for="password" class="col-md-12 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row 2">
            <label for="password-confirm" class="col-md-12 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
      <!-- /.social-auth-links -->

    
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src={{asset("plugins/jquery/jquery.min.js")}}></script>
<!-- Bootstrap 4 -->
<script src={{asset("plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
<!-- AdminLTE App -->
<script src={{asset("dist/js/adminlte.min.js")}}></script>
</body>
</html>

