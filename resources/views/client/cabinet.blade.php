@extends('layouts.app')

@section('title', "Client PAGE")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cabinet Client') }}</div>

                    <div class="card-body">
                        <p>{{ __('Welcome') }}, {{ $client->name }}!</p>
                        <p>{{ __('Your balance is') }}: {{ $client->balance }} {{ __('KZT') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
