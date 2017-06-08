<?php  

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$phoneNumber = $_POST['phoneNumber'];
$company = $_POST['company'];
 
$hubspotutk      = $_COOKIE['hubspotutk']; 
$ip_addr         = $_SERVER['REMOTE_ADDR']; 
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://www.example.com/form-page',
    'pageName' => 'Example Title'
);
$hs_context_json = json_encode($hs_context);


$str_post = "firstname=" . urlencode($firstName) 
    . "&lastname=" . urlencode($lastName) 
    . "&email=" . urlencode($username) 
    . "&phone=" . urlencode($phonenumber) 
    . "&company=" . urlencode($company) 
    . "&hs_context=" . urlencode($hs_context_json); 


$endpoint = 'https://forms.hubspot.com/uploads/form/v2/3386649/e892460c-1da9-48c3-b0f3-d528fc4e9882';

$ch = @curl_init();
@curl_setopt($ch, CURLOPT_POST, true);
@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); 
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); 
@curl_close($ch);
echo $status_code . " " . $response;


?>
