<?php  

$firstName = $_POST['firstName'];
// echo $firstName;
$lastName = $_POST['lastName'];
$username = $_POST['username'];
// $password = $_POST['password'];
// $agreed = $_POST['agreed'];
$phonenumber = "1234567789";
$company = "Awesome Archer";


 //Process a new form submission in HubSpot in order to create a new Contact.

$hubspotutk      = $_COOKIE['hubspotutk']; //grab the cookie from the visitors browser.
$ip_addr         = $_SERVER['REMOTE_ADDR']; //IP address too.
$hs_context      = array(
    'hutk' => $hubspotutk,
    'ipAddress' => $ip_addr,
    'pageUrl' => 'http://www.example.com/form-page',
    'pageName' => 'Example Title'
);
$hs_context_json = json_encode($hs_context);

//Need to populate these variable with values from the form.
$str_post = "firstname=" . urlencode($firstName) 
    . "&lastname=" . urlencode($lastName) 
    . "&email=" . urlencode($username) 
    . "&phone=" . urlencode($phonenumber) 
    . "&company=" . urlencode($company) 
    . "&hs_context=" . urlencode($hs_context_json); //Leave this one be

//replace the values in this URL with your portal ID and your form GUID
$endpoint = 'https://forms.hubspot.com/uploads/form/v2/3386649/e892460c-1da9-48c3-b0f3-d528fc4e9882';

$ch = @curl_init();
@curl_setopt($ch, CURLOPT_POST, true);
@curl_setopt($ch, CURLOPT_POSTFIELDS, $str_post);
@curl_setopt($ch, CURLOPT_URL, $endpoint);
@curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded'
));
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response    = @curl_exec($ch); //Log the response from HubSpot as needed.
$status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE); //Log the response status code
@curl_close($ch);
echo $status_code . " " . $response;



?>
