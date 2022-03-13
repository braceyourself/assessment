@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>Please Log in</h1>
                        <form action="/login" method="post">
                            {{csrf_field()}}
                            <div class="flex flex-column mb-4">

                                <label class="w-100">Email
                                    <input type="email" name="username" class="form-control">
                                </label>
                                <label class="w-100">Password
                                    <input type="password" name="password" class="form-control">
                                </label>

                            </div>

                            <button class="form-control btn-outline-blue">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
