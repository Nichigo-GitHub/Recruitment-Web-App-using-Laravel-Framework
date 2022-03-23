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
                <div class="flex-column col-9 pl-5" style="width: 925px;">     
                    <div class="card">                
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="col-2 pt-3"><img src="{{ $user->profile->profile_picture() }}" class="rounded-circle" style="height: 70px;"></div>
                                <div class="pt-3 pl-2"><h1>{{$user->name}}</h1>
                                    <div class="d-flex">
                                        <div class="pr-3"><i class="far fa-envelope"></i>&nbsp; {{$user->email}} &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <i class="fas fa-mobile-alt"></i>&nbsp; {{$user->contact_number}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>       
                        <div class="card-body">
                            <div class="d-flex pb-3">                
                                <div class="col-3">                        
                                    <div class="pb-2" style="font-weight: bold;">Skills</div>
                                    <div>{{$user->profile->skills}}</div>
                                    <br>
                                    <div class="pb-2" style="font-weight: bold;">Availability</div>
                                    <div>{{$user->profile->availability}} hrs/week</div>
                                    <br>
                                    <div class="pb-2" style="font-weight: bold;">Languages</div>
                                    <div>{{$user->profile->languages}}</div>
                                    <br>
                                    <div class="pb-2" style="font-weight: bold;">Education</div>
                                    <div><strong>NU Laguna</strong></div>
                                    <div>Bachelor of Science (BS), Computer Science</div>
                                    <div>2018-2022 (expected)</div>
                                </div>
                                <div style="border-right:1px solid #d3d3d3;"></div>
                                <div class="col-9 flex-column">                            
                                    <div >                        
                                        <div class="pb-2" style="font-weight: bold;">{{$user->profile->title}}</div>
                                        <div>{{$user->profile->description}}</div>
                                        <div class="pt-3" style="border-bottom:1px solid #d3d3d3;"></div>
                                    </div>                               
                                    <div class="pt-3">                        
                                        <div class="pb-2"><strong>Work History:</strong> Completed jobs (2)</div>
                                        <div>Python Pandas - JSON Specialisit</div>
                                        <div>⭐⭐⭐⭐⭐ <strong>5.00</strong> Sep 2, 2021 - Sep 20, 2021</div>
                                        <div><i>"Very dedicated to follow the specs and code patterns. Very good work to make clean python code."</i></div>
                                        <div style="font-weight: bold;">$40.00</div>
                                        <br>
                                        <div>Python Pandas - JSON Specialisit</div>
                                        <div>⭐⭐⭐⭐⭐ <strong>5.00</strong> Aug 19, 2021 - Sep 2, 2021</div>
                                        <div><i>"Very pro-active to find solutions."</i></div>
                                        <div style="font-weight: bold;">$45.00</div>
                                    </div>   
                                </div>                    
                            </div>
                            <div style="border-top:1px solid #d3d3d3;"></div>
                            <div class="col-12 pt-3">                    
                                <div class="pb-2" style="font-weight: bold;">Portfolio ({{ $user->posts->count() }})</div>   
                                @foreach($user->posts as $post)
                                    @if ($loop->first)
                                        <div class="d-flex" style="justify-content: space-between;">                                  
                                    @endif
                                    
                                    <div class="flex-column">
                                        <div class="col-12">
                                            <a href="/resume/{{ $user->id }}/portfolio/{{ $post->id }}">
                                                <img src="/storage/{{ $post->image }}" style="max-width: 100%; height: auto; border: 1px solid #d3d3d3;">
                                            </a>
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
                        </div>                                
                    </div>
                    <br>
                    <div class="card">
                        <div class="col-12 pt-3 pl-4">                        
                            <div class="pb-2" style="font-weight: bold;">Employment history</div>
                            <div><strong>Full Stack Developer | OCD Culture</strong></div>
                            <div class="pb-3">August 2020 - January 2021</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
