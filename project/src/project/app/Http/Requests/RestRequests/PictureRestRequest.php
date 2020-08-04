<?php

namespace App\Http\Requests\RestRequests;

class PictureRestRequest extends RestRequest
{
    private $id;
    private $owner_id;
    private $location;
    private $path;
    private $created_date;
    private $updated_date;

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

    public function __get($name)
    {
        return $this->$name;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
