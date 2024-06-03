<?php

namespace App\Observers\HumanResources\Settings;

use App\Models\HumanResources\Settings\Group;
use Illuminate\Http\Request;

class GroupObserver {

	protected $request;
	protected $table = 'groups';

	public function __construct( Request $request ) {
		$this->request = $request;
	}

	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param  Group $group
	 *
	 * @return void
	 */
	public function deleting( Group $group ) {
	}
}
