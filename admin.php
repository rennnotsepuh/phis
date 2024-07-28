<?php
// Lokasi file teks
$data_file = 'data/ip.txt';

// Baca data dari file teks
if (file_exists($data_file)) {
    $ip_data = file($data_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $ip_data = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Admin Page</h1>
        <pre><?php echo htmlspecialchars(implode("\n", $ip_data)); ?></pre>
    </div>
</body>
</html>
