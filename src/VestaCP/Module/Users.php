<?php
namespace ProfiCloS\VestaCP\Module;

use Nette\Utils\ArrayHash;
use ProfiCloS\VestaCP\Command\Add\User as AddUser;
use ProfiCloS\VestaCP\Command\Change\UserPassword;
use ProfiCloS\VestaCP\Command\Delete\User as DeleteUser;
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

	/**
	 * @param string $user
	 * @param string $password
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function changePassword(string $user, string $password): bool
	{
		return $this->client->send(new UserPassword($user, $password));
	}

	/**
	 * @param string $user
	 * @param string $password
	 * @param string $email
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function add(string $user, string $password, string $email): bool
	{
		return $this->client->send(new AddUser($user, $password, $email));
	}

	/**
	 * @param string $user
	 * @return bool
	 * @throws \ProfiCloS\VestaCP\ClientException
	 * @throws \ProfiCloS\VestaCP\ProcessException
	 */
	public function delete(string $user): bool
	{
		return $this->client->send(new DeleteUser($user));
	}

}
