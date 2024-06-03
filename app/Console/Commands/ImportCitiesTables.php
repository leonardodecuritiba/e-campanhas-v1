<?php

namespace App\Console\Commands;

use App\Models\Commons\CepCities;
use App\Models\Commons\CepStates;
use App\Models\Parts\Settings\Group;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportCitiesTables extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'import:cities';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
	    $this->info( '* Importing' );
		$start = microtime(true);

		$cont = 0;
        $rows = array();
        foreach(file(storage_path('app/ceps.txt')) as $key => $line) {
//            dd($line)
            $line = str_replace( "\t" ,"[tAbul*Ator]", $line );
            // loop with $line for each line of yourfile.txt
            $data = explode("[tAbul*Ator]",$line);

            $data = explode('/',$data[1]);
            $cidade = $data[0];
            $estado = str_replace("  - Povoado", "", str_replace("  - Distrito", "", $data[1]));

            $city = DB::table('cep_cities')->where('name', $cidade)->first();
            if($city == NULL){
                $state = DB::table('cep_states')->where('short_name', $estado)->first();
                if($state == NULL){
                    $this->warn('#'.$key.' - CIDADE/ESTADO INEXISTENTE: ' . $cidade . '/' . $estado);
                } else {
                    $this->warn('#'.$key.' - CIDADE INEXISTENTE: ' . $cidade );
                    DB::table('cep_cities')->insert([
                        'name'      => $cidade,
                        'state_id'  => $state->id,
                    ]);
                }
                $rows[] = [
                    'name'  => $cidade,
                    'state'  => $estado,
                ];
                $cont++;
            }
        }
//        print_r($rows);
//        DB::table('cep_cities')->insert($rows);

        $this->info('total: '.$cont);
//		$this->info( count($data) );
		$this->alert( 'Import FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
	}
}
