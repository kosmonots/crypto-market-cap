<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 25/01/2017
 * Time: 01:43
 */

namespace AppBundle\Services;


use AppBundle\Services\Jobs\ImportAud;
use AppBundle\Services\Jobs\ImportBrl;
use AppBundle\Services\Jobs\ImportCrypto;
use AppBundle\Services\Jobs\ImportUsd;

class CryptoImport
{

	/**
	 * @var ImportCrypto
	 */
	private $importCrypto;

	public function __construct(ImportCrypto $importCrypto)
	{
		$this->importCrypto = $importCrypto;

	}

	public function importCryptoCurrencies($currency)
	{
		$this->importCrypto->import($currency);
	}

}