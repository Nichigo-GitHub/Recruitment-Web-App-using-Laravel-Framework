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
                                    <div class=" pt-2"><img src="https://lh3.googleusercontent.com/a-/AOh14Gg9J9Bs9rBOsUSGgZLCo2JImpmE1-6OC1zZXq7OKw=s576-p-rw-no" class="rounded-circle" style="height: 40px;"></div>
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
                                <a class="navbar-selection" href="/resume/portfolio/create">
                                    <div class="pt-2 pb-2" style="font-weight: bold;"><i class="fas fa-user"></i>&nbsp; About me</div>
                                </a>
                                <a class="navbar-selection" href="/resume/{{ $user->id }}/portfolio/create">
                                    <div class="pt-2" style="font-weight: bold;"><i class="fas fa-address-book"></i>&nbsp; Portfolio</div>
                                </a>
                            </div>                             
                        </div>   
                    </nav>  
                </div>
                <div class="flex-column col-9 pl-5"> 
                    <div class="card">
                        <div class="card-header"><strong>{{ __('Update Your Portfolio') }}</strong></div>

                        <div class="card-body">
                            <form class="pb-4" method="POST" action="/resume/portfolio/{{ $post->id }}/updated" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-md-5 col-form-label text-md-right">{{ __('Update Title of your Portoflio') }}</label>

                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" autocomplete="title" autofocus>

                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label text-md-right">{{ __('Update Image of your Portoflio') }}</label>

                                    <div class="col-md-6">
                                        <label class="col-form-label pl-3">{{ __('*Image will be Cropped to 4:3 Ratio*') }}</label>
                                        
                                        <div class="pb-3">
                                            <div style="position: relative; max-width: 100%; height: 200px; border: 1px solid #d3d3d3; overflow:hidden;">                                    
                                                <img id="image_preview" src="/storage/{{ $post->image }}" style="position: absolute; max-width: 100%; height: auto;" onload="OnImageLoad(event);">
                                            </div>
                                        </div>

                                        <label class="button" for="image" style="display: inline-block; padding: 5px 13px; cursor: pointer; border-radius: 4px; background-color: #8ebf42; color: #fff;">Update Image</label>
                                        
                                        <input id="image" type="file" class="form-control-file" name="image" style="position: absolute; z-index: -1; top: 10px; left: 8px; font-size: 17px; color: #b8b8b8;">

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
                                            {{ __('Update Portfolio') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div style="border-top:1px solid #d3d3d3;"></div>
                            <div class="col-12 pt-3">
                                <div class="d-flex" style="justify-content: space-between;">               
                                    <div class="pb-2" style="font-weight: bold;">Portfolio ({{ $user->posts->count() }})</div>                            
                                    <a href="/resume/{{ $user->id }}/portfolio/create">Add New Portfolio</a>
                                </div>      
                                @foreach($user->posts as $post)
                                    @if ($loop->first)
                                        <div class="d-flex" style="justify-content: space-between;">                                  
                                    @endif
                                    
                                    <div class="flex-column">
                                        <nav class="col-12 navbar-light" style="text-align: right;"><a class="navbar-selection-red" href="/resume/portfolio/{{ $post->id }}/delete"><i class="fas fa-trash-alt"></i></a></nav>
                                        <div class="col-12">
                                            <img src="/storage/{{ $post->image }}" style="max-width: 100%; height: auto; border: 1px solid #d3d3d3;">
                                        </div>
                                        <div class="col-12" style="text-align: center;">{{ $post->title }}</div>
                                    </div>

                                    @if ($loop->iteration%3 == 0 && $loop->last)
                                        
                                    @elseif ($loop->iteration%3 == 0)
                                        </div>
                                        <br>
                                        <div class="d-flex">
                                    @endif

                                    @if ($loop->last)
                                        </div>
                                    @endif
                                @endforeach  
                            </div>
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
