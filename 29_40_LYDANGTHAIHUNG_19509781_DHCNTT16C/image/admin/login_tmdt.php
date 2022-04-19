
<?php
include("../myclass/clslogin_tmdt.php");
$p=new login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="myfm" name="myfm" method="post" action="">
  <table width="500" border="1" cellspacing="0" cellpadding="2" align="center">
    <tr>
      <td height="38" colspan="2" align="center"><strong>DANG NHAP</strong></td>
    </tr>
    <tr>
      <td width="179" align="left">Nhap username</td>
      <td width="307" align="left" valign="middle"><label for="txtuser">
        <input type="text" name="txtuser" id="txtuser" />
      </label></td>
    </tr>
    <tr>
      <td align="left">Nhap password</td>
      <td align="left"><label for="txtpass"></label>
      <input type="password" name="txtpass" id="txtpass" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Login" /></td>
    </tr>
  </table>
  <div align="center">
  	<?php
	switch($_POST['nut'])
	{
		case'Login':
		{
			$user=$_REQUEST['txtuser'];
			$pass=$_REQUEST['txtpass'];
			if($user!='' && $pass!='')
			{
				if($p->mylogin($user,$pass)==1)
				{
					header('location:quanlysanpham.php');
				}
				else
				{
					echo'Dang nhap khong thanh cong';
				}
			}
			else
			{
				echo'Vui long nhap day du thong tin';
			}
			break;
		}
	}
	?>
  </div>
</form>

</body>
</html>