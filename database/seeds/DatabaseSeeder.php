<?php

use Illuminate\Database\Seeder;
use App\Companies\Company;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(ImportCepTable::class);
	    $this->call(ZizacoSeeder::class);
//        Artisan::call('import:users');
//        Artisan::call('import:voters');

        $user = new \App\Models\HumanResources\User([
            'name'          => 'Leonardo ROOT',
            'email'         => 'silva.zanin@gmail.com',
        ]);
        $user->password = '123';
        $user->save();
        $user->attachRole(1);

        $user = new \App\Models\HumanResources\User([
            'name'          => 'Fabricio ROOT',
            'email'         => 'guiafaxil@gmail.com',
        ]);
        $user->password = '123';
        $user->save();
        $user->attachRole(1);

    }
}
