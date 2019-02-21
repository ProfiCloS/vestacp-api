<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Client;
use ProfiCloS\VestaCP\Command\Add\MailAccount;
use ProfiCloS\VestaCP\Command\Add\MailDomain;
use ProfiCloS\VestaCP\Command\Change\MailAccountPassword;
use ProfiCloS\VestaCP\Command\Delete\MailAccount as DeleteMailAccount;
use ProfiCloS\VestaCP\Command\Delete\MailDomain as DeleteMailDomain;
use ProfiCloS\VestaCP\Command\Lists\MailAccounts;
use ProfiCloS\VestaCP\Command\Lists\MailDomainDkim;
use ProfiCloS\VestaCP\Command\Lists\MailDomainDkimDns;
use ProfiCloS\VestaCP\Command\Lists\MailDomains;

class Mails extends Module
{

	/** @var string */
	private $user;

	public function __construct( Client $client, string $user )
	{
		parent::__construct( $client );
		$this->user = $user;
	}

	/**
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listAccounts(string $domain): array
	{
		return $this->client->send(new MailAccounts($this->user, $domain));
	}

	/**
	 * @param string $domain
	 * @param string $account
	 * @param string $password
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function addAccount(string $domain, string $account, string $password): bool
	{
		return $this->client->send(new MailAccount($this->user, $domain, $account, $password));
	}

	/**
	 * @param string $domain
	 * @param string $account
	 * @param string $password
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function changeAccountPassword(string $domain, string $account, string $password): bool
	{
		return $this->client->send(new MailAccountPassword($this->user, $domain, $account, $password));
	}

	/**
	 * @param string $domain
	 * @param string $account
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function deleteAccount(string $domain, string $account): bool
	{
		return $this->client->send(new DeleteMailAccount($this->user, $domain, $account));
	}

	/**
	 * @param string $domain
	 * @param bool   $antispam
	 * @param bool   $antivirus
	 * @param bool   $dkim
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function addDomain(string $domain, bool $antispam = true, bool $antivirus = true, bool $dkim = true): bool
	{
		return $this->client->send(new MailDomain($this->user, $domain, $antispam, $antivirus, $dkim));
	}

	/**
	 * @param string $domain
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function deleteDomain(string $domain): bool
	{
		return $this->client->send(new DeleteMailDomain($this->user, $domain));
	}

	/**
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomainDkim(string $domain): array
	{
		return $this->client->send(new MailDomainDkim($this->user, $domain));
	}

	/**
	 * @param string $domain
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomainDkimDns(string $domain): array
	{
		return $this->client->send(new MailDomainDkimDns($this->user, $domain));
	}

	/**
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomains(): array
	{
		return $this->client->send(new MailDomains($this->user));
	}

}
