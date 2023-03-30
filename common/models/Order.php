<?php

namespace common\models;

use backend\models\OrderLog;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $client
 * @property string $name
 * @property string $product_id
 * @property string $phone
 * @property string $status
 * @property string|null $comment
 * @property float $price
 * @property int $created_at
 * @property int $updated_at
 */
class Order extends \yii\db\ActiveRecord
{

    public $form_time;

    /**
     * @var array
     */
    public static $statuses = [
        'new' => 'Новая заявка',
        'accept' => 'Принята',
        'cancel' => 'Отказана',
        'defect' => 'Брак',
    ];

    /**
     * @var array
     */
    public static $export = [
        'name',
        'product_id',
        'price',
        'phone'
    ];

    /**
     * @var array
     */
    public static $logs = [
        'client',
        'name',
        'product_id',
        'phone',
        'created_at',
        'status',
        'comment',
        'price'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
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
            [['client', 'name', 'product_id', 'phone', 'price'], 'required'],
            [['comment'], 'string'],
            [['price'], 'number'],
            [['form_time'], 'safe'],
            [['product_id', 'created_at', 'updated_at'], 'integer'],
            [['client', 'name', 'phone', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client' => 'Client',
            'name' => 'Name',
            'product_id' => 'Product',
            'phone' => 'Phone',
            'status' => 'Status',
            'comment' => 'Comment',
            'price' => 'Price',
            'form_time' => 'Created At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        OrderLog::create($this->id, $changedAttributes);
    }
}
