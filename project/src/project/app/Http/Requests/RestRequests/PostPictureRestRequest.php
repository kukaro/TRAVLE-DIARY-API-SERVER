<?php

namespace App\Http\Requests\RestRequests;

class PostPictureRestRequest extends RestRequest
{
    private ?int $id;
    private ?int $post_id = null;
    private ?int $picture_id;

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

    public function rules()
    {
        return [

        ];
    }
}
