<?php
/**
 * Created by PhpStorm.
 * User: fredd
 * Date: 19/01/2017
 * Time: 17:36
 */

namespace AppBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class GlobalContent
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function pages()
    {

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        $setting = $em->getRepository('AppBundle:Page')->findAll();

        if(isset($setting)){
            if(count($setting) > 0){
                return $setting;
            }
        }
        return false;

    }



    

}