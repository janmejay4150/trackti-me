<?php
$header = 'Feedback | Swosti Group of Hotels';
$meta = array(
	'language' => 'ka',
	'robots' => 'index,follow',
	'description' => 'Swosti group of hotels feedback form - business & leisure hotels in Bhubaneswar & Gopalpur. Our all inclusive facilities are multi cuisine restaurant, spa, discotheque, Scottish bar, chauffeur,  oldest travel agency, upcoming coffee shop.',
	'keywords' => '',
);

require('includes/header.php'); ?>
<script type="text/javascript">
	function checkForm()
    {
        var x=document.getElementById("firstname").value;
        if (x=="First Name *")
        {
        alert("First name must be filled out");
        return false;
        }
        var y=document.getElementById("lastname").value;
        if (y=="Last Name *")
        {
        alert("Last name must be filled out");
        return false;
        }
        var z=document.getElementById("address1").value;
        if (z=="Address Line 1 *")
        {
        alert("Address Line 1 must be filled out");
        return false;
        }
        
        var c=document.getElementById("city").value;
        if (c=="City *")
        {
        alert("City must be filled out");
        return false;
        }
        var z3=document.getElementById("zip").value;
        if (z3=="Zip / Post Code *")
        {
        alert("Zip / Post Code  must be filled out");
        return false;
        }
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var address = document.getElementById("email").value;
        if(reg.test(address) == false) {
        alert('Invalid Email Address');
        return false;
        }
        showmsg();
      }
 
	function showmsg()
    {
    
        
        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            alert(xmlhttp.responseText);
            document.getElementById("form1").submit();
            }
        }
    var Title=document.getElementById("title").value;
    var FirstName=document.getElementById("firstname").value;
    var LastName=document.getElementById("lastname").value;
    var Address1=document.getElementById("address1").value;
    var Address2=document.getElementById("address2").value;
    var City=document.getElementById("city").value;
    var Country=document.getElementById("country").value;
    var Zip=document.getElementById("zip").value;
    
    var Email=document.getElementById("email").value;
    var PhoneNo=document.getElementById("phoneno").value;
    var PreferredTime=document.getElementById("prefertime").value;
    var Preferredcontact=document.getElementById("prefercontact").value;
    var Comment=document.getElementById("note").value;
    xmlhttp.open("POST","ajax/sendFeedback.php",true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("title="+Title+"&firstname="+FirstName+"&lastname="+LastName+"&address1="+Address1+"&address2="+Address2+"&city="+City+"&country="+Country+"&zip="+Zip+"&email="+Email+"&phoneno="+PhoneNo+"&prefertime="+PreferredTime+"&prefercontact="+Preferredcontact+"&note="+Comment);
}
</script>
<script>
function formsubmit()
{ 
document.forms["myform"].submit();
}
</script>
</div>
<div id="Content" class="bg-4" >
			<div class="main-binder">
			
            <h1 id="frmHeader">Swosti Group of Hotels and Resorts - Feedback Form</h1>
            <?if($_GET['status']=='success')
						{
						echo"<i style='color: #68AD45;font-size: 18px;'>Thank you for giving your feedback</i><br/>";
						}?>
				<div class="main-left">
					<div class="send-form">
					<div class="example-container">
		    <form action="feedbackinsert.php" method="post" class="request" name="myform" id="myform">
							<fieldset>
								  <form name="myform" id="myform" method="post" action="feedbackinsert.php">
				      <table>
							<tbody>
							<tr>
								<td>&nbsp;</td>
								<td><span>Excellent</span></td>
								<td><span>Good</span></td>
								<td><span>Poor</span></td>
								<td><span>Remark</span></td>
							</tr>
							
							<tr>
								<td><span>Reservation</span></td>
								<td><span><input type="radio" name="res" value="excellent" /> </span></td>
								<td><span><input type="radio" name="res" value="good" /> </span></td>
								<td><span><input type="radio" name="res" value="poor" /> </span></td>
								
								<td><span><textarea name="resremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Front Office</span></td>
								<td><span><input type="radio" name="fo" value="excellent" /> </span></td>
								<td><span><input type="radio" name="fo" value="good" /> </span></td>
								<td><span><input type="radio" name="fo" value="poor" /> </span></td>
								
								<td><span><textarea name="foremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Bell Boy</span></td>
								<td><span><input type="radio" name="bb" value="excellent" /> </span></td>
								<td><span><input type="radio" name="bb" value="good" /> </span></td>
								<td><span><input type="radio" name="bb" value="poor" /> </span></td>
								
								<td><span><textarea name="bbremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Guest Relation Exe.</span></td>
								<td><span><input type="radio" name="gr" value="excellent" /> </span></td>
								<td><span><input type="radio" name="gr" value="good" /> </span></td>
								<td><span><input type="radio" name="gr" value="poor" /> </span></td>
								
								<td><span><textarea name="grremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Ambience in Lobby.</span></td>
								<td><span><input type="radio" name="al" value="excellent" /> </span></td>
								<td><span><input type="radio" name="al" value="good" /> </span></td>
								<td><span><input type="radio" name="al" value="poor" /> </span></td>
								
								<td><span><textarea name="alremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Cashier.</span></td>
								<td><span><input type="radio" name="cash" value="excellent" /> </span></td>
								<td><span><input type="radio" name="cash" value="good" /> </span></td>
								<td><span><input type="radio" name="cash" value="poor" /> </span></td>
								
								<td><span><textarea name="cashremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							<tr>
								<td colspan="5">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="5">RESTAURANT AND FACILITIES USED</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><span>Excellent</span></td>
								<td><span>Good</span></td>
								<td><span>Poor</span></td>
								<td><span>Remark</span></td>
							</tr>
							<tr>
								<td><span>Room Service.</span></td>
								<td><span><input type="radio" name="rs" value="excellent" /> </span></td>
								<td><span><input type="radio" name="rs" value="good" /> </span></td>
								<td><span><input type="radio" name="rs" value="poor" /> </span></td>
								
								<td><span><textarea name="rsremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Panorama.</span></td>
								<td><span><input type="radio" name="pan" value="excellent" /> </span></td>
								<td><span><input type="radio" name="pan" value="good" /> </span></td>
								<td><span><input type="radio" name="pan" value="poor" /> </span></td>
								
								<td><span><textarea name="panremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Chandan.</span></td>
								<td><span><input type="radio" name="ch" value="excellent" /> </span></td>
								<td><span><input type="radio" name="ch" value="good" /> </span></td>
								<td><span><input type="radio" name="ch" value="poor" /> </span></td>
								
								<td><span><textarea name="chremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Rob Roy.</span></td>
								<td><span><input type="radio" name="rr" value="excellent" /> </span></td>
								<td><span><input type="radio" name="rr" value="good" /> </span></td>
								<td><span><input type="radio" name="rr" value="poor" /> </span></td>
								
								<td><span><textarea name="rrremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Plaza club.</span></td>
								<td><span><input type="radio" name="pc" value="excellent" /> </span></td>
								<td><span><input type="radio" name="pc" value="good" /> </span></td>
								<td><span><input type="radio" name="pc" value="poor" /> </span></td>
								
								<td><span><textarea name="pcremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
								
								
							</tr>
							<tr>
								<td><span>Health club.</span></td>
								<td><span><input type="radio" name="hc" value="excellent" /> </span></td>
								<td><span><input type="radio" name="hc" value="good" /> </span></td>
								<td><span><input type="radio" name="hc" value="poor" /> </span></td>
								
								<td><span><textarea name="hcremark" style="border-color:#E4E3E9;height: 61px" ></textarea> </span></td>
							</tr>
							<tr>
								<td><span>Swimming Pool.</span></td>
								<td><span><input type="radio" name="sp" value="excellent" /> </span></td>
								<td><span><input type="radio" name="sp" value="good" /> </span></td>
								<td><span><input type="radio" name="sp" value="poor" /> </span></td>
								
								<td><span><textarea name="spremark" style="border-color:#E4E3E9;height: 61px"></textarea> </span></td>
							</tr>
							<tr>
								<td colspan="5">&nbsp;</td>
							</tr>
							<tr>
								<td><span>Name.</span></td>
								<td colspan="4"><span><input type="text" name="fname"></span></td>
							</tr>
							<tr>
								<td><span>Email.</span></td>
								<td colspan="4"><span><input type="text" name="email"></span></td>
							</tr>
							

							<tr>
								<td><span>Room No.</span></td>
								<td colspan="4"><span><input type="text" name="rumno"></span></td>
							</tr>
							<tr>
								<td><span>Designation.</span></td>
								<td colspan="4"><span><input type="text" name="desig"></span></td>
							</tr>
							<tr>
								<td><span>Contact no.</span></td>
								<td colspan="4"><span><input type="text" name="conno"></span></td>
							</tr>
							<tr>
								<td><span>Hotel Name.</span></td>
								<td colspan="4"><span>
								      <select name="hotelname" >
								      <option value=""></option>
								       <option></option>
								       </select></span></td>  
							</tr>
						
							<tr>
								<td><span>Date.</span></td>
								<td colspan="4"><span><input type="text" id="popupDatepicker"  name="date"></span></td>
							</tr>
							<tr>
								<td><span>Arrival Date.</span></td>
								<td colspan="4"><span><input type="text" id="popupDatepicker1" name="arrdate"></span></td>
							</tr>
							<tr>
								<td><span>Dept Date.</span></td>
								<td colspan="4"><span><input type="text" id="popupDatepicker2" name="deptdate"></span></td>
							</tr>
							<tr>
								<td><span>Anniversary Date.</span></td>
								<td colspan="4"><span><input type="text" name="andate" id="popupDatepicker3"></span></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							<td><input type="button" class="btn" value="Submit" onclick="formsubmit()" id="btn" name="enviar"></td>
							</tr>
						</tbody></table> </form>
						
							
                   </div>
							
							</fieldset> 
						</form> 
						
	</div>
	</div>
    			</div>
		
</div>
<?php require('includes/footer.php'); ?>
