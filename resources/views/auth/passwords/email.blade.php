@extends('layouts.app')

@section('content')
<div class="row">
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
</div>
                    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h3 class="text-center">Reset Password Form </h3>
                        <label for="email" class="sr-only">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif

                        <br/>

                        <button type="submit" class="btn btn-primary regBtn">
                            Send Password Reset Link
                        </button>
                    </form>
@endsection
