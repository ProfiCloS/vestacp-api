<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Command\Add\MailAccount;
use ProfiCloS\VestaCP\Command\Change\MailAccountPassword;
use ProfiCloS\VestaCP\Command\Delete\MailAccount as DeleteMailAccount;
use ProfiCloS\VestaCP\Command\Lists\MailAccounts;
use ProfiCloS\VestaCP\Command\Lists\MailDomainDkim;
use ProfiCloS\VestaCP\Command\Lists\MailDomainDkimDns;
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
	 * @param string $domain
	 * @param string $account
	 * @param string $password
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function addAccount(string $user, string $domain, string $account, string $password): bool
	{
		return $this->client->send(new MailAccount($user, $domain, $account, $password));
	}

	/**
	 * @param string $user
	 * @param string $domain
	 * @param string $account
	 * @param string $password
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function changeAccountPassword(string $user, string $domain, string $account, string $password): bool
	{
		return $this->client->send(new MailAccountPassword($user, $domain, $account, $password));
	}

	/**
	 * @param string $user
	 * @param string $domain
	 * @param string $account
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function deleteAccount(string $user, string $domain, string $account): bool
	{
		return $this->client->send(new DeleteMailAccount($user, $domain, $account));
	}

	/**
	 * @param string $user
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomainDkim(string $user, string $domain): array
	{
		return $this->client->send(new MailDomainDkim($user, $domain));
	}

	/**
	 * @param string $user
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomainDkimDns(string $user, string $domain): array
	{
		return $this->client->send(new MailDomainDkimDns($user, $domain));
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
