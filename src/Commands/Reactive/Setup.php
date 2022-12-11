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
    protected $arguments = [];
    protected $options = [];

    protected $src;
    protected $dist = APPPATH;

    public function run(array $params): void
    {
        $this->src = __DIR__ ."/../../";

        $this->makeConfig();

        $this->makeModel();

        $this->migrate();
    }

    private function makeConfig(): void
    {
        $file     = 'Config/Reactive.php';
        $replaces = [
            'namespace Amol\ReactiveCi4\Config'  => 'namespace Config'
        ];

        $this->copy($file, $replaces);
    }

    private function makeModel(): void
    {
        $file     = 'Models/Activity.php';

        $replaces = [
            'namespace Amol\ReactiveCi4\Models'  => 'namespace App\Models'
        ];

        $this->copy($file, $replaces);
    }

    protected function copy(string $file, array $replaces): void
    {
        $path = "{$this->src}/{$file}";

        $data = file_get_contents($path);

        $data = $this->replace($data, $replaces);

        $this->writeFile($file, $data);
    }

    public function replace(string $content, array $replaces): string
    {
        return strtr($content, $replaces);
    }

    protected function writeFile(string $file, string $content): void
    {
        $path      = $this->dist . $file;
        $cleanPath = clean_path($path);

        $directory = dirname($path);

        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($path)) {
            $overwrite = (bool) CLI::getOption('f');

            if (
                ! $overwrite
                && CLI::prompt("  File '{$cleanPath}' already exists in destination. Overwrite?", ['n', 'y']) === 'n'
            ) {
                CLI::error("  Skipped {$cleanPath}.");

                return;
            }
        }

        if (write_file($path, $content)) {
            CLI::write(CLI::color('  Created: ', 'green') . $cleanPath);
        } else {
            CLI::error("  Error creating {$cleanPath}.");
        }
    }

    private function migrate(): void
    {
        $answer = CLI::prompt('  Run `spark migrate --all` now?', ['y', 'n']);
        if ($answer === 'n') {
            return;
        }

        $command = new Migrate(Services::logger(), Services::commands());
        $command->run(['all' => null]);
    }

}