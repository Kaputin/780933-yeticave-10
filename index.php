<?php
date_default_timezone_set("Europe/Moscow");
include_once('helpers.php');
$is_auth = rand(0, 1);
$user_name = 'Евгений'; // укажите здесь ваше имя
$content = '';
$categories = [];
$lots = [];

$link = mysqli_connect("localhost", "root", "", "yeticave");
if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
  else {
    mysqli_set_charset($link, "utf8");
}

if (!$link) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
}
else {
  // Запрос на получение списка категорий
  $sql = 'SELECT `name`, symbolic_code FROM category';
  $result = mysqli_query($link, $sql);
  // запрос выполнен успешно
    if ($result) {
      // получаем все категории в виде двумерного массива
      $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
      // получить текст последней ошибки
      $error = mysqli_error($link);
      $content = include_template('error.php', ['error' => $error]);
    }
  // Запрос на получение списка ЛОТОВ
  $sql = 'SELECT l.name, start_price, date_close,
  ifnull((SELECT bet_amount FROM bet WHERE lot_id = l.id ORDER BY bet_date DESC LIMIT 1), l.start_price) as last_price,
  image_url, c.name as category_name
  FROM lot l
  JOIN category c on l.category_id = c.id
  WHERE date_close > NOW()
  ORDER BY l.date_add desc';
  $result = mysqli_query($link, $sql);
    // запрос выполнен успешно
    if ($result) {
          // получаем все новые лоты в виде двумерного массива
          $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }
      else {
          $content = include_template('error.php', ['error' => mysqli_error($link)]);
      }
}

$content = include_template('main.php', [
  'lots' => $lots,
  'categories' => $categories
]);

$layout_content = include_template('layout.php', [
  'is_auth' => $is_auth,
  'user_name' => $user_name,
  'content' => $content,
  'categories' => $categories,
  'title' => 'YetiCave - Главная страница'
]);

function format_date (string $date_close): array {
  $secs_to_close = strtotime($date_close) - time();
  $hours = floor($secs_to_close / 3600);
  $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
  $minutes = floor(($secs_to_close % 3600) / 60);
  $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);
  $close_ts = [$hours, $minutes];
  return $close_ts;
}

function format_price(float $price): string {
  $output = ceil($price);
  if ($output >= 1000) {
    $output = number_format($output, 0, '', ' ');
  }
  $output .= ' ₽';
  return  $output;
}

print($layout_content);
