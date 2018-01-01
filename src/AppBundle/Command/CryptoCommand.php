<?php
namespace AppBundle\Command;
use AppBundle\Entity\CryptoCurrency;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Item;
use AppBundle\Entity\ItemSetting;
use AppBundle\Entity\Page;
use AppBundle\Services\CapAPI;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 05/02/2017
 * Time: 01:28
 */
class CryptoCommand  extends ContainerAwareCommand
{

        protected function configure()
        {
            $this->setName('webberdoo:crypto_command');
        }

        protected function execute(InputInterface $input, OutputInterface $output)
        {

        	$this->import();
        }


	public function import()
	{
		$currency = 'USD';
		$capAPI =  $this->getContainer()->get(CapAPI::class);
		$em = $this->getContainer()->get('doctrine')->getManager();

		$getCurrency = $em->getRepository('AppBundle:Currency')->findOneBy(['name' => $currency]);

		foreach ($capAPI->render_crypto($currency) as $crypto) {

			$item = $em->getRepository('AppBundle:CryptoCurrency')->findOneBy(['cryptoId' => $crypto->id]);

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

				$em->persist($aud_crypto);
				$em->flush();
				$em->clear();

			} else {
				//update

				$em->getRepository('AppBundle:CryptoCurrency')->bulkUpdateItems($crypto->id, 'public/assets/img/'.$crypto->symbol.'.png', $crypto->name,$crypto->symbol, $crypto->rank,
					$crypto->$price,  $crypto->price_btc, $crypto->$volume24h, $crypto->$marketCap, $crypto->available_supply, $crypto->total_supply,
					$crypto->percent_change_1h, $crypto->percent_change_24h, $crypto->percent_change_7d, $crypto->last_updated);
			}

		}

		$em->flush();
		$em->clear();

		return false;
	}


}