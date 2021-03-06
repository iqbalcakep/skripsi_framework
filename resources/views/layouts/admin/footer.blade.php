<script src="{{config('app.url')}}assets/js/vendor-all.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{config('app.url')}}assets/js/pcoded.min.js"></script>

<!-- prism Js -->
<script src="{{config('app.url')}}assets/plugins/prism/js/prism.min.js"></script>

<script type="text/javascript">

$(window).on('load',function(){
    var templateStatus = '{{request()->cookie('theme')}}'
    if(templateStatus=="dark"){
        $("header").removeClass("header-default");
        $("header").addClass("header-dark");
        $("nav").addClass("navbar-dark brand-dark").removeClass("navbar-light brand-light")
        $("#switch-p-1").removeAttr('checked');
    }else{
        $("header").addClass("header-default");
        $("header").removeClass("header-dark");
        $("nav").removeClass("navbar-dark brand-dark").addClass("navbar-light brand-light")
        $("#switch-p-1").attr('checked',true);
    }
})

    $("#switch-p-1").on("change",function(){
        if($("#switch-p-1").is(":checked")==true){
            createCookie("theme","light",1);
            setTemplate('light');
        }else{
            createCookie("theme","dark",1);
            setTemplate('dark');
        }
    });

    setTemplate=(status)=>{
        if(status==="dark"){
            $("header").removeClass("header-default");
            $("header").addClass("header-dark");
            $("nav").addClass("navbar-dark brand-dark").removeClass("navbar-light brand-light")
            $('<link id="darkcss" rel="stylesheet" href="{{config('app.url')}}assets/css/layouts/dark.css">').insertAfter('#realcss')
        }else{
            $("header").addClass("header-default");
            $("header").removeClass("header-dark");
            $("nav").removeClass("navbar-dark brand-dark").addClass("navbar-light brand-light")
            $("#darkcss").remove();
        }
    }
</script>

<script src="{{config('app.url')}}assets/js/demo.js"></script>
<script src="{{config('app.url')}}assets/js/notify.js"></script>
<script src="{{config('app.url')}}assets/plugins/ekko-lightbox/js/ekko-lightbox.min.js"></script>
<script src="{{config('app.url')}}assets/plugins/lightbox2-master/js/lightbox.min.js"></script>
<script src="{{config('app.url')}}js/jquery.twbsPagination.js"></script>
<script src="{{config('app.url')}}assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<!-- Page script -->
<script>

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=.wa.kl-youniverse.com";
}


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