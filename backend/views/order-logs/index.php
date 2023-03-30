<?php

use common\models\Order;
use common\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-logs-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'created_at',
                'label' => 'Changed',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d H:i');
                }
            ],
            [
                'attribute' => 'user_id',
                'label' => 'User',
                'value' => function ($model) {
                    return \common\models\User::findOne(['id', $model->user_id])->username;
                }
            ],
            [
                'attribute' => 'order_id',
                'label' => 'Oder',
                'value' => function ($model) {
                    return \common\models\Order::findOne(['id', $model->order_id])->name;
                }
            ],
            [
                'attribute' => 'old_data',
                'label' => 'Old data',
                'format' => 'html',
                'value' => function ($model) {
                    $data = json_decode($model->old_data, true);
                    $body = "";
                    foreach($data as $key => $item) {

                        if($key == "product_id") {
                            $value = Product::findOne(['id' => $item])->name ?? $item;
                        } elseif($key == "status") {
                            $value = Order::$statuses[$item];
                        } elseif($key == "created_at") {
                            $value = Yii::$app->formatter->asDate($item, 'php:Y-m-d H:i');
                        } else {
                            $value = !empty($item) ? $item : "--empty value--";
                        }



                        $body .= in_array($key, Order::$logs)
                            ? $model->getAttributeLabel($key) . ": " . $value . "<br>"
                            : "";
                    }
                    return $body;
                }
            ],

        ],
    ]); ?>


</div>
