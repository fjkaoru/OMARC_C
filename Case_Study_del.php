<?php 
include ("check_login.php"); 
include("conn/conn.php");
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<head>
<title>Nursing Training System</title>
<link href="CSS/style.css" rel="stylesheet">
<link href="CSS/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.min.css" /> 
<script src="javascripts/bootstrap.min.js"></script>
<script src="javascripts/jquery-2.1.1.min.js"></script> 
</head>
<table width="776" border="0" align="center" cellpadding="0" cellspacing="0" class="tableBorder">
  <tr>
    <td><?php include("navigation.php"); ?></td>
  </tr>
	<td bgcolor="#FFFFFF">
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><table width="100%" height="510"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="tableBorder_gray">
  <tr>
    <td align="center" valign="top" style="padding:5px;"><table width="738"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="148" valign="top"><table width="738"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="753" height="44" background="Images/del_case_study.jpg">&nbsp; </td>
          </tr>
          <tr>
    <table align="center" width="100%" border="bordered" > 
    <form   name= "kk" method="post" enctype="multipart/form-data" action="Case_Study_del_ok.php" >      
    <tr align="center">
        <td width="10">Num.</td>
        <td width="20%">Case Study Name </td>
        <td width="70%">Case Study Description</td>
		<?php if (0==$_SESSION[gid]){ ?>
        <td width="3%">UserId</td>
        <td width="10">User Name</td>
        <?php }?>      </tr>
      <?php
            if (0==$_SESSION[gid])
					$sql=mysql_query("select * from case_study as c INNER JOIN user as d on c.owner = d.userId order by id");
			else $sql=mysql_query("select * from case_study where owner='$_SESSION[uid]' order by id");
            $info=mysql_fetch_array($sql);
            $i=1;
            do{
            ?>
      <tr>
        <td height="25" align="center"><?php echo $i;?></td>
        <td style="padding:5px;"><label><input name="sel_casestudy" type="checkbox" value="<?php echo $info[id];?>" onClick="">&nbsp;<?php echo $info[name];?></label>
        <td style="padding:5px;">&nbsp;<?php echo $info[description];?></td>
		<?php if (0==$_SESSION[gid]){ ?>
        <td align="center" style="padding:5px; ">&nbsp;<?php echo $info[owner];?></td>
        <td align="center" style="padding:5px; ">&nbsp;<?php echo $info[username];?></td>
        <?php }?>
      </tr>
      <?php 
         $i=$i+1;
         }while($info=mysql_fetch_array($sql));
        ?>
        </td>
  </tr>

</table> 
<script language="javascript">
    function Check_Submit(form){
		
		   var session_casestudy = new Array;
		   var session_casestudy_num = 0;
           for(var i=0;i<form.sel_casestudy.length;i++)
           {
               if(form.sel_casestudy[i].checked==true)
               {  
                	session_casestudy[session_casestudy_num]= form.sel_casestudy[i].value;
					session_casestudy_num++;
               }
           }
		   
		   string_for_transmit = session_casestudy.join("-"); 
		   var qq = string_for_transmit;
		   //alert( qq ); // the selected sounds
		   document.getElementById("test").value = qq;


		if(session_casestudy.length == 0){ 
            alert("Please select at least one casestudy!");
			return false;
//        }else if(session_casestudy.length > 1){ 
//            alert("Please no more 1 casestudy!");
//			window.location='append_se_to_CaseStudy.php';
//			return false;
        } else { 
			var flag =confirm("Do you want to delete these Case Studies?");
			if (flag == true){
			form.submit();
			}else{
				return false;
			}
		}
	}
</script>

	<input type="hidden" id="test" name="test"/>
    <center><input type="button" value="Delete the selected CaseStudies" name="upload" class="btn btn-success" onClick="return Check_Submit(kk)"/>
	<input name="Submit2" type="button" class="btn btn-danger" value="Return to Index" onClick="window.location.href='index.php'"/>
    </form> 
    </table>
      <p>&nbsp;</p></td>
  </tr>
</table></td>
  </tr>
</table>

<?php include("copyright.php"); ?></td>
  </tr>
</table>
</html>