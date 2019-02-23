<?php
require_once __DIR__ . '/../vendor/autoload.php';

class commandTest extends \PHPUnit\Framework\TestCase
{

	public function testCommands(): void
	{
		$command = new \ProfiCloS\VestaCP\Command\TestAuthorization();
		$this->assertSame('', $command->getName());
		$this->assertSame([], $command->getRequestParams());

		$this->expectException(\ProfiCloS\VestaCP\InvalidResponseException::class);
		$command->process();

		$this->assertNull($command->getResponseText());

		$this->expectException(\ProfiCloS\VestaCP\InvalidResponseException::class);
		$this->assertNull($command->getResponseCode());

		$command->defaultProcess();

		$this->expectException(\ProfiCloS\VestaCP\ProcessException::class);
		$command->processException(new \GuzzleHttp\Exception\ClientException('throw!'));
	}

}
