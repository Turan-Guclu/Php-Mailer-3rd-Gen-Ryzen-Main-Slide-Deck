<?php
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set('Etc/Utc');
require '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';
require '/usr/share/php/libphp-phpmailer/src/SMTP.php';
// PostaBilgileri.php de $KullaniciAdi ve $ Parola isminde 2 değişken oluşturmalısınız.
require 'mail/PostaBilgiler.php';
// Gönderilecek PostaBilgileri
$KimeAdres = "ubilmyo@gmail.com";
$KimeAdSoyad = 'Hüseyin Coşkun';
$Konu = '3. Nesil Amd ryzen Islemci Tanitim Belgeleri';
$MesajIcerik = "<p>Merhaba Yeni Nesil Amd İşlemcilere Bir Göz Atın. Şimdiden Baktığınız İcin Teşekkür Ederiz</p>";
$EkDosyasi = "mail/3rd Gen Ryzen Main Slide Deck.pdf";
$EkDosyaBaslik = "3rd Gen Ryzen Main Slide Deck";
$IcerikResim ="mail/test.jpg";
$IcerikResimID ="testimage";
$IcerikResimAd="test.jpg";
// posta isminde PHPMailer nesnesi oluşturuluyor
$posta= new PHPMailer;
$posta->isSMTP();
$posta->SMTPDebug =0;
$posta->SMTPAuth = true;
$posta->Host = 'smtp.gmail.com';
$posta->SMTPSecure = 'tls';
$posta->Port = 587;
$posta->Charset='UTF-8';
$posta->Username = $KullaniciAdi; // Gönderici E-Mail
$posta->Password = $Parola; // Gönderici E-Mail Parola
$posta->setFrom($KullaniciAdi, 'Turan Guclu Posta Sistemi');
$posta->addAddress($KimeAdres,$KimeAdSoyad );
$posta->isHTML(true);
$posta->Subject = $Konu;
$posta->Body = $MesajIcerik;
// Dosya Ekleme
$posta->addAttachment($EkDosyasi, $EkDosyaBaslik);
//Ekli Resmi posta metni içinde görüntüleme
$posta->AddEmbeddedImage($IcerikResim, $IcerikResimID, $IcerikResimAd);
$posta->Body .= 'Bu Mail Advanced Micro Devices ® Tarafından PHP dili ile gönderilmiştir.<br/> Amd Ryzen Logo: <img alt="" src="cid:' .$IcerikResimID.'">';
if (!$posta->send())
{
	echo $posta->ErrorInfo;
}else
	print "$KimeAdres adresine E-posta başarılı bir şekilde gönderildi";
?>