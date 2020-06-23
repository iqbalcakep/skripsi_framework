@extends('layouts.user.index')
@section('content')
    <section class="ptb-0">
        <div class="mb-30 brdr-ash-1 opacty-5"></div>
        <div class="container">
            <a class="mt-10" href="."><i class="mr-5 ion-ios-home"></i>Home<i class="mlr-10 ion-chevron-right"></i></a>
            <a class="mt-10 color-ash" href="#">Detail Article</a>
        </div><!-- container -->
    </section>
    
    <section>
		<div class="container">
			<div class="row">
			
				<div class="col-md-12 col-lg-8">
					<img src="{{$article->thumbnail}}" alt="">
					<h3 class="mt-30"><b>{{ $article->title }}</b></h3>
					<ul class="list-li-mr-20 mtb-15">
						<li><i class="color-primary mr-5 font-12 ion-ios-bolt"></i>{{ $article->date }}</li>
					</ul>

					<div class="col-md-12">
						<h4>Related Post</h4>
						@foreach($recomendationsOther as $val)
							<a onclick="engage(<?= $article->id ?>,'<?= $val['slug'] ?>')" class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
								{{$val->title}}
							</a><!-- oflow-hidden -->
						@endforeach
					</div>
					
					<p>{{ $article->real_content }}</p>
				
					<div class="float-left-right text-center mt-40 mt-sm-20">
				

						<ul class="mb-30 list-a-bg-grey list-a-hw-radial-35 list-a-hvr-primary list-li-ml-5">
							<li class="mr-10 ml-0">Share</li>
							<li><a href="#"><i class="ion-social-facebook"></i></a></li>
							<li><a href="#"><i class="ion-social-twitter"></i></a></li>
							<li><a href="#"><i class="ion-social-google"></i></a></li>
							<li><a href="#"><i class="ion-social-instagram"></i></a></li>
						</ul>
						
					</div><!-- float-left-right -->	
				</div><!-- col-md-9 -->
				
				<div class="d-none d-md-block d-lg-none col-md-3"></div>
				<div class="col-md-6 col-lg-4">
					<div class="pl-20 pl-md-0">
						<div class="mtb-50">
							<h4 class="p-title"><b>Related Post</b></h4>
							@foreach($recomendations as $val )
								<a onclick="engage(<?= $article->id ?>,'<?= $val['slug'] ?>')" class="oflow-hidden pos-relative mb-20 dplay-block" href="#">
									<div class="wh-100x abs-tlr"><img src="{{ $val->thumbnail }}" alt=""></div>
									<div class="ml-120 min-h-100x">
										<h5><b>{{ $val->title }}</b></h5>
										<h6 class="color-lite-black pt-10">{{ $val->date }}</h6>
									</div>
								</a><!-- oflow-hidden -->
							 @endforeach
							
						</div><!-- mtb-50 -->
						
					</div><!--  pl-20 -->
				</div><!-- col-md-3 -->
				
			</div><!-- row -->
			
		</div><!-- container -->
	</section>
    
    
@endsection

@push('script')
	<script>
		var base_url_prefix = base_url + "api/admin/"
		engage = (id,slug) => {
			// console.log(slug)
			
			params = {id:id}
			set_ajax(base_url_prefix+"engage",params,"null",function(res){
				window.location = slug
			})
		}
	</script>
@endpush