<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Commons\CepCities;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class AjaxController extends Controller {
	/**
	 * gET the specified resource from storage.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getStateCityToSelect() {
		$state_id = Input::get( 'id' );
		return ( $state_id == null ) ? $state_id : CepCities::where( 'state_id', $state_id )->get();
	}

	/**
	 * Active the specified resource from storage.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function setActive() {

		$model  = Input::get( 'model' );
		$id     = Input::get( 'id' );
		$Entity = $model::findOrFail( $id );

		return new JsonResponse( [
			'status'  => 1,
			'message' => $Entity->updateActive()
		], 200 );
	}

    public function getAjaxDataByID() {
        $id      = Input::get('id');
        $table   = Input::get('table');
        $retorno = explode(',',Input::get('retorno'));

        $response = DB::table($table)
                      ->where('id', $id)
                      ->get($retorno);

        return response()->json([ 'status' => '1',
                                  'response' => $response
        ]);
    }


    public function ajaxSelect2() {
        $id     = Input::get('id');
        $fk     = Input::get('fk');
        $field  = Input::get('field'); //status key
        $value  = Input::get('value'); //status key
        $table  = Input::get('table');
        $action = Input::get('action');
        if($value==NULL) return;
        $busca = NULL;
        switch($action){
            case 'get_by_id':
                $busca = DB::table($table)
                           ->where('id', $id)
                           ->get();
                break;
            case 'get_by_field':
                $busca = DB::table($table)
                           ->where($field,'like' , $value."%")
                           ->get();
                break;
            case 'busca_por_fk_campo':
                $busca = DB::table($table)
                           ->where($fk, $id)
                           ->where($field,'like' , $value . "%")
                           ->get();
                break;
        }
        $data = NULL;
        if( count($busca) > 0){
            foreach($busca as $i => $dt){
                $data[] = array( 'id' => $dt->id, 'text' => $dt->$field, 'data' => $dt);
            }
        }
        echo json_encode($data);
    }
}
