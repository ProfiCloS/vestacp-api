<?php
namespace ProfiCloS\VestaCP\Command\Delete;

use ProfiCloS\VestaCP\Command\Add\ProcessCommand;

class MailDomain extends ProcessCommand
{

	/** @var string */
	private $user;

	/** @var string */
	private $domain;

	public function __construct(string $user, string $domain)
	{
		$this->user = $user;
		$this->domain = $domain;
	}

	public function getName(): string
	{
		return 'v-delete-mail-domain';
	}

	public function getRequestParams(): array
	{
		return [
			self::ARG_1 => $this->user,
			self::ARG_2 => $this->domain
		];
	}
}
