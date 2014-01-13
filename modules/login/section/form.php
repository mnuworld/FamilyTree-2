<p> Already a Member? Login</p>
 <?php
            if (isset($_GET['er']) && $_GET['er'] > 0) {
                $posted_err = $_GET['er'];

                if ($_GET['er'] >= 3) {
                    echo '
                    <p class="msg warning" style="margin:0 10px 0 0px;">Please if you dont have an account, Create free Unnett account 
                    <span style="font-size: 1em;color:#0085cc;cursor: pointer;"><a class="ms" id="rg" href="">Here</a></span>.
                    </p>';
                    
                }else{
                echo '<p class="msg warning" style="margin:0 10px 0 0px;">Login failed, Please enter correct username and password.</p>';
            
                }
            }
            
            if (isset($_GET['err']) && $_GET['err'] == 'empty') {
                echo '<p class="msg warning" style="margin:0 10px 0 0px;">Login failed, Please fill all fields to login.</p>';
            }
            
            if (isset($_GET['error']) && $_GET['error'] == 'act') {
                echo '<p class="msg warning" style="margin:0 10px 0 0px;">Login failed, Please go to your email address and activate your account first to login.</p>';
            }
        ?>
<form action="?pg=login" method="POST">
    <table>
        <tr class="bordertable tbody">
            <td><label>Email</label></td>
            <td><input type="text" name="email" class="loginform_input" placeholder="" equired></td>
        </tr>
        <tr class="bordertable tbody">
            <td><label>Password</label></td>
            <td><input type="password" name="password" class="loginform_input" equired></td>
        </tr>
    </table>
    <input type="checkbox" name="remember" value="yes" style="margin-left:108px;width:15px;">
    <input type="hidden" value="<?
if (isset($posted_err))
    echo $posted_err
    ?>" name="posted_id" >
    remember login details
    <input type="submit" class="general" name="submit" value="Login">
</form>
<br/>
<hr size="1" color="#90A9B7"/>
<a class="ms" onmousedown="next('forgot_password','f1')" id="f1" href="<?=HOME?>forgot_password">forgot my password</a> | Don't have an account. 
<a class="ms" onmousedown="next('register','f2')" id="f2" href="<?=HOME?>register">free signup now!</a>
<br/>
<br/>
<script>
//    function next(file){
//        $(".login").html(LOADER);                    
//        $.get(url, {pg:file,file:file}, function(data){
//            $('.login').html(data);
//        });
//               
//    }
     function next(file,f){
        //e.preventDefault(); 
		/*	
		if uncomment the above line, html5 nonsupported browers won't change the url but will display the ajax content;
		if commented, html5 nonsupported browers will reload the page to the specified link. 
		*/
		
		//get the link location that was clicked
		pageurl = $('#'+f).attr('href');
		
		//to get the ajax content and display in div with id 'content'
		$.get(url, {pg:file,file:file}, function(data){
                    $('.login').html(data);
                });
		
		//to change the browser URL to 'pageurl'
		if(pageurl!=window.location){
			window.history.pushState({path:pageurl},'',pageurl);	
		}
		return false;  
    }
</script>
