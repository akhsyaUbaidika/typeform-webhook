<?php
// Ambil data JSON dari body
$json = file_get_contents("php://input");

// Simpan semua ke file log (debug)
file_put_contents("webhook-log.txt", $json . PHP_EOL, FILE_APPEND);

// Jawaban ke Typeform
http_response_code(200);
echo "OK";
?>
