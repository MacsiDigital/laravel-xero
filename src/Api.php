<?php

namespace MacsiDigital\Xero;

use Illuminate\Support\Str;

class Api
{

    public function getApi($name)
    {
        $class = 'MacsiDigital\Xero\\'.Str::studly($name).'\Api';
        return new $class;
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public function __call($method, $parameters)
    {
        if(method_exists($this, $method)){
            return $this->$method(...$parameters);
        } else {
            try {
                return $this->$method;
            } catch(\Exception $e){
                throw new BadMethodCallException(sprintf(
                    'Call to undefined method %s::%s()', static::class, $method
                ));
            }
        }
    }

    public function __get($key)
    {
        return $this->getApi($key);
    }

}
