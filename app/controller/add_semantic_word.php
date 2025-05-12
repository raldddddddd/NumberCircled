<?php
$type = $_POST['sentiment'] ?? '';
$word = trim($_POST['word'] ?? '');

if (!in_array($type, ['positive', 'negative']) || empty($word)) {
    echo "Invalid input.";
    exit;
}

$filename = __DIR__ . "/../../assets/{$type}-words.txt";
$existingWords = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (in_array(strtolower($word), array_map('strtolower', $existingWords))) {
    echo "Word already exists in {$type} list.";
    exit;
}

file_put_contents($filename, $word . PHP_EOL, FILE_APPEND);
echo "Word added to {$type} list.";
