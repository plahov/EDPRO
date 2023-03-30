<?php

use common\models\Order;
use common\models\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Order $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_time')->textInput(
        [
            'type' => 'datetime-local',
            'value' => date("Y-m-d\TH:i", $model->created_at)
        ]) ?>

    <?= $form->field($model, 'status')->dropDownList(
        Order::$statuses,
        ['prompt' => 'Выберите статус ...']
    ) ?>

    <?= $form->field($model, 'client')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'product_id')->dropDownList(
        ArrayHelper::map(Product::find()->asArray()->all(), 'id', 'name'),
        ['prompt' => 'Выберите товар ...']
    ) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true, 'type' => 'number', 'step' => 0.01]) ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
