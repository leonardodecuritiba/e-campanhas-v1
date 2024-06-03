<?php

namespace App\Traits\Relashionships;

use App\Models\HumanResources\User;

trait UserTrait {


	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}


}
