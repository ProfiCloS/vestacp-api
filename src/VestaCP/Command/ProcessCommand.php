<?php
namespace ProfiCloS\VestaCP\Command\Add;

use ProfiCloS\VestaCP\AuthorizationException;
use ProfiCloS\VestaCP\Command\Command;
use ProfiCloS\VestaCP\ProcessException;

abstract class ProcessCommand extends Command
{

	public function needReturnCode(): bool
	{
		return true;
	}

	/**
	 * @return bool
	 * @throws ProcessException
	 * @throws AuthorizationException
	 */
	public function process(): bool
	{
		parent::defaultProcess();

		if ( $this->getResponseCode() === 0 ) {
			return true;
		}

		$this->throwCodeException( $this->getResponseCode() );
	}

}
