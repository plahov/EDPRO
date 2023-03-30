<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-4 text-center">Отправить заявку!</h1>
            <p class="fs-5 fw-light text-center">Заполните поля и отправьте заявку</p>
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>

                    <?= $form->field($model, 'client')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'phone') ?>

                    <?= $form->field($model, 'product_id')->dropDownList(
                        $products,
                        ['prompt' => 'Выберите продукт ...']
                    ) ?>

                    <?= $form->field($model, 'comment')->textarea() ?>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
