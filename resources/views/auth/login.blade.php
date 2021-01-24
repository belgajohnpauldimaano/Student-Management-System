{{--  @extends('layouts.app')  --}}
@extends('control_panel.layouts.auth_layout')

@section('content')
<div id="preloader" style="display: none">
    <img class="preloader" src="{{ asset('img/loader.gif')}}" alt="">
</div>


{{-- <p class="login-box-msg">Sign in to manage</p> --}}
    
    <form id="js-login" action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3 has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="username" name="username" class="form-control username" placeholder="username" value="{{ old('username') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <br/>
            @if ($errors->has('username'))
                <span class="help-block text-center">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <div class="input-group mb-3 has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" name="password" class="form-control password" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            <br/>
            @if ($errors->has('password'))
                <span class="help-block text-center">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-danger btn-block btn-login">Sign In</button>
            </div>        
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        if($('.username').val() !='' &&  $('.username').val() != '')
        {
            $('.btn-login').on('click', function () {
                $('#preloader').show();
            });
        }
    </script>
@endsection


