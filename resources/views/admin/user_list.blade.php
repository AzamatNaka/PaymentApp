@extends('layouts.adm')

@section('title', "Admin Page User List")

@section('content')
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                @foreach($users as $user)
                    <div class="card mb-4">
                        <h5 class="card-header">{{$user->name}}</h5>
                        <div class="card-body">
                            <p>Role:
                                @foreach($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </p>
                            <p>
                                @if($role->name == 'business')
                                    {{$user->email}}
                                @endif

                                @if($role->name == 'client')
                                        {{$user->phone}}
                                @endif


                            </p>
                            <a href="#" class="btn btn-primary">Edit</a>
                            <form action="#" method="POST" style="display: inline-block; background-color: #ef4444">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
