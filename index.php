<?php
date_default_timezone_set("Europe/Moscow");
include_once('helpers.php');
$is_auth = rand(0, 1);

$user_name = 'Евгений'; // укажите здесь ваше имя

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$lots = [
  [
    'name' => '2014 Rossignol District Snowboard',
    'categories' => 'Доски и лыжи',
    'price' => '10999',
    'picture' => 'img/lot-1.jpg',
    'date_close' => '2019-08-28'
   ],
  [
    'name' => 'DC Ply Mens 2016/2017 Snowboard',
    'categories' => 'Доски и лыжи',
    'price' => '159999',
    'picture' => 'img/lot-2.jpg',
    'date_close' => '2019-08-29'
  ],
  [
    'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
    'categories' => 'Крепления',
    'price' => '8000',
    'picture' => 'img/lot-3.jpg',
    'date_close' => '2019-08-31'
  ],
  [
    'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'categories' => 'Ботинки',
    'price' => '10999',
    'picture' => 'img/lot-4.jpg',
    'date_close' => '2019-09-01'
  ],
  [
    'name' => 'Куртка для сноуборда DC Mutiny Charocal',
    'categories' => 'Одежда',
    'price' => '7500',
    'picture' => 'img/lot-5.jpg',
    'date_close' => '2019-09-02'
  ],
  [
    'name' => 'Маска Oakley Canopy',
    'categories' => 'Разное',
    'price' => '5400',
    'picture' => 'img/lot-6.jpg',
    'date_close' => '2019-09-03'
  ]
];

function format_date (string $date_close): array {
  $ts = time();
  $secs_to_close = strtotime($date_close) - $ts;

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

$page_content = include_template('main.php', [
  'lots' => $lots,
  'categories' => $categories
]);

$layout_content = include_template('layout.php', [
  'is_auth' => $is_auth,
  'user_name' => $user_name,
  'content' => $page_content,
  'categories' => $categories,
  'title' => 'YetiCave - Главная страница'
]);

print($layout_content);
