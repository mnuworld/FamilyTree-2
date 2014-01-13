<form id="form" action="<?= $AJAX ?>pg=home&process=add_new_user" method="GET">
    <table>
        <tr>    
            <td> <label>First name:</label></td>
            <td> <input type="text" id="firstname" name="firstname"></td>
        </tr>
        <tr>
            <td><label>Second name:</label></td>
            <td><input type="text" id="secondname" name="secondname"></td>
        </tr>
        <tr>
            <td><label>Date of birth:</label></td>
            <td><input type="date" id="dateofbirth" name="dateofbirth"></td>
        </tr>
        <tr><td><label>Gender:</label></td>
            <td><select id="gender" name="gender"><option>Male</option>
                        <option>Female</option>
                </select>
            </td>
        </tr>
        <tr><td><label>Marital Status:</label></td>
            <td><select id="maritalstatus" name="maritalstatus"><option>Single</option>
                        <option>Married</option>
                        <option>Divorced</option>
                </select>
            </td>
        </tr>
        
       
    </table>
    <button id="sub"> Add </button>
</form>
<div id="here"></div>
<script type="text/javascript">
     new_user=function(){		
        $('#sub').bind('mousedown', function(){
           
            //            $("#preview").html('');
            //$(".main_container").html(LOADER);
            validate_form(["firstname", "secondname", "dateofbirth","gender","maritalstatus"]);
            
            $("#form").ajaxForm({
                target: '#here'
            }).submit();
            //push_url(home+'confirm_register');	
        }); 
    }
    
    $(document).ready(new_user);
</script>
