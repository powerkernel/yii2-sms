Yii2 SMS
========
Yii2 SMS API

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist modernkernel/yii2-sms "*"
```

or add

```
"modernkernel/yii2-sms": "*"
```

to the require section of your `composer.json` file.

MySQL

```
php yii migrate --interactive=0 --migrationPath=@vendor/modernkernel/yii2-sms/migrations/ --migrationTable={{%sms_migration}}
```

MongoDB

```
php yii mongodb-migrate --interactive=0 --migrationPath=@vendor/modernkernel/yii2-sms/migrations/mongodb/ --migrationCollection=sms_migration
```
