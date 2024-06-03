<?php

namespace App\Models\HumanResources;

use App\Companies\Company;
use App\Models\Commons\Picture;
use App\Models\HumanResources\Settings\Contact;
use App\Models\Inputs\Settings\Label;
use App\Models\Inputs\Settings\Seal;
use App\Models\Transactions\Order;
use App\Models\Transactions\Request;
use App\Traits\ActiveTrait;
use App\Traits\AddressTrait;
use App\Traits\DateTimeTrait;
use App\Traits\NotificationTrait;
use App\Traits\UserCollaboratorTrait;
use App\Traits\UserTechnicianTrait;
use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; // add this trait to your user model
    use DateTimeTrait;
    use UserTrait;
    use AddressTrait;
	use ActiveTrait;
	use NotificationTrait;
    use Notifiable;
    use EntrustUserTrait {
        restore as private restoreA;
    } // add this trait to your user model

    use SoftDeletes {
        restore as private restoreB;
    }

    public function restore() {
        $this->restoreA();
        $this->restoreB();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id',

        'name',
        'email',
        'commission',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $appends = [
        'type_formatted',
        'created_at_time',
        'created_at_formatted',
    ];


	//============================================================
	//======================== FUNCTIONS =========================
	//============================================================

	static public function getAlltoSelectList() {
		return self::get()->map( function ( $s ) {
			return [
				'id'          => $s->id,
				'description' => $s->getName()
			];
		} )->pluck( 'description', 'id' );
	}

    public function updatePassword( $password ) {
        $this->password = bcrypt( $password );
        return $this->save();

        return $this->update( [
            'password' => bcrypt( $password )
        ] );
    }

    public function is( $name = null ) {
        $role = $this->roles->first();
        return ( $name == null ) ? $role : ( $role->name == $name );
    }

    public function getTypeFormattedAttribute() {
        return $this->roles->first()->display_name;
    }

    public function getRoleName() {
        return $this->roles->first()->name;
    }

    public function getRoleId() {
        return $this->roles->first()->id;
    }

    public function itsMe($id) {
        return ($this->id == $id);
    }


	//============================================================
	//======================== RELASHIONSHIP =====================
	//============================================================

    /*
    public function orders() {
        $role = $this->getRoleName();
        switch($role){
            case 'root':
                return Order::query();
//            case 'base':
//                return Collect::allBase($this->base()->id);
//            case 'client':
//                return $this->client()->collects;
        }
    }

    */


    //======================== BELONGS ===========================
    //============================================================

	public function contact()
	{
		return $this->belongsTo(Contact::class, 'contact_id');
	}

    //======================== HASONE ============================
    //============================================================

    //======================== HASMANY ===========================
    //============================================================
    public function clients()
    {
        return $this->hasMany(Voter::class, 'user_id');
    }

    public function seller_requests()
    {
        return $this->belongsTo(Request::class, 'seller_id');
    }

    public function faturist_requests()
    {
        return $this->belongsTo(Request::class, 'faturist_id');
    }


}
