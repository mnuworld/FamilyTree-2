/* 
  this file loads all js important before user login
 */
sliders_files=function(){
    $.get(url, {
        pg:"login",
        file:"slider/slider_process"
    }, function(data){
        $('#main').html(data);
    }); 
}
//setInterval(sliders_files,6000); //interval of pages to be displayed 4sec
$(document).ready(sliders_files);

mswitch=function(){
        $('.ms').click(function(){
            return false;
        });
        $('.ms').mousedown(function(){
            $(".login").html(LOADER);
            var id=$(this).attr('id');           
            if(id=='fp'){           
            $.get(url, {pg:"forgot_password",file:"forgot_password"}, function(data){
                $('.login').html(data);
            });
            }else if (id=='rg'){           
            $.get(url, {pg:"register",file:"register"}, function(data){
                $('.login').html(data);
            });
            }else if(id=='fb_register'){
               $.get(url, {pg:"register",file:"fb_register/facebook_register.php"}, function(data){
                $('.login').html(data);
            }); 
            }
        });
    }
home_page=function(){        		
        $('#button').live('click', function()			{ 
            $("#ajax_result").html('');
            $("#ajax_result").html('<?=$LOADER?>');
            $("#landing").ajaxForm({
                target: '#ajax_result'
            });
        });      
    }
$(document).ready(home_page);
$(document).ready(mswitch);


