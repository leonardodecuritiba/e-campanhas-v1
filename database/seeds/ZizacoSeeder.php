<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Role;

class ZizacoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = microtime( true );
        $this->command->info( 'Iniciando os Seeders ZizacoSeeder' );
        $this->command->info( 'SETANDO Administrador' );
        $admin               = new Role(); // Gerência = tudo
        $admin->name         = 'admin';
        $admin->display_name = 'ADMIN'; // optional
        $admin->description  = 'Usuário Admin com acesso total ao sistema'; // optional
        $admin->save();

	    echo "\n*** Completo em " . round((microtime(true) - $start), 3) . "s ***";
    }
}
