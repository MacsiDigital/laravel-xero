<?php
namespace MacsiDigital\Xero\Support\Token;

use MacsiDigital\OAuth2\Support\Token\File as OAuth2FileToken;

class File extends OAuth2FileToken
{

	protected $tenantId = '';
	protected $idToken = '';

	public function tenantId() 
	{
		return $this->tenantId;
	}

	public function setTenantId($tenantId) 
	{
		$this->tenantId = $tenantId;
	}

	public function idToken() 
	{
		return $this->idToken;
	}

	public function setIdToken($idToken) 
	{
		$this->idToken = $idToken;
	}

	public function generateContent()
	{
		return "<?php 
		return [
			'accessToken' => '".$this->accessToken."',
			'refreshToken' => '".$this->refreshToken."',
			'expires' => '".$this->expires."',
			'tenantId' => '".$this->tenantId."',
			'idToken' => '".$this->idToken."',
		];";
	}

}