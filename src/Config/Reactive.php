<?php
#namespace App\Config;
namespace Amol\ReactiveCi4\Config;

use CodeIgniter\Config\BaseConfig;

class Reactive extends BaseConfig
{
    public $name = "reactive";

    /**
     * A Pre-defined label for database table to categorizes the activities
     * in different groups.
     * 
     * @var string $defaultLabel
     */
    public $defaultLabel = "default";

}
?>