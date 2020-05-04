<?php

namespace Octommerce\API\Transformers;

use Octobro\API\Classes\Transformer;

class OrderStatusLogsTransformer extends Transformer
{
    public function data($statusLogs)
    {
        return [
            'id'          => (int) $statusLogs->id,
            'order_id'    => (int) $statusLogs->order_id,
            'status_code' => $statusLogs->status_code,
            'data'        => $statusLogs->data,
            'timestamp'   => $statusLogs->timestamp,
            'admin_id'    => $statusLogs->admin_id,
            'note'        => $statusLogs->note,
        ];
    }
}
