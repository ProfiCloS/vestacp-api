<?php
namespace ProfiCloS\VestaCP\Command\Lists;

use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use ProfiCloS\VestaCP\AuthorizationException;
use ProfiCloS\VestaCP\Command\Command;
use ProfiCloS\VestaCP\ProcessException;

class User extends Command
{

	/** @var string */
	private $username;

	public function __construct(string $username)
	{
		$this->username = $username;
	}

	public function getName(): string
	{
		return 'v-list-user';
	}

	public function needReturnCode(): bool
	{
		return false;
	}

	/**
	 * @return array
	 * @throws ProcessException
	 * @throws AuthorizationException
	 */
	public function process(): ArrayHash
	{
		parent::defaultProcess();

		$responseJson = $this->getResponseText();
		try {
			$response = Json::decode( $responseJson );
		} catch ( JsonException $e ) {
			throw new ProcessException($responseJson);
		}

		// convert response to array
		return $this->processResponse((array)$response);
	}

	private function processResponse(array $users): ArrayHash
	{
		return ArrayHash::from((array) array_shift($users));
	}

	public function getRequestParams(): array
	{
		return [
			self::ARG_1 => $this->username,
			self::ARG_2 => self::FORMAT_JSON
		];
	}
}
