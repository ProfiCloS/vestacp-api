<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Client;
use ProfiCloS\VestaCP\Command\Add\WebDomain;
use ProfiCloS\VestaCP\Command\Add\WebDomainFtp;
use ProfiCloS\VestaCP\Command\Change\WebDomainFtpPassword;
use ProfiCloS\VestaCP\Command\Change\WebDomainFtpPath;
use ProfiCloS\VestaCP\Command\Delete\WebDomain as DeleteWebDomain;
use ProfiCloS\VestaCP\Command\Delete\WebDomainFtp as DeleteWebDomainFtpAlias;
use ProfiCloS\VestaCP\Command\Lists\WebDomains;

class Webs extends Module
{

	/** @var string */
	private $user;

	public function __construct( Client $client, string $user )
	{
		parent::__construct( $client );
		$this->user = $user;
	}

	/**
	 * @param string      $domain
	 * @param string|null $ip
	 * @param string|null $aliases
	 * @param string|null $proxyExtensions
	 * @param bool        $restart
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function addDomain(string $domain, string $ip = null, string $aliases = null, string $proxyExtensions = null, bool $restart = false): bool
	{
		return $this->client->send(new WebDomain($this->user, $domain, $ip, $aliases, $proxyExtensions, $restart));
	}

	/**
	 * @param string $domain
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function deleteDomain(string $domain): bool
	{
		return $this->client->send(new DeleteWebDomain($this->user, $domain));
	}

	/**
	 * @param string      $domain
	 * @param string      $ftpUser
	 * @param string      $ftpPassword
	 * @param string|null $ftpPath
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function addDomainFtp(string $domain, string $ftpUser, string $ftpPassword, string $ftpPath = null): bool
	{
		return $this->client->send(new WebDomainFtp($this->user, $domain, $ftpUser, $ftpPassword, $ftpPath));
	}

	/**
	 * @param string      $domain
	 * @param string      $ftpUser
	 * @param string      $ftpPassword
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function changeDomainFtpPassword(string $domain, string $ftpUser, string $ftpPassword): bool
	{
		return $this->client->send(new WebDomainFtpPassword($this->user, $domain, $ftpUser, $ftpPassword));
	}

	/**
	 * @param string $domain
	 * @param string $ftpUser
	 * @param string $ftpPath
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function changeDomainFtpPath(string $domain, string $ftpUser, string $ftpPath): bool
	{
		return $this->client->send(new WebDomainFtpPath($this->user, $domain, $ftpUser, $ftpPath));
	}

	/**
	 * @param string $domain
	 * @param string $ftpUser
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function deleteDomainFtp(string $domain, string $ftpUser): bool
	{
		return $this->client->send(new DeleteWebDomainFtpAlias($this->user, $domain, $ftpUser));
	}

	/**
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function listDomains(): array
	{
		return $this->client->send(new WebDomains($this->user));
	}

}
