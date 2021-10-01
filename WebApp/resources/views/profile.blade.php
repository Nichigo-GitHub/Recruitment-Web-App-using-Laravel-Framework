@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="col-2 pt-3"><img src="https://lh3.googleusercontent.com/a-/AOh14Gg9J9Bs9rBOsUSGgZLCo2JImpmE1-6OC1zZXq7OKw=s576-p-rw-no" class="rounded-circle" style="height: 70px;"></div>
                        <div class="pt-3 pl-2"><h1>{{$user->name}}</h1>
                            <div class="d-flex">
                                <div class="pr-3"><strong>153</strong> Total Jobs Done</div>
                                <div class="pr-3"><strong>23k</strong> Total Earnings</div>
                                <div><strong>$50</strong> Per Hour</div>
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
                        <div class="pb-2" style="font-weight: bold;">Portfolio (3)</div>
                        <div class="d-flex">
                            <div class="flex-column">
                                <div class="col-4"><img src="https://www.upwork.com/att/download/portfolio/persons/uid/1347099708579033088/profile/projects/files/187aec6a-380a-4a72-8b8c-f62b3f373d5f" style="max-width: 500%; height: auto; border: 1px solid #d3d3d3;"></div>
                                <div class="pl-3"><a href="#">Online Food Ordering System</a></div>
                            </div>
                            <div class="flex-column">
                                <div class="col-4"><img src="https://www.upwork.com/att/download/portfolio/persons/uid/1347099708579033088/profile/projects/files/6706b770-337d-417d-a440-4c0bbe366cc6" style="max-width: 500%; height: auto; border: 1px solid #d3d3d3;"></div>
                                <div class="pl-3"><a href="#">Reactjs Dashboard For Ecommerce website</a></div>
                            </div>
                            <div class="flex-column">
                                <div class="col-4"><img src="https://www.upwork.com/att/download/portfolio/persons/uid/1347099708579033088/profile/projects/files/696ddf76-93a4-4e89-a474-3352eba8631a" style="max-width: 500%; height: auto; border: 1px solid #d3d3d3;"></div>
                                <div class="pl-3"><a href="#">Online Scrap Selling website</a></div>
                            </div>
                        </div>
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
@endsection
