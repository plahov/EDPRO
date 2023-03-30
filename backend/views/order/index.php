<?php

use common\models\Order;
use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Download CSV', ['csv-export'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'client',
            'name',
            'phone',
            [
                'attribute' => 'product_id',
                'label' => 'Product',
                'value' => function ($model) {
                    return Product::findOne(['id' => $model->product_id])->name;
                }
            ],
            'price',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => function ($model) {
                    return Order::$statuses[$model->status];
                }
            ],
            //'comment:ntext',
            //'created_at',
            [
                'attribute' => 'created_at',
                'label' => 'Created at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d H:i');
                }
            ],
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
