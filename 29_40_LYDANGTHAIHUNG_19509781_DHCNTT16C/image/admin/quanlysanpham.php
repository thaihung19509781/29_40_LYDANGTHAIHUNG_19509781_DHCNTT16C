
<?php
/*session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']))
{
	include("../myclass/clslogin_tmdt.php");
	$q=new login();
	$q->confirmlogin($_SESSION['id'],$_SESSION['user'],$_SESSION['pass']);
}
else
{
	header('location:login.php');
}
*/
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass']))
{
	include('../myclass/clslogin_tmdt.php');
	$q=new login();
	$q->confirmlogin($_SESSION['id'],$_SESSION['user'],$_SESSION['pass']);
}
else
{
	header('location:login_tmdt.php');
}
include("../myclass/clstmdt.php");
$p= new tmdt();
$layid=0;
if(isset($_REQUEST['id']))
{
	$layid=$_REQUEST['id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="myfm" id="myfm">
  <table width="563" border="1" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <td colspan="2" align="center"><strong>QUẢN LÝ SẢN PHẨM</strong></td>
    </tr>
    <tr>
      <td width="257" align="left">Công ty cung cấp</td>
      <td width="280" align="left">
      	<?php
			$layid_congty=$p->laycot("select id_congty from sanpham where id='$layid' limit 1");
			$p->loadcombo_congty(" select * from congty order by id asc",$layid_congty);
		?>
      
        <label for="txtid"></label>
       <input name="txtid" type="hidden" id="txtid" value="<?php echo $layid; ?>" /></td>
    </tr>
    <tr>
      <td align="left">Nhập tên sản phẩm</td>
      <td align="left"><label for="txtten"></label>
      <input name="txtten" type="text" id="txtten" value="<?php echo $p->laycot("select tensp from sanpham where id='$layid' limit 1"); ?>" /></td>
    </tr>
    <tr>
      <td align="left">Nhập giá</td>
      <td align="left"><label for="txtgia"></label>
      <input name="txtgia" type="text" id="txtgia" value="<?php echo $p->laycot("select gia from sanpham where id='$layid' limit 1"); ?>" /></td>
    </tr>
    <tr>
      <td align="left">Nhập mô tả</td>
      <td align="left"><label for="txtmota"></label>
      <textarea name="txtmota" id="txtmota" cols="45" rows="5"><?php echo $p->laycot("select mota from sanpham where id='$layid' limit 1");?> 
      </textarea>        
    </td>
    </tr>
    <tr>
      <td height="58" align="left">Chọn hình đại diện</td>
      <td align="left"><label for="myfile"></label>
      <input type="file" name="myfile" id="myfile" /></td>
    </tr>
    <tr>
    	<td colspan="2" align="center" valign="middle" >
        <input type="submit" name="nut" id="nut" value="Them san pham" />
         <input type="submit" name="nut" id="nut" value="Xoa san pham" />
         <input type="submit" name="nut" id="nut" value="Sua san pham" />
        </td>
    </tr>
  </table>
 
  <div align="center">
  	<?php
		switch($_POST['nut'])
		{
			case'Them san pham':
			{
				$id_congty=$_REQUEST['congty'];
				$ten=$_REQUEST['txtten'];
				$gia=$_REQUEST['txtgia'];
				$mota=$_REQUEST['txtmota'];
				$name=$_FILES['myfile']['name'];
				$tmp_name=$_FILES['myfile']['tmp_name'];
				$size=$_FILES['myfile']['size'];
				$type=$_FILES['myfile']['type'];
				//upload hinh len truoc
				if($name!='')
				{
					$name=time()."_".$name;
					if($p->myupfile($name,$tmp_name,"../hinh")==1)
					{
						if($p->themxoasua("INSERT INTO sanpham(tensp,gia,mota,hinh,id_congty)VALUES( '$ten', '$gia', '$mota', '$name', 		                    '$id_congty')")==1)
						{
							echo'Them san pham thanh cong';
						}
						else
						{
							echo 'Them khong thanh cong';
						}
					}
					else
					{
						echo 'Upload hinh khong thanh cong';
					}
				}
				else
				{
					echo'vui long chon anh dai dien';
				}
				break;
			}
			case'Xoa san pham':
			{
				$idxoa=$_REQUEST['txtid'];
				if($idxoa>0)
				{
					if($p->themxoasua("delete from sanpham where id=$idxoa limit 1 ")==1)
					{
						header('location:quanlysanpham.php');
					}
					else
					{
						echo 'Xoa khong thanh cong';
					}
				}
				else
				{
					echo 'Vui long chon hang can xoa';
				}
				break;
			}
			case'Sua san pham':
			{
				$idsua=$_REQUEST['txtid'];
				$id_congty=$_REQUEST['congty'];
				$ten=$_REQUEST['txtten'];
				$gia=$_REQUEST['txtgia'];
				$mota=$_REQUEST['txtmota'];
				if($idsua>0)
				{
					if($p->themxoasua("UPDATE sanpham SET tensp = '$ten',gia = '$gia',mota = '$mota' WHERE id ='$idsua' limit 1")==1)
					{
						header("location:quanlysanpham.php");
					}
					else
					{
						echo 'Sua khong thanh cong';
					}
				}
				else
				{
					echo 'Vui long chon san pham can sua';
				}
				break;
			}
		}
		
		
	?>
  </div>
  <hr />
  <?php
  	$p->load_danhsach_sanpham("select * from sanpham order by id desc");
  ?>
</form>
</body>
</html>