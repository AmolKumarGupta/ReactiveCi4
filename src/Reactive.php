<?php 
/**
 * Activity logger
 * 
 */

namespace Amol\ReactiveCi4;
/**
 * Entry class of the package
 * 
 * @category guide
 * @author amol kumar gupta
 * @since 0.0.1
 */

class Reactive
{
    /**
     * make acitivity entries in the database 
     * 
     * @param string $text Description of the activity
     * @param object $subject
     * @param object $causer
     * @param array $properties Different properties of the activity
     * @param string $label To group the activities  
     * @return int|false
     * @since 0.0.1
     */

    public function log(object $subject, string $text, object $causer=null,array $properties=[], string $label=null )
    {
        $arr = [
            "label" => $label ?? $this->getDefaultLabel(),
            "activity" => $text,
            "subject" => $subject->id,
            "subject_modal" => $this->getClassName($subject),
            "causer" => $causer->id ?? null,
            "causer_modal" => isset($causer) ? $this->getClassName($causer) : null,
            "properties" => json_encode($properties)
        ];
        
        /* @phpstan-ignore-next-line */
        $activityModel = model('App\Models\Activity') ?? model('Amol\ReactiveCi4\Models\Activity');
        $id = $activityModel->insert($arr);
        if( $id ){
            return $id;
        }
        return false;
    }

    public function getDefaultLabel(): string
    {
        $config = config("Reactive");
        return $config->defaultLabel;
    }

    public function getClassName($obj)
    {
        $name = get_class($obj);
        $ref = new \ReflectionClass($name);
        return $ref->getName();
    }

}
?>