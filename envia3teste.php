<html> 
<head> 
<title>.:: E-mail com arquivo ataxado ::.</title> 
</head> 
<style> 
.input {font-family: Verdana; font-size: 10px; color:#00000; background:#FFFFFF; border-right:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; border-bottom:1px solid #000000;} 
table {font-family: verdana; font-size: 11px; color: #000000; } 
.titulo {font-family: verdana; font-size: 13px; color: #FB3832; } 
a {text-decoration:none; font-family: verdana; font-size: 11px; color: #000099; } 
a:hover {text-decoration:underline; font-family: verdana; font-size: 11px; color: #000099; } 
</style> 
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" oncontextmenu="return false" onselectstart="return false"> 
<table cellpadding="0" cellspacing="0" border="0">
<? 
if($aux!="1") 
{ 
?>
<form action="http://coralpinturas.com.br/homologacao/envia2teste.php" method="post" enctype="multipart/form-data">

<input type="Hidden" name="aux" value="1">
<tr> 
<td height="18" colspan="2" valign="top"><div align="center"></div></td>
</tr>
<tr> 
<td width="66" valign="top">Nome:</td>
<td valign="top"><input type="Text" name="nome" size="70" class="input"></td>
</tr>
<tr> 
<td valign="top">E-mail:</td>
<td valign="top"><input type="Text" name="mail_sender" size="30" class="input"></td>
</tr>
<tr> 
<td valign="top">Assunto:</td>
<td valign="top"><input type="Text" name="assunto" size="30" class="input"></td>
</tr>
<tr> 
<td valign="top">Mensagem:</td>
<td valign="top"><textarea name="msg" class="input" cols="70" rows="10"></textarea></td>
</tr>
<tr> 
<td valign="top">Arquivo:</td>
<td valign="top"><input type="File" name="arquivo" class="input" size="30"></td>
</tr>
<tr> 
<td valign="top" colspan="2" align="center"><input type="Submit" value="Enviar" class="input"></td>
</tr>
</form>
<? 
} 
else 
{ 

$bound = "XYZ-" . date("dmYis") . "-ZYX"; 
if (($fp = fopen($_FILES['arquivo']['tmp_name'],"r"))) 
{ 
$anexo = fread($fp,filesize($_FILES['arquivo']['tmp_name']));
$anexo = base64_encode($anexo); 
fclose($fp); 
$anexo = chunk_split($anexo); 
} 
if ($anexo) 
{ 
$mensagem = wordwrap($message, 50, "<br>", 1);
$mensagem = "--$bound\nContent-type: text/html\nContent-Transfer-Encoding: 7bit\n\n$corpo\n\n" 
. "--$bound\nContent-type: $_FILES[arquivo][type]\nContent-Disposition: attachment; filename=" . $_FILES['arquivo']['name'] . "\nContent-Transfer-Encoding: base64\n\n$anexo\n" 
. "--$bound\r\n"; 

$img = $_POST['msg'];
$img .= $mensagem;
$corpo = "Nome:$_POST[nome]<br>E-mail: $_POST[mail_sender]<br>Mensagem: $img";

mail("paulino100@gmail.com",$assunto,$mensagem,"From: $_POST[mail_sender]\nMIME-Version: 1.0\nContent-type: multipart/mixed; boundary=\"$bound\""); 
print("Enviado com Sucesso! anexo"); 
print($fp);
} 
else 
{ 
alert('Anexo');
return false;
} 
} 
?>
</table> 
</body> 
</html>