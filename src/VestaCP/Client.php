<?php
namespace ProfiCloS\VestaCP;

use ProfiCloS\VestaCP\Authorization\Credentials;
use ProfiCloS\VestaCP\Authorization\Host;
use ProfiCloS\VestaCP\Command\ICommand;
use ProfiCloS\VestaCP\Command\TestAuthorization;
use ProfiCloS\VestaCP\Module\Mails;
use ProfiCloS\VestaCP\Module\Users;
use ProfiCloS\VestaCP\Module\Webs;

class Client
{

	/** @var Host */
	private $host;

	/** @var \GuzzleHttp\Client */
	private $guzzleClient;

	/** @var array */
	private $modules = [];

	/**
	 * Client constructor.
	 * @param Host $host
	 * @param array|null $options
	 * @throws ClientException
	 */
	public function __construct(Host $host, array $options = null)
	{
		$this->setHost($host);
		$this->prepareCommunication($options);
	}

	/**
	 * @param $hostname
	 * @param $user
	 * @param $password
	 * @return Client
	 * @throws ClientException
	 */
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

	/**
	 * @return bool
	 * @throws ClientException
	 * @throws ProcessException
	 */
	public function testAuthorization(): bool
	{
		$command = new TestAuthorization();
		return $this->send($command);
	}

	/**
	 * @param ICommand $command
	 * @return mixed
	 * @throws ClientException
	 * @throws ProcessException
	 */
	public function send(ICommand $command)
	{
		$host = $this->getHost();
		try {
			$response = $this->guzzleClient->post($host->buildUri(), [
				'form_params' => array_merge(
					$host->getCredentials()->getRequestParams(),
					$command->getRequestParams(),
					[
						'returncode' => $command->needReturnCode() ? 'yes' : 'no',
						'cmd' => $command->getName()
					]
				),
				'verify' => false
			]);
			$command->setLastResponse($response);
			return $command->process();
		} catch (ProcessException $e) {
			throw $e;
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			return $command->processException($e);
		} catch (\Exception $e) {
			throw new ClientException('Fatal processing error (' . $e->getMessage() . ')');
		}
	}

	/**
	 * @param array|null $options
	 * @return Client
	 * @throws ClientException
	 */
	private function prepareCommunication(array $options = null): Client
	{
		try {
			$this->guzzleClient = new \GuzzleHttp\Client([
				'timeout' => $options['timeout'] ?? 5.0
			]);
		} catch (\Exception $e) {
			throw new ClientException('Bad Client configuration (' . $e->getMessage() . ')');
		}

		return $this;
	}

	private function loadModule($moduleName, $param = null)
	{
		if(!isset($this->modules[$moduleName])) {
			if($param !== null) {
				$this->modules[$moduleName] = new $moduleName($this, $param);
			} else {
				$this->modules[$moduleName] = new $moduleName($this);
			}
		}

		return $this->modules[$moduleName];
	}

	public function getModuleUser(): Users
	{
		return $this->loadModule(Users::class);
	}

	public function getModuleMail(string $user): Mails
	{
		return $this->loadModule(Mails::class, $user);
	}

	public function getModuleWeb(string $user): Webs
	{
		return $this->loadModule(Webs::class, $user);
	}

}
