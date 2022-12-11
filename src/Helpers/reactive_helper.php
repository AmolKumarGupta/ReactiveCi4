<?php

if( !function_exists("reactive") ){
    function reactive(object $subject, string $text, object $causer=null,array $properties=[], string $label=null ){
        $instance = new \Amol\ReactiveCi4\Reactive();
        return $instance->log($subject, $text, $causer, $properties, $label);
    }
}

?>