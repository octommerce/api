<?php namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;
use Responsiv\Pay\Models\Invoice;

class InvoiceTransformer extends Transformer
{
    public $defaultIncludes = [];

    public $availableIncludes = [];

    public function data(Invoice $invoice)
    {
        return [
            'id'                => (int) $invoice->id,
            'user_id'           => (int) $invoice->user_id,
            'subtotal'          => (float) $invoice->subtotal,
            'discount'          => (float) $invoice->discount,
            'tax'               => (float) $invoice->tax,
            'total'             => (float) $invoice->total,
            'hash'              => $invoice->hash,
            'status_code'       => $invoice->status_code,
            'status_updated_at' => $invoice->status_updated_at,
            'created_at'        => date($invoice->created_at),
        ];
    }

}
