<?php

namespace App\Console\Commands;

use App\Imports\UsersImport;
use App\Models\Parts\Settings\Group;
use Illuminate\Console\Command;

class ImportUsersTables extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'import:users';

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

		$filename = 'USUARIOS.xls';

		$this->info( "*** Iniciando o Upload (" . $filename . ") ***");
		$file = storage_path('imports' . DIRECTORY_SEPARATOR . $filename);
		set_time_limit(3600);

        (new UsersImport)->import($filename);

		$this->alert( 'Import FINISHED in ' . round((microtime(true) - $start), 3) . "s ***");
	}
}
