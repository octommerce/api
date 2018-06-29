<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octobro\OAuth2\Transformers\UserTransformer;
use Octommerce\Octommerce\Models\Order;

class OrderTransformer extends Transformer
{
    public $defaultIncludes = [
        'invoice',
    ];

    public $availableIncludes = [
        'invoice',
        'products',
        'user',
    ];

    public function data(Order $order)
    {
        return [
            'id'                => (int) $order->id,
            'user_id'           => (int) $order->user_id,
            'order_no'          => $order->order_no,
            'name'              => $order->name,
            'email'             => $order->email,
            'phone'             => $order->phone,
            'message'           => $order->message,
            'subtotal'          => (float) $order->subtotal,
            'discount'          => (float) $order->discount,
            'tax'               => (float) $order->tax,
            'misc_fee'          => (float) $order->misc_fee,
            'total'             => (float) $order->total,
            'is_same_address'   => (Boolean) $order->is_same_address,
            'shipping_name'     => $order->shipping_name,
            'shipping_phone'    => $order->shipping_phone,
            'shipping_company'  => $order->shipping_company,
            'shipping_address'  => $order->shipping_address,
            'shipping_postcode' => $order->shipping_postcode,
            'status_code'       => $order->status_code,
            'status'            => [
                'name'        => $order->status->name,
                'color'       => $order->status->color,
                'description' => $order->status->description,
            ],
            'status_updated_at' => date($order->status_updated_at),
            'created_at'        => date($order->created_at),
        ];
    }

    public function includeUser(Order $order)
    {
        return $this->item($order->user, new UserTransformer);
    }

    public function includeInvoice(Order $order)
    {
        return $this->item($order->invoice, new InvoiceTransformer);
    }

    public function includeProducts(Order $order)
    {
        return $this->collection($order->products, new OrderProductTransformer);
    }

}
