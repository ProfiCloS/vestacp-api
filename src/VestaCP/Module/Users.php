<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Command\Lists\User;
use ProfiCloS\VestaCP\Command\Lists\Users as ListsUsers;

class Users extends Module
{

	/**
	 * @return ArrayHash[]
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function list(): array
	{
		return $this->client->send(new ListsUsers());
	}

	/**
	 * @param string $user
	 * @return ArrayHash
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function detail(string $user): ArrayHash
	{
		return $this->client->send(new User($user));
	}

}
