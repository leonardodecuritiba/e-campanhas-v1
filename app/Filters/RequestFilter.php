<?php

namespace App\Filters;

use App\Helpers\DataHelper;
use App\Models\HumanResources\Settings\LegalPerson;
use Illuminate\Http\Request;

class RequestFilter
{
	public $entity;

	public function filter(Request $request)
	{
		set_time_limit(60 * 60 * 5);
		$filter = $this->entity;

		if($request->has('search')){
		    if($request->request->has('begin_date')){
			    $filter = $filter->where('created_at',  '>=', DataHelper::setDate($request->request->get('begin_date')) . ' 00:00:00');
            }
		    if($request->request->has('end_date')){
			    $filter = $filter->where('created_at',  '<=', DataHelper::setDate($request->request->get('end_date') ) . ' 23:59:59');
            }

        }
        return $filter;
	}

	public function map(Request $request, $entity, $pagination = false)
	{
		$this->entity = $entity;
		if($request->has('search')){
			$filter = $this->filter($request);
		} else {
			$filter = NULL;
		}

		if($filter != NULL){
            return $filter;
		} else {
			return [];
		}
	}

}
