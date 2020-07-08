{{--  @extends('layouts.app')  --}}
@extends('control_panel.layouts.auth_layout')
@section('styles')
<style>
        .loader {
            display: block;
            margin: 20px auto 0;
            vertical-align: middle;
        }

        #preloader {
            width: 100%;
            height: 100%;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(255, 255, 255, 0.63);
            z-index: 11000;
            position: fixed;
            display: block;
        }

        .preloader {
            position: absolute;
            margin: 0 auto;
            left: 1%;
            right: 1%;
            top: 47%;
            width: 100px;
            height: 100px;
            background: center center no-repeat none;
            background-size: 65px 65px;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
        }
</style>    
@endsection

@section('content')
<div id="preloader" style="display: none">
    <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
</div>
<p class="login-box-msg">Sign in to manage</p>
    
    <form id="js-login" action="{{ route('login') }}" method="post">
    {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
        <input type="text" name="username" class="form-control" placeholder="username" value="{{ old('username') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('username'))
            <span class="help-block text-center">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" id="viewPwdLogin" name="password" class="form-control" placeholder="Password" required>
        {{-- <i class="fas fa-eye"></i> --}}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block text-center">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat btn-login">Sign In</button>
        </div>        
      </div>
    </form>
@endsection

@section('scripts')
    <script>      
        $('.btn-login').on('click', function () {
            $('#preloader').show();
        });
    </script>    
@endsection


