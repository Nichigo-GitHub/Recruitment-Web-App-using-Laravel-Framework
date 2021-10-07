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
                            <label class="col-md-5 col-form-label text-md-right">{{ __('Add Image to your Portoflio') }}</label>

                            <div class="col-md-6">
                                <label class="col-form-label pl-3">{{ __('*Image will be Cropped to 4:3 Ratio*') }}</label>
                                
                                <div class="pb-3">
                                    <div style="position: relative; max-width: 100%; height: 200px; border: 1px solid #d3d3d3; overflow:hidden;">                                    
                                        <img id="image_preview" src="https://cdn4.iconfinder.com/data/icons/iready-multimedia-vol-1/28/001_041_image_photo_painting_picture1x-512.png" style="position: absolute; max-width: 100%; height: auto;" onload="OnImageLoad(event);">
                                    </div>
                                </div>

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
@endsection
