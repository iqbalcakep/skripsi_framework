<footer class="bg-191 color-ccc">
		
    <div class="container">
        <div class="pt-50 pb-20 pos-relative">
            <div class="abs-tblr pt-50 z--1 text-center">
                <div class="h-80 pos-relative"><img class="opacty-1 h-100 w-auto" src="images/map.png" alt=""></div>
            </div>
            <div class="row">
            
                <div class="col-sm-6 center">
                    <div class="mb-30">
                        <a href="#"><img src="{{config('app.url')}}img/logo.png"></a>
                        <p class="mtb-20 color-ccc">Perancangan Sistem Rekomendasi Artikel Online menggunakan Content Based Filtering</p>
                    </div><!-- mb-30 -->
                </div><!-- col-md-4 -->
            
            </div><!-- row -->
        </div><!-- ptb-50 -->
        
        <div class="brdr-ash-1 opacty-2"></div>
        
        <div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">
        
            <ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">
                <li><a class="pl-0 pl-sm-10" href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Jobs advertising</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
                <li><a class="pl-0 pl-sm-10" href="#"><i class="ion-social-facebook"></i></a></li>
                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                <li><a href="#"><i class="ion-social-google"></i></a></li>
                <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                <li><a href="#"><i class="ion-social-bitcoin"></i></a></li>
            </ul>
            
        </div><!-- oflow-hidden -->
    </div><!-- container -->
</footer>

<!-- SCIPTS -->

<script src="{{config('app.url')}}user/plugin-frameworks/jquery-3.2.1.min.js"></script>

<script src="{{config('app.url')}}user/plugin-frameworks/tether.min.js"></script>

<script src="{{config('app.url')}}user/plugin-frameworks/bootstrap.js"></script>

<script src="{{config('app.url')}}user/common/scripts.js"></script>

<script>
    const base_url = '{{config('app.url')}}'
  $(function () {
    //Initialize Select2 Elements
    set_ajax=(url,params,loading_div,callback,form)=>{
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
                var addOptions = {}
                if(form === true){
                    addOptions = {
                    processData:false,
                    contentType:false, 
                    cache:false
                    }       
                }
                $.ajax({
                    url : url,
                    type: 'POST',
                    data : params,
                    dataType: 'json',
                    cache : addOptions.cache,
                    processData : addOptions.processData,
                    contentType : addOptions.contentType,
                    beforeSend: function() { $('#'+loading_div).show(); },
                    success: callback,
                    complete: function() { $('#'+loading_div).hide(); },
                    error : function(xhr){
                    try{
                    var error = xhr.responseJSON.errors;
                    if(xhr.responseJSON.message==="The given data was invalid."){
                            $(".notif").detach();
                            Object.keys(error).forEach(function(key){
                                $("<p class='notif' style='opacity:0;color:red'>"+error[key][0]+"<p>").insertAfter("#"+key).animate({
                                    opacity:'9'
                                },1000);
                            })
                        }
                    }catch(err){
                        $.notify("Error, Something is Trouble Try Reload", "error");
                    }    
        

                    // console.log("SERVER ERROR")
                    }
                })
            }

  })
</script>