<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList([
        '10' => 'Активный',
        '9' => 'Неактивный',
    ]) ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?php if (Yii::$app->user->getId() != $model->id): ?>
        <?= $form->field($model, 'role')->dropDownList(
            ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
            ['prompt' => 'Выберите роль ...']
        ) ?>
    <?php endif; ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
