<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Octommerce\Octommerce\Models\Order;

class OrderTransformer extends Transformer
{
    public $defaultIncludes = [
        'invoice',
    ];

    public $availableIncludes = [
        'invoice',
        'products',
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

    public function includeInvoice(Order $order)
    {
        return $this->item($order->invoice, new InvoiceTransformer);
    }

    public function includeProducts(Order $order)
    {
        return $this->collection($order->products, new OrderProductTransformer);
    }

}
