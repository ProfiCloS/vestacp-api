<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Command\Lists\MailAccounts;
use ProfiCloS\VestaCP\Command\Lists\MailDomains;

class Mails extends Module
{

	/**
	 * @param string $user
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listAccounts(string $user, string $domain): array
	{
		return $this->client->send(new MailAccounts($user, $domain));
	}

	/**
	 * @param string $user
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomains(string $user): array
	{
		return $this->client->send(new MailDomains($user));
	}

}
