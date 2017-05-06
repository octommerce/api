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

            $transformer->addInclude('orders', function(User $user) use ($transformer) {
                return $transformer->collection($user->orders, new OrderTransformer);
            });

            $transformer->addField('orders_count', function(User $user) {
            	return $user->orders()->count();
            });

    	});

    }
}
