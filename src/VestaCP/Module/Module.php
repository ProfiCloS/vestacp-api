<?php
namespace ProfiCloS\VestaCP\Module;

use ProfiCloS\VestaCP\Client;

abstract class Module implements IModule
{

	/** @var Client */
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

}
