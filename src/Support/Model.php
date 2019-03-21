<?php 
namespace MacsiDigital\Xero\Support;

abstract class Model
{
    
    protected $attributes = [];

    const ENDPOINT = '';
    const NODE_NAME = '';

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the resource uri of the class (Contacts) etc
     *
     * @return string
     */
    public static function getEndpoint()
    {
        return static::ENDPOINT;
    }

    /**
     * Get the root node name.  Just the unqualified classname
     *
     * @return string
     */
    public static function getRootNodeName()
    {
        return static::NODE_NAME;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (! $key) {
            return;
        }

        // If the attribute exists in the attribute array or has a "get" mutator we will
        // get the attribute's value. Otherwise, we will proceed as if the developers
        // are asking for a relationship's value. This covers both types of values.
        if ($this->attributeExists($key)) {
            return $this->getAttributeValue($key);
        }

    }

    /**
     * Get a plain attribute (not a relationship).
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeValue($key)
    {
        return $this->getAttributeFromArray($key);
    }

    /**
     * Get an attribute from the $attributes array.
     *
     * @param  string  $key
     * @return mixed
     */
    protected function getAttributeFromArray($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if($this->attributeExists($key)){
            $this->attributes[$key] = $value;    
        }
        return $this;
    }

    public function attributeExists($key) 
    {
        return array_key_exists($key, $this->attributes);
    }

    public function unsetAttribute($key) 
    {
        $this->setAttribute($key, '');
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute or relation exists on the model.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->attributeExists($key);
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        $this->unsetAttribuet($key);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['increment', 'decrement'])) {
            return $this->$method(...$parameters);
        }

        return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public static function make($attributes) 
    {
        $model = new static;
        foreach($attributes as $attribute => $value){
            $model->$attribute = $value;
        }
        return $model;
    }

    public function fill($attributes) 
    {
        foreach($attributes as $attribute => $value){
            $this->$attribute = $value;
        }
        return $this;
    }

    public static function create($attributes) 
    {
        $this->make($attributes)->save();
    }

    public function update($attributes) 
    {
        $this->fill($attributes)->save();
        return $this;
    }

    public function save()
    {

    }

    public function where()
    {

    }

    public function all()
    {
        $response = $this->client->get($this->getEndpoint());
        dd($response);
    }

}