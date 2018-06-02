@extends('layouts.app')

@section('content')

                    <form class="form-signin" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <h3 class="text-center">Registration Form </h3>
                        <label for="name" class="sr-only">Name</label>
                        <input id="name" type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <label for="email" class="sr-only">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <label for="password-confirm" class="sr-only">Confirm Password</label>
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>

                        <button type="submit" class="btn btn-primary regBtn">
                                Register
                        </button>
                    </form>
@endsection
