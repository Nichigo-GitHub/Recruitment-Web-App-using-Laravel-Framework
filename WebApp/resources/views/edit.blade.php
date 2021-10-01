@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-profile-information.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                  
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>                                
                            </div>
                        </div>
                    </form>
                    <br>
                    <form method="POST" action="{{ route('user-password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        @if (session('status') == "password-updated")
                            <div class="alert alert-success">
                                Password Updated Successfully
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password' , 'updatePassword') is-invalid @enderror" name="current_password" required autofocus>

                                @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password' , 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password' , 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>

                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="alert alert-success" role="alert">
                            {{ __('2 Factor Authentication has been Enabled') }}
                        </div>                        
                    @endif

                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="alert alert-success" role="alert">
                            {{ __('2 Factor Authentication has been Disabled') }}
                        </div>
                    @endif

                    <form method="POST" action="/user/two-factor-authentication">
                        @csrf                        

                        @if (auth()->user()->two_factor_secret)       
                            <div class="form-group row">
                                @method('DELETE')
                               
                                <label for="disable-button" class="col-md-4 col-form-label text-md-right">{{ __('2 Factor Authentication') }}</label>        
                              
                                <div class="col-md-6">
                                    <button id="disable-button" class="btn btn-danger">
                                        {{ __('Disable') }}
                                    </button>
                                </div>
                            </div>     
                        @else
                            <div class="form-group row">
                                <label for="enable-button" class="col-md-4 col-form-label text-md-right">{{ __('2 Factor Authentication') }}</label>        
                            
                                <div class="col-md-6">
                                    <button id="enable-button" class="btn btn-primary">
                                        {{ __('Enable') }}
                                    </button>
                                </div>
                            </div>                              
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
