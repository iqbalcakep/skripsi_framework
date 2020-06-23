@extends('layouts.user.index')
@section('content')
<div class="container">
    <div class="h-600x h-sm-auto">
        <div class="h-2-3 h-sm-auto oflow-hidden">
        
            {{-- OneArticle --}}
            @isset($one)        
            <div class="pb-5 pr-5 pr-sm-0 float-left float-sm-none w-2-3 w-sm-100 h-100 h-sm-300x">
                <a class="pos-relative h-100 dplay-block" href="{{$one[0]['slug']}}"> 
                <div class="img-bg bg-1 bg-grad-layer-6" style=" background-image: url('{{$one[0]['thumbnail']}}');"></div>
                        <div class="abs-blr color-white p-20 bg-sm-color-7">
                            <h3 class="mb-15 mb-sm-5 font-sm-13"><b>{{$one[0]['title']}}</b></h3>
                            <ul class="list-li-mr-20">
                                <li>{{$one[0]['date']}}</li>
                            </ul>
                        </div><!--abs-blr -->
                    @endisset
                </a><!-- pos-relative -->
            </div><!-- w-1-3 -->
            
            <div class="float-left float-sm-none w-1-3 w-sm-100 h-100 h-sm-600x">
            {{-- TwoArticle --}}
            @isset($two)
                @foreach ($two as $val )
                    <div class="pl-5 pb-5 pl-sm-0 ptb-sm-5 pos-relative h-50">
                        <a class="pos-relative h-100 dplay-block" href="{{$val['slug']}}">
                        
                            <div class="img-bg bg-2 bg-grad-layer-6" style=" background-image: url('{{$val['thumbnail']}}');"></div>
                            
                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{$val['title']}}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>{{$val['date']}}</li>
                                </ul>
                            </div><!--abs-blr -->
                        </a><!-- pos-relative -->
                    </div><!-- w-1-3 -->
                @endforeach 
             @endisset
            </div><!-- float-left -->

        </div><!-- h-2-3 -->
        
        <div class="h-1-3 oflow-hidden">
            {{-- ThreeArticle --}}
            @isset($three)
                @foreach ($three as $val)
                    <div class="pr-5 pr-sm-0 pt-5 float-left float-sm-none pos-relative w-1-3 w-sm-100 h-100 h-sm-300x">
                        <a class="pos-relative h-100 dplay-block" href="{{$val['slug']}}">
                        
                            <div class="img-bg bg-4 bg-grad-layer-6" style=" background-image: url('{{$val['thumbnail']}}');"></div>
                            
                            <div class="abs-blr color-white p-20 bg-sm-color-7">
                                <h4 class="mb-10 mb-sm-5"><b>{{$val['title']}}</b></h4>
                                <ul class="list-li-mr-20">
                                    <li>{{$val['date']}}</li>
                                </ul>
                            </div><!--abs-blr -->
                        </a><!-- pos-relative -->
                    </div><!-- w-1-3 -->
                @endforeach
            @endisset
        </div><!-- h-2-3 -->
    </div><!-- h-100vh -->
</div><!-- container -->


<section>
    <div class="container">
        <div class="row">
        
            <div class="col-md-12 col-lg-12">
                <h4 class="p-title"><b>RECENT NEWS</b></h4>
                <div class="row">
                @isset($headline)
                    <div class="col-sm-6">
                        <img src="{{$headline[0]['thumbnail']}}" alt="">
                        <h4 class="pt-20"><a href="{{$headline[0]['slug']}}"><b>{{$headline[0]['title']}}</b></a></h4>
                        <ul class="list-li-mr-20 pt-10 pb-20">
                            <li>{{$headline[0]['date']}}</li>
                        </ul>
                        <p>{{substr($headline[0]['content'],0,150)}}</p>
                    </div><!-- col-sm-6 -->
                 @endisset   
                    <div class="col-sm-6">
                      @isset($four)
                        @foreach ($four as $val)
                            <a class="oflow-hidden pos-relative mb-20 dplay-block" href="{{$val['slug']}}">
                                <div class="wh-100x abs-tlr"><img src="{{$val['thumbnail']}}" alt=""></div>
                                <div class="ml-120 min-h-100x">
                                    <h5><b>{{$val['title']}}</b></h5>
                                    <h6 class="color-lite-black pt-10">{{$val['date']}}</h6>
                                </div>
                            </a><!-- oflow-hidden -->
                        @endforeach
                      @endisset
                    </div><!-- col-sm-6 -->
                    
                </div><!-- row -->
            </div><!-- col-md-9 -->
            
        </div><!-- row -->
    </div><!-- container -->
</section>
@endsection