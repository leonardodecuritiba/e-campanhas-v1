<?php

namespace App\Http\Controllers\Ajax\HumanResources;


use App\Helpers\DataHelper;
use App\Http\Controllers\Controller;
use App\Models\HumanResources\Voter;
use Illuminate\Support\Facades\Input;

class VoterController extends Controller
{

    public function toSelect2() {
        $search  = Input::get('value');
        if (($search != '')  && ($search!=NULL)){
            //$filter
            $filter = new Voter();
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
            $busca = $filter->get();
            if( count($busca) > 0){
                $data = NULL;
                foreach($busca as $i => $dt){
                    $data[] = array(
                        'id'                => $dt->id,
                        'text'              => $dt->short_description . ' / ' . $dt->short_document,
                    );
                }
                echo json_encode($data);
            }
        }

        return NULL;
    }


}
