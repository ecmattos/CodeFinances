@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col s6 offset-s3 z-depth-1">
            <h3 class="center">
                Code Financeiro
            </h3>
            <h4 class="center">
                Administração
            </h4>

            <form method="POST" action="{{ env('URL_ADMIN_LOGIN') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s12">
                        <?php $messageError = $errors->has('email') ? "data-error='{$errors->first('email')}'" : null ?>
                        <input id="email" type="email" class="validate {{ $messageError ? 'invalid' : $messageError }}" name="email" value="{{ old('email') }}" required autofocus>
                        <label for="email" {!! $messageError !!}>E-Mail</label> 
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <?php $messageError = $errors->has('password') ? "data-error='{$errors->first('password')}'" : null ?>
                        <input id="password" type="password" class="validate {{ $messageError ? 'invalid' : $messageError }}" name="password" value="{{ old('password') }}" required>
                        <label for="password" {!! $messageError !!}>Senha</label> 
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Lembrar-me</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button type="submit" class="btn">Login</button>
                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Esqueci minha senha</a>
                    </div>
                </div>
            </form>        
        </div>
    </div>
</div>
@endsection
