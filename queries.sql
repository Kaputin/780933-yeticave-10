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
VALUES (NOW(),'2014 Rossignol District Snowboard', 'snowboard rossignol', 'img/lot-1.jpg', 10999, '2019-08-31', 1000, 1, 1),
       (NOW(),'DC Ply Mens 2016/2017 Snowboard', 'snowboard dc', 'img/lot-2.jpg', 15999, '2019-09-01', 1000, 1, 1),
       (NOW(),'Крепления Union Contact Pro 2015 года размер L/XL', 'крепления L/XL', 'img/lot-3.jpg', 8000, '2019-09-02', 1000, 2, 2),
       (NOW(),'Ботинки для сноуборда DC Mutiny Charocal', 'ботинки dc', 'img/lot-4.jpg', 10999, '2019-09-03', 1000, 2, 3),
       (NOW(),'Куртка для сноуборда DC Mutiny Charocal', 'куртка dc', 'img/lot-5.jpg', 7500, '2019-09-04', 1000, 3, 4),
       (NOW(),'Маска Oakley Canopy', 'маска Oakley', 'img/lot-6.jpg', 5400, '2019-09-02', 1000, 3, 6);

INSERT INTO bet (bet_date, bet_amount, user_id, lot_id)
VALUES (NOW(), 11999, 2, 1),
       (NOW(), 12999, 3, 1),
       (NOW(), 13999, 2, 1);

SELECT name, symbolic_code FROM category; /* получить все категории */

SELECT l.name, start_price, image_url, c.name  FROM lot l  /* ЦЕНА из чего строится? получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории; */
JOIN category c ON l.category_id = c.id
WHERE date_close > NOW()
ORDER BY l.date_add DESC;

SELECT l.id, date_add, l.name, description, image_url, start_price, date_close, bet_step, author_id, c.name FROM lot l /* показать лот по его id. Получите также название категории, к которой принадлежит лот; */
JOIN category c ON l.category_id = c.id
WHERE l.id = 1;

UPDATE lot SET name = 'Новое название' /*обновить название лота по его идентификатору; */
WHERE id = 1;

SELECT l.id, bet_date, bet_amount, user_id FROM lot l /* получить список ставок для лота по его идентификатору с сортировкой по дате.*/
JOIN bet ON l.id = lot_id
WHERE l.id = 1
ORDER BY bet_date DESC;
