<?php

namespace App\Http\Dto;

class HiworksAuthDto extends DtoImpl
{

    /**
     * Class constructor.
     */
    public function __construct()
    {
        
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
