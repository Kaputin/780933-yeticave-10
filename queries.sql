INSERT INTO category (name, symbolic_code)
VALUES ('Доски и лыжи','boards'),
       ('Крепления','attachment'),
       ('Ботинки','boots'),
       ('Одежда','clothing'),
       ('Инструменты','tools'),
       ('Разное','other');

INSERT INTO user (date_add, email, name, password, contact)
VALUES (NOW(),'alfa@mail.ru', 'alfa', 'alfa123', '+71111111111'),
       (NOW(),'beta@gmail.ru', 'beta', 'beta123', '+72222222222'),
       (NOW(),'gamma@mail.ru', 'gamma', 'gamma123', '+73333333333');

INSERT INTO lot (date_add, name, description, image_url, start_price, date_close, bet_step, author_id, category_id)
VALUES ('2019-08-25 18:00:00','2014 Rossignol District Snowboard', 'snowboard rossignol', 'img/lot-1.jpg', 10999, '2019-09-01', 1000, 1, 1),
       ('2019-08-25 18:40:35','DC Ply Mens 2016/2017 Snowboard', 'snowboard dc', 'img/lot-2.jpg', 15999, '2019-09-01', 1000, 1, 1),
       ('2019-08-26 15:40:00','Крепления Union Contact Pro 2015 года размер L/XL', 'крепления L/XL', 'img/lot-3.jpg', 8000, '2019-09-02', 1000, 2, 2),
       ('2019-08-26 17:35:10','Ботинки для сноуборда DC Mutiny Charocal', 'ботинки dc', 'img/lot-4.jpg', 10999, '2019-09-03', 1000, 2, 3),
       ('2019-08-29 19:00:00','Куртка для сноуборда DC Mutiny Charocal', 'куртка dc', 'img/lot-5.jpg', 7500, '2019-09-04', 1000, 3, 4),
       ('2019-08-28 21:00:00','Маска Oakley Canopy', 'маска Oakley', 'img/lot-6.jpg', 5400, '2019-09-02', 1000, 3, 6);

INSERT INTO bet (bet_date, bet_amount, user_id, lot_id)
VALUES ('2019-08-25 18:05:00', 11999, 2, 1),
       ('2019-08-25 18:20:00', 12999, 3, 1),
       (NOW(), 13999, 2, 1),
       (NOW(), 99999, 2, 2),
       (NOW(), 29999, 2, 2),
       (NOW(), 49999, 2, 3);

/* получить все категории */

SELECT name, symbolic_code FROM category;

/* получить самые новые, открытые лоты.
Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории; */

SELECT l.name, start_price,
ifnull((SELECT bet_amount FROM bet WHERE lot_id = l.id ORDER BY bet_date DESC LIMIT 1), l.start_price) as last_price, 
image_url, c.name as category_name
FROM lot l
JOIN category c on l.category_id = c.id
WHERE date_close > NOW()
ORDER BY l.date_add desc;

/* показать лот по его id. Получите также название категории, к которой принадлежит лот; */

SELECT l.id, date_add, l.name, description, image_url, start_price, date_close, bet_step, author_id, c.name as category_name FROM lot l
JOIN category c ON l.category_id = c.id
WHERE l.id = 1;

/*обновить название лота по его идентификатору; */

UPDATE lot SET `name` = 'Новое название'
WHERE id = 1;

/* получить список ставок для лота по его идентификатору с сортировкой по дате.*/
SELECT bet_date, bet_amount, user_id, lot_id FROM bet WHERE lot_id = 1
ORDER BY bet_date DESC;
