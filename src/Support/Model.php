<?php

namespace MacsiDigital\Xero\Support;

use Exception;
use Illuminate\Support\Collection;

abstract class Model
{
    protected $attributes = [];
    protected $relationships = [];
    protected $query_string = '';
    protected $methods = [];

    public $response;

    const ENDPOINT = '';
    const NODE_NAME = '';
    const KEY_FIELD = '';

    protected $client;

    public function __construct()
    {
        $this->client = app()->xero->client;
    }

    /**
     * Get the resource uri of the class (Contacts) etc.
     *
     * @return string
     */
    public static function getEndpoint()
    {
        return static::ENDPOINT;
    }

    /**
     * Get the root node name.  Just the unqualified classname.
     *
     * @return string
     */
    public static function getRootNodeName()
    {
        return static::NODE_NAME;
    }

    /**
     * Get the unique key field.
     *
     * @return string
     */
    public static function getKey()
    {
        return static::KEY_FIELD;
    }

    /**
     * Get the object unique ID.
     *
     * @return string
     */
    public function getID()
    {
        $index = $this->getKey();

        return $this->$index;
    }

    public function hasID()
    {
        $index = $this->getKey();
        if ($this->$index != '') {
            return true;
        }

        return false;
    }

    public function getAttributes()
    {
        return $this->attributes;
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
        if ($this->attributeExists($key)) {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    public function processRelationships()
    {
        foreach ($this->relationships as $key => $class) {
            if (is_array($this->$key) && in_array($this->getKey(), $this->$key)) {
                if (! is_object($this->$key)) {
                    $this->attributes[$key] = ($class)::make($this->$key);
                }
            } else {
                foreach ($this->$key as $index => $item) {
                    if (! is_object($item)) {
                        $this->attributes[$key][$index] = ($class)::make($item);
                    }
                }
            }
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
        $this->unsetAttribute($key);
    }

    public static function make($attributes)
    {
        $model = new static;
        foreach ($attributes as $attribute => $value) {
            $model->$attribute = $value;
        }

        return $model;
    }

    public static function create($attributes)
    {
        $model = static::make($attributes);
        $model->save();

        return $model;
    }

    public function fill($attributes)
    {
        foreach ($attributes as $attribute => $value) {
            $this->$attribute = $value;
        }

        return $this;
    }

    public function update($attributes)
    {
        $this->fill($attributes)->save();

        return $this;
    }

    public function save()
    {
        if ($this->hasID()) {
            if (in_array('put', $this->methods)) {
                $this->response = $this->client->post($this->getEndpoint().'/'.$this->getID(), $this->attributes);
                if ($this->response->getStatusCode() == '200') {
                    return $this->response->getContents();
                } else {
                    throw new Exception('Status Code '.$this->response->getStatusCode());
                }
            }
        } else {
            if (in_array('post', $this->methods)) {
                $this->response = $this->client->post($this->getEndpoint(), $this->attributes);
                if ($this->response->getStatusCode() == '200') {
                    $saved_item = $this->collect($this->response->getContents())->first();
                    $index = $this->GetKey();
                    $this->$index = $saved_item->$index;

                    return $this->response->getContents();
                } else {
                    throw new Exception('Status Code '.$this->response->getStatusCode());
                }
            }
        }
    }

    public function where($key, $operator, $value)
    {
        if ($this->query_string == '') {
            $this->query_string = '?where=';
        }
        $this->query_string .= urlencode($key.$operator.'"'.$value.'"');

        return $this;
    }

    public function first()
    {
        return $this->get()->first();
    }

    public function get()
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint().$this->query_string);
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getContents());
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function all()
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint());
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getContents());
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function find($id)
    {
        if (in_array('get', $this->methods)) {
            $this->response = $this->client->get($this->getEndpoint().'/'.$id);
            if ($this->response->getStatusCode() == '200') {
                return $this->collect($this->response->getContents())->first();
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    public function delete($id="")
    {
        if ($id == '') {
            $id = $this->getID();
        }
        if (in_array('delete', $this->methods)) {
            $this->response = $this->client->delete($this->getEndpoint().'/'.$id);
            if ($this->response->getStatusCode() == '200') {
                return $this->response->getStatusCode();
            } else {
                throw new Exception('Status Code '.$this->response->getStatusCode());
            }
        }
    }

    protected function collect($response)
    {
        $items = [];
        foreach ($response[$this->getEndpoint()] as $item) {
            $items[] = static::make($item);
        }

        return new Collection($items);
    }
}
