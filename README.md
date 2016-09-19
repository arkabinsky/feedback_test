# feedback_test
### Установка:

Разместите содержимое репозитория в папке (например под названием `feedback_test`), в корневой директории веб сервера

Приложение станет доступно по ссылке
~~~
http://localhost/feedback_test/
~~~

### БД:
Разверните дамп базы, который находится в `protected/data/schema.mysql.sql`


В файле конфигурации БД `protected/config/database.php` укажите реальные данные, например:

```php
return array(
	  'connectionString' => 'mysql:host=localhost;dbname=feedback_test',
	  'emulatePrepare' => true,
	  'username' => 'root',
	  'password' => '1234',
	  'charset' => 'utf8',
);
```
