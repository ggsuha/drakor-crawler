@extends('layouts.app')

@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-12 col-md-12">
                    <form method="POST" action="{{ route('admin.drama.add') }}">
                        @csrf
                        <div class="form-group">
                            <label class="small mb-1" for="email">Email</label>
                            <input class="form-control py-4 @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="small mb-1" for="password">Password</label>
                            <input id="password" type="password" class="form-control py-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Remember password</label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <!-- <a class="btn btn-primary" href="index.html">Login</a> -->
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
