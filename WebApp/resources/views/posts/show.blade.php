@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 pt-5">
            <nav class="card navbar-light">
                <div class="card-header">
                    <div class="d-flex" style="justify-content: space-between;">
                        <a class="navbar-selection" href="/resume/{{ $user->id }}">
                            <i class="fas fa-arrow-left"></i><strong>&nbsp;&nbsp;&nbsp;{{ Auth::user()->name }}</strong>
                        </a>                        
                        <strong>Portfolio</strong>                     
                    </div>
                </div>
                <div class="card-body d-flex" style="justify-content: space-between;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @php
                                $i = 0;
                            @endphp
                            @foreach($user->posts as $looping_post)    
                                @if ($looping_post->id == $post->id)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="active"></li>
                                @else
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}"></li>
                                @endif
                                @php
                                    $i++;
                                @endphp 
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($user->posts as $looping_post)  
                                @if ($looping_post->id == $post->id)
                                    <div class="carousel-item active">
                                        <div class="pb-3" style="text-align: center;">
                                            <strong>{{ $looping_post->title }}</strong>
                                        </div>
                                        <img class="d-block w-100" src="/storage/{{ $looping_post->image }}">                                    
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <div class="pb-3" style="text-align: center;">
                                            <strong>{{ $looping_post->title }}</strong>
                                        </div>
                                        <img class="d-block w-100" src="/storage/{{ $looping_post->image }}">                                    
                                    </div>
                                @endif                                
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection
