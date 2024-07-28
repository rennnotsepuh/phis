<?php
// Fungsi untuk mendapatkan lokasi dari IP menggunakan ipinfo.io
function get_location($ip) {
    $location = file_get_contents("http://ipinfo.io/{$ip}/json");
    return json_decode($location, true);
}

// Mendapatkan alamat IP asli pengguna
function get_user_ip() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Dapatkan alamat IP pengguna
$user_ip = get_user_ip();
$date_accessed = date('Y-m-d H:i:s');

// Dapatkan user agent pengguna
$useragent = $_SERVER['HTTP_USER_AGENT'];

// Dapatkan lokasi dari IP
$location_info = get_location($user_ip);
$location = $location_info['city'] . ', ' . $location_info['region'] . ', ' . $location_info['country'];

// Format data yang akan disimpan
$data = "IP: {$user_ip}\r\nUser-Agent: {$useragent}\r\nLocation: {$location}\r\nDate Accessed: {$date_accessed}\r\n\r\n";

// Lokasi file teks
$data_file = 'data/ip.txt';

// Menyimpan data ke dalam file teks
$fp = fopen($data_file, 'a');
fwrite($fp, $data);
fclose($fp);

// Arahkan pengguna ke halaman kosong
header("Location: index.php");
exit;
?>
