<?php
include_once('helpers.php');
$is_auth = rand(0, 1);

$user_name = 'Евгений'; // укажите здесь ваше имя

$categories = ["Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"];
$lots = [
  [
    'name' => '2014 Rossignol District Snowboard',
    'categories' => 'Доски и лыжи',
    'price' => '10999',
    'picture' => 'img/lot-1.jpg'
  ],
  [
    'name' => 'DC Ply Mens 2016/2017 Snowboard',
    'categories' => 'Доски и лыжи',
    'price' => '159999',
    'picture' => 'img/lot-2.jpg'
  ],
  [
    'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
    'categories' => 'Крепления',
    'price' => '8000',
    'picture' => 'img/lot-3.jpg'
  ],
  [
    'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
    'categories' => 'Ботинки',
    'price' => '10999',
    'picture' => 'img/lot-4.jpg'
  ],
  [
    'name' => 'Куртка для сноуборда DC Mutiny Charocal',
    'categories' => 'Одежда',
    'price' => '7500',
    'picture' => 'img/lot-5.jpg'
  ],
  [
    'name' => 'Маска Oakley Canopy',
    'categories' => 'Разное',
    'price' => '5400',
    'picture' => 'img/lot-6.jpg'
  ]
];

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
