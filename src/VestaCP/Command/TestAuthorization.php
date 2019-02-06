<?php
namespace ProfiCloS\VestaCP\Command;

use ProfiCloS\VestaCP\AuthorizationException;
use ProfiCloS\VestaCP\InvalidResponseException;
use ProfiCloS\VestaCP\ProcessException;
use Psr\Http\Message\ResponseInterface;

class TestAuthorization extends Command
{

	public function getName(): string
	{
		return '';
	}

	public function needReturnCode(): bool
	{
		return true;
	}

	/**
	 * @return bool
	 * @throws ProcessException
	 */
	public function process(): bool
	{
		try {
			parent::defaultProcess();
		} catch (AuthorizationException $e) {
			return false;
		}

		if($this->getResponseCode() === 1) {
			return true;
		}

		throw new InvalidResponseException('Invalid Response. Is hostn really VestaCP?');
	}

	public function getRequestParams(): array
	{
		return [];
	}
}
