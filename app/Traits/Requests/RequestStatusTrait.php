<?php

namespace App\Traits\Requests;

use App\Models\Transactions\Settings\RequestStatus;
use Illuminate\Support\Facades\Auth;

trait RequestStatusTrait {

	static $_STATUS_IN_PROGRESS = 1;
	static $_STATUS_WAIT_SEPARATION_ = 2;
	static $_STATUS_IN_SEPARATION_ = 3;
	static $_STATUS_BILLING_ = 4;
	static $_STATUS_BILLED_ = 5;
	static $_STATUS_PENDENT_ = 6;
	static $_STATUS_CANCELED_ = 7;
	static $_STATUS_PAID_ = 8;
    static $_STATUS_WAIT_MANAGER_APPROVE_ = 9;
    static $_STATUS_WAIT_FINANCIAL_APPROVE_ = 10;

	public function isFinished() {
        return (($this->getAttribute('status') == self::$_STATUS_BILLED_) || ($this->getAttribute('status') == self::$_STATUS_CANCELED_));
	}


	public function isPendent() {
        return ($this->getAttribute('status') == self::$_STATUS_PENDENT_);
	}

	public function isFinancialDisapproved() {
        return ($this->getAttribute('disapproved_at') != NULL);
	}

	public function getStatusTextAttribute() {
        return RequestStatus::whereId($this->getAttribute('status'))->description;
	}

	public function getStatusColorAttribute() {
		return $this->getStatusColor($this->getAttribute('status'));
	}

    public function getStatusIconAttribute() {
        switch ($this->getAttribute('status')){
            case self::$_STATUS_IN_PROGRESS:
                return 'ti-reload';
            case self::$_STATUS_WAIT_SEPARATION_:
            case self::$_STATUS_PENDENT_:
            case self::$_STATUS_WAIT_MANAGER_APPROVE_:
            case self::$_STATUS_WAIT_FINANCIAL_APPROVE_:
                return 'ti-timer';
            case self::$_STATUS_IN_SEPARATION_:
                return 'ti-check-box';
            case self::$_STATUS_BILLING_:
                return 'ti-receipt';
            case self::$_STATUS_BILLED_:
                return 'ti-check';
            case self::$_STATUS_PAID_:
                return 'ti-money';
            case self::$_STATUS_CANCELED_:
                return 'ti-na';
        }
    }


    public function getStatusColor($status) {
		switch ($status){
			case self::$_STATUS_IN_PROGRESS:
			case self::$_STATUS_WAIT_SEPARATION_:
            case self::$_STATUS_PENDENT_:
            case self::$_STATUS_WAIT_MANAGER_APPROVE_:
            case self::$_STATUS_WAIT_FINANCIAL_APPROVE_:
                return 'warning';
			case self::$_STATUS_IN_SEPARATION_:
                return 'info';
			case self::$_STATUS_BILLING_:
                return 'primary';
			case self::$_STATUS_BILLED_:
            case self::$_STATUS_PAID_:
                return 'success';
			case self::$_STATUS_CANCELED_:
                return 'danger';
		}
	}


	public function getStatusBtnColor() {
		switch ($this->getAttribute('status')){
            case self::$_STATUS_IN_PROGRESS:
            case self::$_STATUS_WAIT_SEPARATION_:
            case self::$_STATUS_PENDENT_:
                return 'warning';
            case self::$_STATUS_IN_SEPARATION_:
                return 'info';
            case self::$_STATUS_BILLING_:
                return 'primary';
            case self::$_STATUS_BILLED_:
            case self::$_STATUS_PAID_:
                return 'success';
            case self::$_STATUS_CANCELED_:
                return 'danger';
		}
	}


    //============================================================
    //======================== SCOPE =============================
    //============================================================

    public function scopeInProgress($query)
    {
        return $query->where('status', self::$_STATUS_IN_PROGRESS);
    }

    public function scopePendent($query)
    {
        return $query->where('status', self::$_STATUS_PENDENT_);
    }

    public function scopeWaitSeparation($query)
    {
        return $query->where('status', self::$_STATUS_WAIT_SEPARATION_);
    }

    public function scopeWaitManagerApprove($query)
    {
        return $query->where('status', self::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function scopeWaitFinancialApprove($query)
    {
        return $query->where('status', self::$_STATUS_WAIT_FINANCIAL_APPROVE_);
    }

    public function scopeInSeparation($query)
    {
        return $query->where('status', self::$_STATUS_IN_SEPARATION_);
    }

    public function scopeBilling($query)
    {
        return $query->where('status', self::$_STATUS_BILLING_);
    }

    public function scopeBilled($query)
    {
        return $query->where('status', self::$_STATUS_BILLED_);
    }

    public function scopeCanceled($query)
    {
        return $query->where('status', self::$_STATUS_CANCELED_);
    }

    public function scopePaid($query)
    {
        return $query->where('status', self::$_STATUS_PAID_);
    }

    public function scopeMy($query)
    {
        //sem restrição apara ADMIN
        $u = Auth::user();
        if( $u->hasRole('seller')){
            return $query->where('seller_id', $u->id);
        }
//        else if( $u->hasRole('faturist') || $u->hasRole('manager')){
//            return $query->where('seller_id',$u->id)
//                         ->orWhere('faturist_id', $u->id);
//        }
    }




}
