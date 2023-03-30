<?php

namespace frontend\models;

use common\models\Order;
use common\models\Product;
use yii\base\Model;

/**
 * Order form
 */
class OrderForm extends Model
{
    public $client;
    public $phone;
    public $comment;
    public $product_id;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['client', 'trim'],
            ['client', 'required'],
            ['client', 'string', 'min' => 2, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'string', 'min' => 2, 'max' => 255],

            ['product_id', 'required'],

            ['comment', 'string', 'min' => 10],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function send()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $order = new Order();
        $order->client = $this->client;
        $order->phone = $this->phone;
        $order->product_id = $this->product_id;
        if(!empty($this->comment)) {
            $order->comment = $this->comment;
        }
        $order->name = "Заявка от " . $order->client;
        $order->price = Product::findOne(['id' => $order->product_id])->price;

        return $order->save();
    }

}
