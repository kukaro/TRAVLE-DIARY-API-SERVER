<?php

namespace App\Http\Requests\RestRequests;

class UserRestRequest extends RestRequest
{
    private ?int $id = null;
    private ?string $email = null;
    private ?string $name = null;
    private ?int $age = null;
    private ?string $birth_date = null;
    private ?bool $is_hiworks = false;
    private ?string $password = "0";
    private ?string $created_date = null;
    private ?string $updated_date = null;

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

    public function rules()
    {
        switch ($this->req_method) {
            case "POST":
                if($this->req_path=="api/login"){
                    return [
                        "email" => "required|email|max:255",
                        "password" => "required|string|min:1|max:255",
                    ];
                }else{
                    return [
                        "email" => "required|email|max:255|unique:user",
                        "name" => "required|string|max:255",
                        "password" => "required|string|min:1|max:255|confirmed",
                    ];
                }
            default:
                return [

                ];
        }
    }

    public function messages()
    {
        return [
            "email.required" => "required",
            "name.required" => "required",
            "password.required" => "required",
        ];
    }
}
