@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="row justify-content-center">
            <div class="d-flex col-md-12 pt-5">  
                <div class="flex-column col-3 pl-3">
                    <nav class="sticky navbar-light card" style="position: fixed; width: 250px;">                    
                        <div class="card-header">
                            <a class="navbar-selection" href="/resume/{{ $user->id }}">
                                <div class="d-flex">
                                    <div class=" pt-2"><img src="{{ $user->profile->profile_picture() }}" class="rounded-circle" style="height: 40px;"></div>
                                    <div class="flex-column" style="width: 200px;">
                                        <div class="pt-1 pl-3"><strong>
                                        @foreach(explode(' ', $user->name) as $letters)
                                            @if ($loop->iteration == 3 && !$loop->last)
                                                <br> {{ $letters }}
                                            @elseif ($loop->last)

                                            @else
                                                {{ $letters }}
                                            @endif
                                        @endforeach
                                        </strong></div>
                                        <div class="pl-3">View my Resume</div>
                                    </div>
                                </div>
                            </a> 
                        </div>      
                        <div class="card-body">
                            <div class="flex-column">
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/">
                                    <div class="pb-2" style="font-weight: bold;"><i class="fas fa-briefcase"></i>&nbsp; Experience</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-graduation-cap"></i>&nbsp; Education</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-user-cog"></i>&nbsp; Skills</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/languages">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-language"></i>&nbsp; Languages</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/add_info">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-bars"></i>&nbsp; Additional Info</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/edit">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-user"></i>&nbsp; About me</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/portfolio/create">
                                    <div class="pt-2" style="font-weight: bold;"><i class="fas fa-address-book"></i>&nbsp; Portfolio</div>
                                </a>
                            </div>                             
                        </div>   
                    </nav>  
                </div>
                <div class="flex-column col-9 pl-5" style="width: 928px;">   
                    <div class="card">  
                        <div class="card-header"><strong>{{ __('Additional Info About You') }}</strong></div>

                        <div class="card-body">
                            <form class="pt-3" method="POST" action="/resume/{{ $user->id }}/edit/update_info">
                                @csrf

                                <div class="form-group row">
                                    <label for="expected_salary" class="col-md-5 col-form-label text-md-right">{{ __('Expected Salary') }}</label>

                                    <div class="col-md-6">
                                        <input id="expected_salary" type="text" class="form-control @error('expected_salary') is-invalid @enderror" name="expected_salary" value="{{ $user->profile->expected_salary }}" required autocomplete="expected_salary" autofocus>

                                        @error('expected_salary')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="preferred_work_location" class="col-md-5 col-form-label text-md-right">{{ __('Preferred Work Location') }}</label>

                                    <div class="col-md-6">
                                        <input id="preferred_work_location" type="text" class="form-control @error('preferred_work_location') is-invalid @enderror" name="preferred_work_location" value="{{ $user->profile->preferred_work_location }}" required autocomplete="preferred_work_location" autofocus>

                                        @error('preferred_work_location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="other_info" class="col-md-5 col-form-label text-md-right">{{ __('Other Information') }}</label>

                                    <div class="col-md-6">
                                        <input id="other_info" type="text" class="form-control @error('other_info') is-invalid @enderror" name="other_info" value="{{ $user->profile->other_info }}" autocomplete="other_info" autofocus>

                                        @error('other_info')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save Changes') }}
                                        </button>                                
                                    </div>
                                </div>                                
                            </form>                            
                        </div>
                    </div>                                              
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
