<?php
namespace ProfiCloS\VestaCP\Command\Lists;

use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Nette\Utils\JsonException;
use ProfiCloS\VestaCP\AuthorizationException;
use ProfiCloS\VestaCP\Command\Command;
use ProfiCloS\VestaCP\ProcessException;

class Users extends Command
{

	public function getName(): string
	{
		return 'v-list-users';
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
	public function process(): array
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

	private function processResponse(array $users): array
	{
		foreach($users as $login => $user) {
			$users[$login] = ArrayHash::from((array) $user);
		}

		return $users;
	}

	public function getRequestParams(): array
	{
		return [
			self::ARG_1 => self::FORMAT_JSON
		];
	}
}
