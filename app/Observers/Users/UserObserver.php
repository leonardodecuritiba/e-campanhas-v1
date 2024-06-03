<?php

namespace App\Observers\Users;

use App\Models\HumanResources\Settings\Contact;
use App\Models\HumanResources\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserObserver {

	protected $request;
	protected $table = 'users';

	public function __construct( Request $request ) {
		$this->request = $request;
	}
	/**
	 * Listen to the Provider created event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function creating( User $user ) {
		$contact          = Contact::create( $this->request->all() );
		$user->contact_id = $contact->id;
        $user->password = Hash::make($this->request->get('password'));
	}


	/**
	 * Listen to the Voter updating event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function saving( User $user ) {
		if ( $user->address != null ) {
			$user->address->update( $this->request->all() );
		}
		//role_id
        $role_id = $this->request->get('role_id');
        if(($user->getAttribute('id') != NULL) && (!is_null($role_id)) && ($user->getRoleId() != $role_id)){
            DB::table('role_user')
                ->where('user_id',$user->id)
                ->update(['role_id' => $role_id]);
        }
	}
	/**
	 * Listen to the Provider deleting event.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function deleting( User $user ) {
		$user->address->delete();
        $user->clients->each(function ($c){
            $c->delete();
        });
	}
}
