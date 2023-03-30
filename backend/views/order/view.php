<?php

use common\models\Order;
use common\models\Product;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Order $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client',
            'name',
            [
                'attribute' => 'product_id',
                'label' => 'Product',
                'value' => function ($model) {
                    return Product::findOne(['id' => $model->product_id])->name;
                }
            ],
            'phone',
            [
                'label' => 'Status',
                'value' => function ($model) {
                    return Order::$statuses[$model->status];
                }
            ],
            'comment:ntext',
            'price',
            [
                'attribute' => 'created_at',
                'label' => 'Created at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d H:i');
                }
            ],
            [
                'attribute' => 'updated_at',
                'label' => 'Created at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at, 'php:Y-m-d H:i');
                }
            ],
        ],
    ]) ?>

</div>
