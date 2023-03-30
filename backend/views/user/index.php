<?php

use common\models\User;
use yii\bootstrap5\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'email:email',
//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'value' => function ($model) {
                    return $model->status == 10 ? "Активный" : "Неактивный";
                }
            ],
            //'created_at',
            //'updated_at',
            //'verification_token',
            [
                'class' => ActionColumn::className(),
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return Yii::$app->user->can('admin');
                    },
                    'delete' => function ($model, $key, $index) {
                        return Yii::$app->user->can('admin') && $model->id != Yii::$app->user->id;
                    },
                ],
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
