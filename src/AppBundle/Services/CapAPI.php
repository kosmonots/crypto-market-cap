<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 02/10/2017
 * Time: 18:09
 */

namespace AppBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class CapAPI
{
    const API_ENDPOINT = 'https://api.coinmarketcap.com/v1/ticker/';

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $em = $container->get('doctrine.orm.default_entity_manager');
    }

    public function render_crypto($currency)
    {//?convert=EUR&limit=10
         return $this->initCurl(self::API_ENDPOINT.'?limit=0&convert='.$currency);
    }

    //curl
    private function initCurl( $url )
    {

        $header = array();
      //  $header[] = 'Authorization: Bearer '.$this->envato_token;
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

        $envatoRes = curl_exec($curl);
        curl_close($curl);
        $envatoRes = json_decode($envatoRes);

        return $envatoRes;
    }

}