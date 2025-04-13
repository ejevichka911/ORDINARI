<?php

// Имя файла, в котором будет храниться счетчик.
$counter_file = 'counter.txt';

// Функция для получения текущего значения счетчика.
function get_counter() {
  global $counter_file;
  if (file_exists($counter_file)) {
    $counter = (int)file_get_contents($counter_file);
  } else {
    $counter = 0;
  }
  return $counter;
}

// Функция для увеличения счетчика и сохранения его в файл.
function increment_counter() {
  global $counter_file;
  $counter = get_counter();
  $counter++;
  file_put_contents($counter_file, $counter);
  return $counter;
}

// Проверяем, была ли отправлена форма POST-запросом.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Увеличиваем счетчик.
  $count = increment_counter();

  // (Необязательно) Выводим сообщение о том, что счетчик увеличен.  Это может быть полезно для отладки.
  echo "<p>Товар сохранен. Количество отправленных форм: " . $count . "</p>";
}

?>
