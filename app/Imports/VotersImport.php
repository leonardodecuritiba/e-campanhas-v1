<?php

namespace App\Imports;

use App\Helpers\DataHelper;
use App\Models\Commons\CepCities;
use App\Models\HumanResources\Voter;
use App\Models\HumanResources\Settings\Address;
use App\Models\HumanResources\Settings\Contact;
use App\Models\Users\Role;
use App\Models\HumanResources\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class VotersImport implements ToCollection
{
    use Importable;

    public function collection(Collection $rows)
    {
        Voter::flushEventListeners();
        Voter::getEventDispatcher();
        foreach ($rows as $key => $row)
        {
            $user = User::where('name', $row[3])->first();
            if($user == NULL && $row[3] != NULL){
                info('#'.$key.'- PROBLEMA NA USUÁRIO: ' . $row[3]);
            }
            $city = CepCities::where('name', $row[6])->first();
            if($city == NULL && $row[6] != NULL){
                info('#'.$key.'- PROBLEMA NA CIDADE: ' . $row[6]);
            }

            $address = Address::create([
                'state_id'      => optional($city)->state_id,
                'city_id'       => optional($city)->id,
                'zip'           => NULL,
                'district'      => $row[7],
                'street'        => $row[8],
                'number'        => strval($row[9]),
                'region'        => $row[10],
            ]);

            $contact = Contact::create([
                'phone'        => DataHelper::getOnlyNumbers($row[4]),
            ]);


            $doc = DataHelper::getOnlyNumbers($row[11]);
            if(strlen($doc)>11){
                $cpf = NULL;
                $cnpj = $doc;
            } else {
                $cpf = $doc;
                $cnpj = NULL;
            }

            $data = Voter::create([
                'address_id'        => $address->id,
                'contact_id'        => $contact->id,
                'user_id'           => $user->id,

                'name'     => $row[1],
                'surname'      => $row[2],

                'cpf'               => $cpf,
                'cnpj'              => $cnpj,
                'created_at'        => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['12']),
            ]);
        }
    }
}
