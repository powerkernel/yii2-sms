<?php

use modernkernel\sms\models\Setting;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model yii\base\DynamicModel */

$this->title = Yii::t('sms', 'Settings');
$this->params['breadcrumbs'][] = ['label' => 'SMS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="contact-setting">

    <div class="box box-primary">
        <div class="box-body">

            <?php $form = ActiveForm::begin([
                'layout' => 'horizontal',
                'fieldConfig' => ['horizontalCssClasses' => [
                    'offset' => '',
                    'label' => 'col-sm-2',
                    'wrapper' => 'col-sm-6',
                    'error' => '',
                    'hint' => 'col-sm-4',
                ]],
            ]); ?>

            <?php foreach ($model->attributes as $attribute=>$value) : ?>
                <?= $form->field($model, $attribute)->textInput()->label($attribute)->hint(Setting::findTitle($attribute)); ?>
            <?php endforeach; ?>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton(Yii::$app->getModule('sms')->t('Save'), ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>

</div>