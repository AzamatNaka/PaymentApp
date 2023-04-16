@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('client.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-4">
                                {{ Form::label('phone', 'Номер телефона(Логин)', ['class' => 'col-form-label text-md-end']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::tel('phone', null, ['class' => "form-control", 'required' => 'required']) }}
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                {{ Form::label('password', __('Password'), ['class' => 'col-form-label text-md-end']) }}
                            </div>
                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'current-password']) }}
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{route('login.form')}}">Login as business</a>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
