<?php

namespace App\Filters;

use App\Helpers\DataHelper;
use App\Models\HumanResources\Settings\LegalPerson;
use Illuminate\Http\Request;

class VoterFilter
{
	public $entity;

	public function filter(Request $request)
	{
		set_time_limit(60 * 60 * 5);
		$filter = $this->entity;

		if($request->has('search_id') && $request->has('client_id') && ($request->get('client_id') != '')){
			$request->request->remove('description');
			$filter = $filter->where('id', $request->get('client_id'));
		} else {
			$request->request->remove('client_id');
			$search = $request->get('description');

			if ($search != '') {
				//$filter
				$numbers = DataHelper::getOnlyNumbers($search);
				if ($numbers != '' && strlen($numbers) > 5) {
                    $filter = $filter->my()
                                     ->where(function($query) use ($search, $numbers){
                                         $query->where('name', 'like', '%' . $search . '%')
                                               ->orWhere('surname', 'like', '%' . $search . '%')
                                               ->orWhere('cnpj', 'like', '%' . $numbers . '%');
                                     });
				} else {
                    $filter = $filter->my()
                                     ->where(function($query) use ($search){
                                         $query->where('name', 'like', '%' . $search . '%')
                                               ->orWhere('surname', 'like', '%' . $search . '%');
                                     });

                }
			}
		}
		return $filter;
	}

	public function map(Request $request, $entity, $pagination = false)
	{
		$this->entity = $entity;
		if($request->has('search') || $request->has('search_id')){
			$filter = $this->filter($request);

			if(!is_a($filter, 'Illuminate\Database\Eloquent\Collection')) {
				$filter = $filter->get()->map( function ( $s ) {
					return [
						'id'                    => $s->id,
						'fantasy_name_text'     => $s->surname,
						'social_reason_text'    => $s->name,
						'short_document'        => $s->short_document,
						'content'               => $s->short_description,
						'name'                  => $s->surname,
                        'email_contact'         => $s->contact->email_contact,
						'phone'                 => $s->contact->phone_formatted,
						'created_at'            => $s->created_at_formatted,
						'created_at_time'       => $s->created_at_time,
					];
				} );
			};
		} else {
			$filter = NULL;
		}

		if($filter != NULL){
			if($pagination){
				return [
					'filter'=>$filter,
					'items' =>$filter->getCollection()->transform(function($s){
						return $s;
					})
				];
			}
			return $filter->map(function($s){
				return $s;
			});
		} else {
			return [];
		}
	}

}
