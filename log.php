<?php
$data = file_get_contents("webhook-log.txt");
if (!$data) {
    echo "Belum ada data.";
    return;
}

// Ambil baris terakhir (anggap hanya 1 per testing)
$lines = explode(PHP_EOL, trim($data));
$last = json_decode(end($lines), true);

// Ambil metadata
$form_title = $last['form_response']['definition']['title'];
$submitted = $last['form_response']['submitted_at'];
$answers = $last['form_response']['answers'];
$fields = $last['form_response']['definition']['fields'];

// Mapping field ID ke pertanyaan
$questions = [];
foreach ($fields as $f) {
    $questions[$f['id']] = $f['title'];
}

// Tampilkan hasil
echo "<h2>$form_title</h2>";
echo "<b>Tanggal Submit:</b> $submitted<br><br>";

$i = 1;
foreach ($answers as $ans) {
    $field_id = $ans['field']['id'];
    $question = $questions[$field_id] ?? '(Pertanyaan tidak ditemukan)';
    $type = $ans['type'];
    $value = '';

    switch ($type) {
        case 'text':
            $value = $ans['text'];
            break;
        case 'number':
            $value = $ans['number'];
            break;
        case 'boolean':
            $value = $ans['boolean'] ? 'Yes' : 'No';
            break;
        case 'choice':
            $value = $ans['choice']['label'];
            break;
    }

    echo "<b>$i. $question</b><br>➤ $value<br><br>";
    $i++;
}
?>
