<?php namespace Octommerce\API;

use System\Classes\PluginBase;
use RainLab\User\Models\User;
use Octobro\OAuth2\Transformers\UserTransformer;
use Octommerce\API\Transformers\OrderTransformer;

class Plugin extends PluginBase
{
	public $require = ['Octobro.API', 'Octobro.OAuth2', 'Octommerce.Octommerce'];

    public function boot()
    {
    	UserTransformer::extend(function($transformer) {

			$transformer->addField('phone');

            $transformer->addInclude('orders', function(User $user) use ($transformer) {
                return $transformer->collection($user->orders, new OrderTransformer);
            });

            $transformer->addField('orders_count', function(User $user) {
            	return $user->orders()->count();
            });

    	});

    }
}
