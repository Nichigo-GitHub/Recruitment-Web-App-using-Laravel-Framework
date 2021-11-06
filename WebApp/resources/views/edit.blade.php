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
                                <a class="navbar-selection" href="/resume/portfolio/create">
                                    <div class="pb-2" style="font-weight: bold;"><i class="fas fa-briefcase"></i>&nbsp; Experience</div>
                                </a>
                                <a class="navbar-selection" href="/resume/portfolio/create">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-graduation-cap"></i>&nbsp; Education</div>
                                </a>
                                <a class="navbar-selection" href="/resume/portfolio/create">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-user-cog"></i>&nbsp; Skills</div>
                                </a>
                                <a class="navbar-selection" href="/resume/portfolio/create">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-language"></i>&nbsp; Languages</div>
                                </a>
                                <a class="navbar-selection" href="/resume/portfolio/create">
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
                        <div class="card-header"><strong>{{ __('Edit Profile About You') }}</strong></div>

                        <div class="card-body">                            
                            <div class="flex-column pb-3">                                
                                <div class="d-flex justify-content-md-center">
                                    <div class="col-2">
                                        <div class="pb-3">
                                            <div style="position: relative; max-width: 100%; height: 70px; overflow:hidden;">                                    
                                                <img id="image_preview" src="{{ $user->profile->profile_picture() }}" class="rounded-circle" style="position: absolute; max-width: 100%; height: 70px;" onload="OnImageLoad(event);">
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div>
                                        <h1>{{$user->name}}</h1>
                                        <div class="d-flex">
                                            <div class="pr-3"><i class="far fa-envelope"></i>&nbsp; {{$user->email}} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <i class="fas fa-mobile-alt"></i>&nbsp; {{$user->contact_number}}</div>
                                        </div>
                                    </div>    
                                </div>      
                                <div class="d-flex justify-content-md-center">
                                    <form method="POST" action="/resume/{{ $user->id }}/edit/profile_picture" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <label class="button" for="image" style="display: inline-block; padding: 5px 13px; cursor: pointer; border-radius: 4px; background-color: #8ebf42; color: #fff;">Upload Picture</label>
                                        
                                        <input id="image" type="file" class="form-control-file" name="image" style="position: absolute; z-index: -1; top: 10px; left: 8px; font-size: 17px; color: #b8b8b8;" required>
        
                                        @error('image')
                                            <br>
                                            <span class="alert alert-warning" role="alert" style="padding: 5px 13px;">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Save Picture') }}
                                        </button>
                                    </form>
                                </div>                      
                            </div>      
                            <div style="border-top:1px solid #d3d3d3;"></div>      
                            <form class="pt-3" method="POST" action="/resume/{{ $user->id }}/edit/update_identity">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-5 col-form-label text-md-right">{{ __('Name') }}</label>

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
                                    <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contact_number" class="col-md-5 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                                    <div class="col-md-6">
                                        <input id="contact_number" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ $user->contact_number }}" autocomplete="contact_number" autofocus>

                                        @error('namcontact_numbere')
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
                    <br>
                    <div class="card">
                        <div class="card-header"><strong>{{ __('Change Current Password') }}</strong></div> 

                        <div class="card-body">
                            <form method="POST" action="{{ route('user-password.update') }}">
                                @csrf
                                @method('PUT')
                                
                                @if (session('status') == "password-updated")
                                    <div class="alert alert-success">
                                        Password Updated Successfully
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label for="current_password" class="col-md-5 col-form-label text-md-right">{{ __('Enter Current Password') }}</label>

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
                                    <label for="password" class="col-md-5 col-form-label text-md-right">{{ __('New Password') }}</label>

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
                                    <label for="password-confirm" class="col-md-5 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

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
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-header"><strong>{{ __('Additional Security') }}</strong></div> 

                        <div class="card-body">
                            @if (session('status') == "two-factor-authentication-enabled")
                                <div class="alert alert-success" role="alert">
                                    {{ __('2 Factor Authentication has been Enabled') }}
                                </div>                        
                            @endif

                            <form method="POST" action="/user/two-factor-authentication">
                                @csrf                        

                                @if (auth()->user()->two_factor_secret)       
                                    <div class="form-group row">
                                        @method('DELETE')
                                    
                                        <label for="disable-button" class="col-md-5 col-form-label text-md-right">{{ __('2 Factor Authentication') }}</label>        
                                    
                                        <div class="col-md-6">
                                            <div class="alert alert-success" role="alert">
                                                {{ __('2 Factor Authentication is Enabled') }}
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Disable') }}
                                            </button>
                                        </div>
                                    </div>     
                                @else
                                    <div class="form-group row">
                                        <label for="enable-button" class="col-md-5 col-form-label text-md-right">{{ __('2 Factor Authentication') }}</label>        
                                    
                                        <div class="col-md-6">
                                            <div class="alert alert-success" role="alert">
                                                {{ __('2 Factor Authentication is Disabled') }}
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4 pl-5">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Enable') }}
                                            </button>
                                        </div>
                                    </div>                            
                                @endif
                            </form>
                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
                            <script type="text/javascript">                        
                                $(document).ready(function (e) {         
                                    $('#image').change(function(){
                                        let reader = new FileReader();
                                    
                                        reader.onload = (e) => {                         
                                            $('#image_preview').attr('src', e.target.result); 
                                        }
                                    
                                        reader.readAsDataURL(this.files[0]); 
                                    });
                                });

                                function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {
                                    var result = { width: 0, height: 0, fScaleToTargetWidth: true };

                                    if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
                                        return result;
                                    }

                                    // scale to the target width
                                    var scaleX1 = targetwidth;
                                    var scaleY1 = (srcheight * targetwidth) / srcwidth;

                                    // scale to the target height
                                    var scaleX2 = (srcwidth * targetheight) / srcheight;
                                    var scaleY2 = targetheight;

                                    // now figure out which one we should use
                                    var fScaleOnWidth = (scaleX2 > targetwidth);
                                    if (fScaleOnWidth) {
                                        fScaleOnWidth = fLetterBox;
                                    }
                                    else {
                                        fScaleOnWidth = !fLetterBox;
                                    }

                                    if (fScaleOnWidth) {
                                        result.width = Math.floor(scaleX1);
                                        result.height = Math.floor(scaleY1);
                                        result.fScaleToTargetWidth = true;
                                    }
                                    else {
                                        result.width = Math.floor(scaleX2);
                                        result.height = Math.floor(scaleY2);
                                        result.fScaleToTargetWidth = false;
                                    }
                                    result.targetleft = Math.floor((targetwidth - result.width) / 2);
                                    result.targettop = Math.floor((targetheight - result.height) / 2);

                                    return result;
                                }

                                function OnImageLoad(evt) {
                                    var img = evt.currentTarget;

                                    // what's the size of this image and it's parent
                                    var w = $(img).width();
                                    var h = $(img).height();
                                    var tw = $(img).parent().width();
                                    var th = $(img).parent().height();

                                    // compute the new size and offsets
                                    var result = ScaleImage(w, h, tw, th, false);

                                    // adjust the image coordinates and size
                                    img.width = result.width;
                                    img.height = result.height;
                                    $(img).css("left", result.targetleft);
                                    $(img).css("top", result.targettop);
                                }
                            </script>
                        </div>
                    </div>                           
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
