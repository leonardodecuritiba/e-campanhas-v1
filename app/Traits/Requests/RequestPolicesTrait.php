<?php

namespace App\Traits\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait RequestPolicesTrait {



    //============================================================
    //======================== BTN ===============================
    //============================================================

    public function canShowNewRequestBtn()
    {
        return Auth::user()->hasRole(['admin', 'seller', 'manager']);
    }

    public function canShowEditRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u && (
            $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
            $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_
            )
        );
    }

    public function canShowAddProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u && (
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_
            ));
    }

    public function canShowRemoveProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u && (
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_
            ));
    }

    public function canShowEditProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u && (
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_
            ));
    }

    public function canShowCloseRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u &&
                $this->checkFields() &&
                (
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS
                )
        );
    }

    public function canShowCancelRequestBtn()
    {
        $u = Auth::user();
        return ($u->hasRole(['admin', 'seller', 'manager']) &&
                (
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_PROGRESS ||
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_
                )) ||
               ($u->hasRole(['admin', 'faturist', 'manager']) &&
                (
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_SEPARATION_ ||
                    $this->getAttribute('status') == RequestStatusTrait::$_STATUS_BILLING_
                )
               );
    }

    public function canShowSeparateRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_SEPARATION_);
    }

    public function canShowConfirmProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_SEPARATION_);
    }

    public function canShowDenyProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_SEPARATION_);
    }

    public function canShowConfirmSeparationBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_SEPARATION_);
    }

    public function canShowGeneratePendencyBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_IN_SEPARATION_);
    }

    public function canShowConfirmBillingBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'faturist', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_BILLING_);
    }

    public function canShowResendRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'seller', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_PENDENT_);
    }


    public function canShowPayBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'financial']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_BILLED_);
    }


    //============================================================
    //================== MANAGER APPROVE =========================
    //============================================================

    public function canShowApproveRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function canShowApproveProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function canShowDisapproveRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function canShowDisapproveProductBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function canShowFinancialApproveRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'financial']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_);
    }

    public function canShowFinancialDisapproveRequestBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'financial']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_);
    }

    public function canShowDisapproveBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    public function canShowApproveBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_);
    }

    //============================================================
    //================== FINANCIAL APPROVE =======================
    //============================================================

    public function canShowDisapproveFinancialBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'financial']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_);
    }

    public function canShowApproveFinancialBtn()
    {
        $u = Auth::user()->hasRole(['admin', 'financial']);
        return ($u && $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_);
    }

    //============================================================
    //======================== INFORMATIONS ======================
    //============================================================

    public function canShowProductsRange()
    {
        $u = Auth::user()->hasRole(['admin', 'financial','manager']);
        return ($u &&
            (
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_ ||
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_ ||
                $this->getAttribute('status') == RequestStatusTrait::$_STATUS_BILLED_
            ));
    }

    public function canShowManager()
    {
        $u = Auth::user()->hasRole(['admin', 'manager']);
        return ($u &&
            (
                $this->getAttribute('status') != RequestStatusTrait::$_STATUS_IN_PROGRESS
            ));
    }

    //============================================================
    //======================== ACTIONS ===========================
    //============================================================

    public function canConfirm()
    {
        $request_id = $this->getAttribute('id');
        return DB::table('items')
                    ->where(function ($query) use ($request_id) {
                        $query->where('request_id', $request_id) //produtos sem alteração
                              ->whereNull('deleted_at')
                              ->whereNull('confirmed_at')
                              ->whereNull('denied_at');
//                              ->whereNull('pendency');
                    })->orWhere(function ($query) use ($request_id) {
                        $query->where('request_id', $request_id) //produtos negados
                              ->whereNull('deleted_at')
                              ->whereNull('confirmed_at')
                              ->whereNotNull('denied_at');
//                              ->whereNotNull('pendency');
                    })->count() > 0;
        return $this;
    }

    public function canGeneratePendency()
    {
        return (DB::table('items')
                   ->where('request_id', $this->getAttribute('id')) //produtos sem alteração
                   ->whereNull('deleted_at')
                   ->whereNull('confirmed_at')
                   ->whereNull('denied_at')
//                   ->whereNull('pendency')
                   ->count() > 0);
        return $this;
    }


    public function canApprove()
    {
        return (DB::table('items') //não deve haver nenhum produto DESAPROVADO
                  ->where('request_id', $this->getAttribute('id'))
                  ->whereNull('deleted_at')
                  ->whereNotNull('disapproved_at')
                  ->count() == 0);
    }


    public function canDisapprove()
    {
        return (DB::table('items')
                  ->where('request_id', $this->getAttribute('id'))//deve haver pelo menos 1 produto DESAPROVADO
                  ->whereNull('deleted_at')
                  ->whereNotNull('disapproved_at')
//                   ->whereNull('pendency')
                  ->count() > 0);
    }


    public function canApproveFinancial()
    {
        return $this->canShowApproveFinancialBtn();
    }


    public function canDisapproveFinancial()
    {
        return $this->canShowDisapproveFinancialBtn();
    }

    /*
	public function canChangeFlow($status) {

		//$_STATUS_NEW_TRANSFER_
		switch($this->getAttribute('status_id')){
			case CollectStatus::$_STATUS_PRE_REGISTERED_:
			case CollectStatus::$_STATUS_PRE_COLLECT_:
				return ($status == CollectStatus::$_STATUS_PENDENT_);
			case CollectStatus::$_STATUS_PENDENT_:
				return ($status == CollectStatus::$_STATUS_COLLECTED_ || $status == CollectStatus::$_STATUS_CLIENT_EVENT_);
			case CollectStatus::$_STATUS_CLIENT_EVENT_:
				return ($status == CollectStatus::$_STATUS_PENDENT_ || $status == CollectStatus::$_STATUS_CANCELED_);
			case CollectStatus::$_STATUS_COLLECTED_:
				return ($status == CollectStatus::$_STATUS_INTRANSFER_ );
			case CollectStatus::$_STATUS_INTRANSFER_:
				return ($status == CollectStatus::$_STATUS_WAIT_DEVOLUTION_ || $status == CollectStatus::$_STATUS_TRANSPORTER_EVENT_ || $status == CollectStatus::$_STATUS_NEW_TRANSFER_);
			case CollectStatus::$_STATUS_NEW_TRANSFER_:
				return ($status == CollectStatus::$_STATUS_WAIT_DEVOLUTION_);
			case CollectStatus::$_STATUS_TRANSPORTER_EVENT_:
				return ($status == CollectStatus::$_STATUS_WAIT_DEVOLUTION_ || $status == CollectStatus::$_STATUS_LOSSED_ || $status == CollectStatus::$_STATUS_NEW_TRANSFER_);
			case CollectStatus::$_STATUS_WAIT_DEVOLUTION_:
				return ($status == CollectStatus::$_STATUS_DELIVERED_);
		}
	}
	*/



}
