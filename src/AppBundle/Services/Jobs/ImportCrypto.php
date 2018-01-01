<?php

namespace AppBundle\Services\Jobs;

use AppBundle\Entity\CryptoCurrency;
use AppBundle\Entity\Currency;
use AppBundle\Services\CapAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ImportCrypto
{

	public $em;

	private $capAPI;

	public function __construct(ContainerInterface $container, CapAPI $capAPI)
	{
		$this->em = $container->get('doctrine.orm.default_entity_manager');
		$this->capAPI = $capAPI;
	}

	public function import($currency)
	{
		$getCurrency = $this->em->getRepository('AppBundle:Currency')->findOneBy(['name' => $currency]);

		foreach ($this->capAPI->render_crypto($currency) as $crypto) {

			$item = $this->em->getRepository('AppBundle:CryptoCurrency')->findOneBy(['cryptoId' => $crypto->id]);

			$crypto_currencies = $getCurrency->getCryptoCurrency()->contains($item);

			$volume24h = '24h_volume_'.strtolower($currency);
			$price = 'price_'.strtolower($currency);
			$marketCap = 'market_cap_'.strtolower($currency);

			if(!$crypto_currencies){
				//insert new

				$aud_crypto = new CryptoCurrency();
				$aud_crypto->setCryptoId($crypto->id);
				$aud_crypto->setImage('public/assets/img/'.$crypto->symbol.'.png');
				$aud_crypto->setName($crypto->name);
				$aud_crypto->setSymbol($crypto->symbol);
				$aud_crypto->setRank($crypto->rank);
				$aud_crypto->setPrice($crypto->$price);
				$aud_crypto->setPriceBtc($crypto->price_btc);
				$aud_crypto->setVolume24h($crypto->$volume24h);
				$aud_crypto->setMarketCap($crypto->$marketCap);
				$aud_crypto->setAvailableSupply($crypto->available_supply);
				$aud_crypto->setTotalSupply($crypto->total_supply);
				$aud_crypto->setPercentChange1h($crypto->percent_change_1h);
				$aud_crypto->setPercentChange24h($crypto->percent_change_24h);
				$aud_crypto->setPercentChange7d($crypto->percent_change_7d);
				$aud_crypto->setLastUpdated($crypto->last_updated);

				$cc = $this->em->getRepository(Currency::class)
					->findOneBy(['name' => $currency]);
				$aud_crypto->addCurrency($cc);

				$this->em->persist($aud_crypto);
				$this->em->flush();
				$this->em->clear();
	
			} else {
				//update

				$this->em->getRepository('AppBundle:CryptoCurrency')->bulkUpdateItems($crypto->id, 'public/assets/img/'.$crypto->symbol.'.png', $crypto->name,$crypto->symbol, $crypto->rank,
					$crypto->$price,  $crypto->price_btc, $crypto->$volume24h, $crypto->$marketCap, $crypto->available_supply, $crypto->total_supply,
					$crypto->percent_change_1h, $crypto->percent_change_24h, $crypto->percent_change_7d, $crypto->last_updated);
			}

		}

		$this->em->flush();
		$this->em->clear();

		return false;
	}


}