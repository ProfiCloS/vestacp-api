<?php
namespace ProfiCloS\VestaCP;

use ProfiCloS\VestaCP\Authorization\Credentials;
use ProfiCloS\VestaCP\Authorization\Host;

class Client
{

	/** @var Host */
	private $host;

	public function __construct(Host $host)
	{
		$this->setHost($host);
	}

	public static function simpleFactory($hostname, $user, $password): Client
	{
		$credentials = new Credentials($user, $password);
		$host = new Host($hostname, $credentials);

		return new self($host);
	}

	public function setHost(Host $host)
	{
		$this->host = $host;
		return $this;
	}

	public function getHost(): Host
	{
		return $this->host;
	}

}
