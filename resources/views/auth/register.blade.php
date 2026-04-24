@extends('auth.layouts.main')

@section('container')
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100"
            style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?auto=format&fit=crop&w=1950&q=80');">
            
            <span class="mask bg-gradient-dark opacity-6"></span>

            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">

                        <div class="card z-index-0 fadeIn3 fadeInBottom">

                            {{-- HEADER --}}
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">
                                        Sign up
                                    </h4>
                                </div>
                            </div>

                            {{-- BODY --}}
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}" class="text-start">
                                    @csrf

                                    {{-- Name --}}
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" required autofocus
                                            value="{{ old('name') }}">
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Email --}}
                                    <div class="input-group input-group-outline my-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required
                                            value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Password --}}
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                    {{-- Confirm Password --}}
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    {{-- Button --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                                            Sign up
                                        </button>
                                    </div>

                                    {{-- Login --}}
                                    <p class="mt-4 text-sm text-center">
                                        Already have an account?
                                        <a href="{{ route('login') }}"
                                            class="text-primary text-gradient font-weight-bold">
                                            Sign in
                                        </a>
                                    </p>

                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection