<?php
// Задайте допустимые учетные данные
$validCredentials = [
    '********',
    '********'
];

// Получаем введенные данные из POST-запроса
$inputLogin = $_POST['login'] ?? '';

// Проверяем, есть ли введенные данные в допустимых учетных данных
if (in_array($inputLogin, $validCredentials)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>