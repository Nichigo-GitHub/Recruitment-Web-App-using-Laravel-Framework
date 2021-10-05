@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Showcase Your Work') }}</div>

                <div class="card-body">
                    <form method="POST" action="/portfolio" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-5 col-form-label text-md-right">{{ __('Add Title of your Portoflio') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="image" class="col-md-5 col-form-label text-md-right">{{ __('Add Image to your Portoflio') }}</label>

                            <div class="col-md-6">
                                <label class="button" for="image" style="display: inline-block; padding: 5px 13px; cursor: pointer; border-radius: 4px; background-color: #8ebf42; color: #fff;">Upload Image</label>
                                
                                <input id="image" type="file" class="form-control-file" name="image" style="position: absolute; z-index: -1; top: 10px; left: 8px; font-size: 17px; color: #b8b8b8;" required>

                                @error('image')
                                    <br>
                                    <span class="alert alert-warning" role="alert" style="padding: 5px 13px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add New Portfolio') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
