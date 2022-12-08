<?php
/** 
 * Basic command for setup reactive ci4, an activity logger.
 */

namespace Amol\ReactiveCi4\Commands\Reactive;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Commands\Database\Migrate;
use Config\Services;

/**
 * Setup class is a command class.
 * 
 * @author amol
 * @category command
 */

class Setup extends BaseCommand
{
    protected $group = "Reactive";
    protected $name = "reactive:setup";
    protected $description = "Initial setup for reactive, activity logger";
    protected $arguments = [
        "migration file" => "CreateMigrationFile"
    ];
    protected $options = [];

    protected $sourcePath;
    protected $distPath = APPPATH;

    public function run(array $params): void
    {
        $this->sourcePath = __DIR__ ."/../";
        // $config = config("Reactive");
        CLI::write(" setup is running");
        CLI::write( APPPATH );
    }

}