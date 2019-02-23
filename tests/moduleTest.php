<?php

use ProfiCloS\VestaCP\Authorization\Credentials;
use ProfiCloS\VestaCP\Authorization\Host;
use ProfiCloS\VestaCP\Client;

require_once __DIR__ . '/../vendor/autoload.php';

class moduleTest extends \PHPUnit\Framework\TestCase
{

	public function createClient(): Client
	{
		return Client::simpleFactory('someHost', 'someUser', 'somePass');
	}

	public function testModuleUser(): void
	{
		$client = $this->createClient();
		$this->assertSame(\ProfiCloS\VestaCP\Module\Users::class, get_class($client->getModuleUser()));
	}

	public function testModuleWeb(): void
	{
		$client = $this->createClient();
		$this->assertSame(\ProfiCloS\VestaCP\Module\Webs::class, get_class($client->getModuleWeb('test')));
	}

	public function testModuleMail(): void
	{
		$client = $this->createClient();
		$this->assertSame(\ProfiCloS\VestaCP\Module\Mails::class, get_class($client->getModuleMail('test')));
	}

}
