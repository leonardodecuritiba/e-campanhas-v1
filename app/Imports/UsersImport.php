<?php

namespace App\Imports;

use App\Helpers\DataHelper;
use App\Models\HumanResources\Settings\Contact;
use App\Models\Users\Role;
use App\Models\HumanResources\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    use Importable;

    public function collection(Collection $rows)
    {
        User::flushEventListeners();
        User::getEventDispatcher();
        foreach ($rows as $row)
        {
            $role = Role::where('display_name', $row[1])->first();
            $contact = Contact::create([
                'phone'    => DataHelper::getOnlyNumbers($row[2])
            ]);

            $user = new User([
                'contact_id'    => $contact->id,
                'name'          => $row[0],
                'email'         => $row[3],
                'commission'    => $row[4],
            ]);

            $user->password = Hash::make('123');
            $user->save();

            $user->attachRole($role);
        }
    }
}
