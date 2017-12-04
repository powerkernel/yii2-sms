Yii2 SMS
========
Yii2 SMS API

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist powerkernel/yii2-sms "*"
```

or add

```
"powerkernel/yii2-sms": "*"
```

to the require section of your `composer.json` file.

MySQL

```
php yii migrate --migrationPath=@vendor/powerkernel/yii2-sms/migrations/ --migrationTable={{%sms_migration}}
```

MongoDB

```
php yii mongodb-migrate --migrationPath=@vendor/powerkernel/yii2-sms/migrations/mongodb/ --migrationCollection=sms_migration
```
