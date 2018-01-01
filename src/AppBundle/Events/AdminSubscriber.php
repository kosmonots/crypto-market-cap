<?php
namespace AppBundle\Events;

use AppBundle\Entity\AudCrypto;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Import;
use AppBundle\Services\CapAPI;
use AppBundle\Services\CryptoImport;
use AppBundle\Services\Jobs\ImportAud;
use AppBundle\Services\Jobs\ImportBrl;
use AppBundle\Services\Jobs\ImportUsd;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AdminSubscriber implements EventSubscriberInterface
{


	private $audCrypto;
	/**
	 * @var CryptoImport
	 */
	private $cryptoImport;
	/**
	 * @var CapAPI
	 */
	private $capAPI;


	private $em;
	/**
	 * @var ImportAud
	 */
	private $importAud;
	/**
	 * @var ImportBrl
	 */
	private $importBrl;
	/**
	 * @var ImportUsd
	 */
	private $importUsd;

	public function __construct(CryptoImport $cryptoImport)
	{


		$this->cryptoImport = $cryptoImport;
	}


	public static function getSubscribedEvents()
	{
		return [
			//EasyAdminEvents::PRE_PERSIST => 'onPrePersist',
		];
	}

	public function onPrePersist(GenericEvent $event)
	{
		$event = $event->getSubject();

		if($event instanceof Currency){
			if($event->getName())
			{
				$currency =  $event->getName();
				$this->cryptoImport->importCryptoCurrencies($currency);
			}

		}

		return null;

	}





}