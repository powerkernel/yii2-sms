<?php

namespace modernkernel\sms;

use Yii;

/**
 * sms module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'modernkernel\sms\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //\Yii::configure($this, require(__DIR__ . '/config.php'));
        $this->registerTranslations();
        $this->registerMailer();
    }

    /**
     * Config Mailer for the Module
     */
    public function registerMailer()
    {
        Yii::$app->mailer->setViewPath($this->basePath . '/mail');
        Yii::$app->mailer->htmlLayout='@common/mail/layouts/html';
        Yii::$app->mailer->textLayout='@common/mail/layouts/text';
    }

    /**
     * Register translation for the Module
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['sms'] = [
            'class' => 'common\components\DbMessageSource',
            'on missingTranslation' => function ($event) {
                $event->sender->insertMissingTranslation($event);
            },
        ];
    }

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     */
    public static function t($message, $params = [], $language = null)
    {
        return Yii::$app->getModule('sms')->translate($message, $params, $language);
    }

    /**
     * Translate message
     * @param $message
     * @param array $params
     * @param null $language
     * @return mixed
     */
    public static function translate($message, $params = [], $language = null)
    {
        return Yii::t('sms', $message, $params, $language);
    }
}