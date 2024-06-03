<?php

namespace App\Traits\Requests;


use App\Models\HumanResources\User;
use App\Notifications\PendentRequestNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait RequestFlowTrait {

	public function close()
    {
        //verify if price was changed
        foreach($this->items as $i){
            if($i->isPriceChanged()){
                $this->update(['status'=> RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_]);
                return $this;
            }
        }

        return $this->approve();

	}

	public function separate($faturist_id)
    {
		$this->update([
		    'status'        => RequestStatusTrait::$_STATUS_IN_SEPARATION_,
            'faturist_id'   => $faturist_id,
            'alert_pendency'=> 0
        ]);
		return $this;
	}

	public function generatePendency($faturist_id)
    {
        if(!$this->getAttribute('alert_pendency'))
        {
            $this->seller->notify(new PendentRequestNotification($this));
            Log::info('Envio de email em ' . Carbon::now()->toDateTimeString() . ' - (' . $this->getAttribute('id') . '): ' . json_encode($this));
        }

        $this->update([
            'status'        => RequestStatusTrait::$_STATUS_PENDENT_,
            'faturist_id'   => $faturist_id,
            'alert_pendency'=> 1,
        ]);

		return $this;
	}

	public function confirmSeparation($faturist_id)
    {
		$this->update([
		    'status'        => RequestStatusTrait::$_STATUS_BILLING_,
            'faturist_id'   => $faturist_id,
        ]);
		return $this;
	}

	public function confirmBilling($attributes)
    {
        $data['status'] = RequestStatusTrait::$_STATUS_BILLED_;
        $data['freight_client'] = NULL;
        $data['freight_store'] = NULL;
        if(!$this->isFreightEmpty()){
            if($this->isFreightPartial() || $this->isFreightClient()) {
                $data['freight_client'] = $attributes['freight_client'];
            }
            if($this->isFreightPartial() || $this->isFreightStore()) {
                $data['freight_store'] = $attributes['freight_store'];
            }
        }
		$this->update($data);
		return $this;
	}

	public function cancel()
    {
		$this->update(['status'=> RequestStatusTrait::$_STATUS_CANCELED_]);
		return $this;
	}

	public function resend()
    {
		$this->update([
		    'status'            => RequestStatusTrait::$_STATUS_WAIT_MANAGER_APPROVE_,
		    'disapproved_at'    => NULL,
		    'approved_at'       => NULL
        ]);
		return $this;
	}

	public function setPaid($paid_at)
    {
		$this->update([
		    'paid_at'   => $paid_at,
		    'status'    => RequestStatusTrait::$_STATUS_PAID_
        ]);
		return $this;
	}

    //============================================================
    //================== MANAGER APPROVE =========================
    //============================================================

    public function approve()
    {
        $this->update([
            'status'=> RequestStatusTrait::$_STATUS_WAIT_FINANCIAL_APPROVE_,
            'approver_id'=> Auth::id(),
        ]);
        return $this;
    }

    public function disapprove()
    {
        $this->update([
            'status' => RequestStatusTrait::$_STATUS_PENDENT_,
            'approver_id'=> Auth::id()
        ]);
        return $this;
    }

    //============================================================
    //================== FINANCIAL APPROVE =======================
    //============================================================

    public function approveFinancial()
    {
        $this->update([
            'status'        => RequestStatusTrait::$_STATUS_WAIT_SEPARATION_,
            'approved_at'   => Carbon::now()->toDateTimeString()
        ]);
        return $this;
    }

    public function disapproveFinancial()
    {
        $this->update([
            'status'            => RequestStatusTrait::$_STATUS_PENDENT_,
            'disapproved_at'    => Carbon::now()->toDateTimeString()
        ]);
        return $this;
    }

}
