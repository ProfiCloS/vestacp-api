<?php
namespace ProfiCloS\VestaCP\Command;

use GuzzleHttp\Exception\ClientException;
use ProfiCloS\VestaCP\AuthorizationException;
use ProfiCloS\VestaCP\InvalidResponseException;
use Psr\Http\Message\ResponseInterface;

abstract class Command implements ICommand
{

	private $lastResponse;

	public function processException(ClientException $exception)
	{
		var_dump($exception->getMessage());
		die;
	}

	public function setLastResponse(ResponseInterface $response): void
	{
		$this->lastResponse = $response->getBody()->getContents();
	}

	public function getResponseText(): string
	{
		return $this->lastResponse;
	}

	/**
	 * @return int
	 * @throws InvalidResponseException
	 */
	public function getResponseCode(): int
	{
		$responseText = $this->getResponseText();

		if(!preg_match('~^[\d]+$~', $responseText)) {
			throw new InvalidResponseException('Response is not code. Is hostname really VestaCP?');
		}

		return (int) $responseText;
	}

	/**
	 * @throws AuthorizationException
	 */
	public function defaultProcess(): void
	{
		$responseText = $this->getResponseText();

		if($responseText === 'Error: authentication failed') {
			throw new AuthorizationException('Authorization failed! Bad user or password');
		}
	}

}
