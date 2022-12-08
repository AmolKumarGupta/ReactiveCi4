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
     * @param string $text description of the activity
     * @param object $subject
     * @param object $causer
     * @param array $properties 
     * @return boolean
     * @since 0.0.1
     */

    public function log(string $text, object $subject, object $causer, $properties=[] )
    {
        $arr = [
            "activity" => $text,
            "subject" => $subject->id,
            "subject_modal" => $this->getClassName($subject),
            "causer" => $causer->id,
            "causer_modal" => $this->getClassName($causer),
            "properties" => json_encode($properties)
        ];

        dd($arr);
        return true;
    }

    public function getClassName($obj)
    {
        $name = get_class($obj);
        $ref = new \ReflectionClass($name);
        return $ref->getName();
    }

}
?>