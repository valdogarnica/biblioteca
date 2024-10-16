@extends('layouts.auth-master')
<style>
    body {
        margin: 0;
        padding: 0;
        background-image: url('{{ asset('images/fondoLogin.jpg') }}'); /* Imagen de fondo */
        background-size: cover;
        background-position: center;
        font-family: 'Arial', sans-serif;
    }
    
    .login-container {
        width: 100%;
        height: calc(100vh - 160px); /* Ajusta la altura según las franjas superiores */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .login-box {
        background: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        text-align: center;
        width: 350px;
    }
    .login-box img {
        width: 120px;
        margin-bottom: 20px;
    }
    .login-box input {
        width: 100%;
        padding: 12px; /* Ajuste para mejor usabilidad */
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
        box-sizing: border-box; /* Asegura que el padding no desborde */
    }
    .login-box button {
        width: 100%;
        padding: 12px;
        background-color: #691C32; /* Color del botón */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
        box-sizing: border-box; /* Para alinear con los inputs */
    }
    .login-box button:hover {
        background-color: #4e1324; /* Color al pasar el mouse */
    }
    .login-box a {
        display: block;
        margin-top: 10px;
        color: #691C32;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .login-box a:hover {
        text-decoration: underline;
    }
    /* Estilo para las validaciones */
    input:invalid {
        border-color: red;
    }
    input:valid {
        border-color: green;
    }
</style>
@section('content')
<br>
<br>
<br>
<br>
    <div class="login-container">
        <div class="login-box">
            <!--img src="{{ asset('images/loboLogo.png') }}" alt="Mascota Lobos Blancos"--> <!-- Imagen de la mascota -->
            <form method="post" action="{{ route('register.perform') }}" class="container">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <img class="mb-4" src="{{ asset('images/loboLogo.png') }}" alt="" width="72" height="90">
                
                <h1 class="h3 mb-3 fw-normal">Crear Cuenta</h1>
        
                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Juan Perez" required="required" autofocus>
                    <label for="floatingEmail">Name</label>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group form-floating mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
                    <label for="floatingEmail">Email address</label>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <input type="number" class="form-control" name="username" value="{{ old('username') }}" placeholder="matricula" required="required" autofocus>
                    <label for="floatingName">Matricula
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div>
                
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                    <label for="floatingPassword">Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
        
                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                    <label for="floatingConfirmPassword">Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
        
                <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                <a href="/login">Iniciar Sesion</a>
                
                @include('auth.partials.copy')
            </form>
        </div>
    </div>
@endsection