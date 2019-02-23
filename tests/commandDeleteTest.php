<?php
require_once __DIR__ . '/../vendor/autoload.php';

class commandDeleteTest extends \PHPUnit\Framework\TestCase
{

	public function testUser(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\User('admin');
		$this->assertSame('v-delete-user', $command->getName());
		$this->assertSame(['arg1' => 'admin'], $command->getRequestParams());
	}

	public function testWebDomain(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\WebDomain('admin', 'domain.com');
		$this->assertSame('v-delete-web-domain', $command->getName());
		$this->assertSame([
			'arg1' => 'admin',
			'arg2' => 'domain.com'
		], $command->getRequestParams());
	}

	public function testWebDomainFtp(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\WebDomainFtp('admin', 'domain.com', 'account');
		$this->assertSame('v-delete-web-domain-ftp', $command->getName());
		$this->assertSame([
			'arg1' => 'admin',
			'arg2' => 'domain.com',
			'arg3' => 'account'
		], $command->getRequestParams());
	}

	public function testLEDomain(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\LetsEncryptDomain('admin', 'domain.com');
		$this->assertSame('v-delete-letsencrypt-domain', $command->getName());
		$this->assertSame([
			'arg1' => 'admin',
			'arg2' => 'domain.com',
			'arg3' => 'no'
		], $command->getRequestParams());
	}

	public function testMailAccount(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\MailAccount('admin', 'domain.com', 'account');
		$this->assertSame('v-delete-mail-account', $command->getName());
		$this->assertSame([
			'arg1' => 'admin',
			'arg2' => 'domain.com',
			'arg3' => 'account'
		], $command->getRequestParams());
	}

	public function testMailDomain(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\Delete\MailDomain('admin', 'domain.com');
		$this->assertSame('v-delete-mail-domain', $command->getName());
		$this->assertSame([
			'arg1' => 'admin',
			'arg2' => 'domain.com'
		], $command->getRequestParams());
	}


}
