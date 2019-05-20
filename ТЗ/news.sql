create table news
(
	id int unsigned auto_increment
		primary key, -- Идентификатор новости
	title varchar(255) not null, -- Заголовок
	text mediumtext not null, -- Полный текст
	slug varchar(255) not null, -- Человекопонятный идентификатор
	short_text varchar(255) not null,  -- Короткая версия текста (для списка)
	date_publish datetime not null -- Дата публикации
	status int default '1' not null, -- Вкл/выкл
	image_file_name varchar(255) null, -- Ссылка на изображение
	created_at timestamp default '0000-00-00 00:00:00' not null,
	updated_at timestamp default '0000-00-00 00:00:00' not null
)
collate=utf8_unicode_ci
;