<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order_logs".
 *
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string $old_data
 * @property int $created_at
 * @property int $updated_at
 */
class OrderLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'old_data', 'order_id'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'order_id'], 'integer'],
            [['old_data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
            'old_data' => 'Old Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param $order_id
     * @param $changedAttributes
     * @return bool
     */
    public static function create($order_id, $changedAttributes)
    {
        // удалим элемент updated_at
        array_pop($changedAttributes);
        $log = new OrderLog();
        $log->user_id = Yii::$app->user->id;
        $log->order_id = $order_id;
        $log->old_data = json_encode($changedAttributes);
        return $log->save();
    }
}
