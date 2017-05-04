<?php namespace Octommerce\API;

use System\Classes\PluginBase;
use RainLab\User\Models\User;
use Octobro\API\Transformers\UserTransformer;
use Octommerce\API\Transformers\OrderTransformer;

class Plugin extends PluginBase
{
	public $require = ['Octobro.API'];

    public function boot()
    {
    	UserTransformer::extend(function($transformer) {

    		$transformer->availableIncludes[] = 'orders';

    		$transformer->addDynamicMethod('includeOrders', function(User $user) use ($transformer) {
    			return $transformer->collection($user->orders, new OrderTransformer);
    		});

    	});

    }
}
