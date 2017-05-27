Yii2 Plivo
==========
Yii2 Plivo SMS API

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist modernkernel/yii2-plivo "*"
```

or add

```
"modernkernel/yii2-plivo": "*"
```

to the require section of your `composer.json` file.

```
php yii migrate --interactive=0 --migrationPath=@vendor/modernkernel/yii2-plivo/migrations/ --migrationTable={{%plivo_migration}}
```
