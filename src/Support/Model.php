<?php

namespace MacsiDigital\Xero\Support;

use MacsiDigital\API\Support\ApiResource;

class Model extends ApiResource
{
	
    public function getApiDataField()
    {
        return $this->endPoint;
    }

}