<?php

// src/AppBundle/Menu/Builder.php
namespace App\Menu;

use Knp\Menu\FactoryInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareInterface;
// use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * MenuBuilder en tant que service (cf. http://symfony.com/doc/master/bundles/KnpMenuBundle/menu_builder_service.html)
 *
 */
class MenuBuilder
{
    private $factory;
    private $container;
    
    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Container $container)
    {
        $this->factory = $factory;
        $this->container = $container;
    }
    
    public function createMainMenu(array $options)
    {
        //$userrole="ROLE_USER";
        if($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            $userrole = $this->container->get('security.token_storage')->getToken()->getUser()->getRoles();
            dump($userrole);
        }
        
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        //if(is_granted('ROLE_ADMIN'))
     
        $userrole[]="ROLE_USER";
        if(in_array("ROLE_ADMIN", $userrole))
            //if($userrole=="ROLE_ADMIN")
            {
                $menu->addChild('Home', array('route' => 'backoffice'))
                ->setAttributes(array(
                    'class' => 'nav-link',
                    'icon' => 'fa fa-list'
                ));
                // ... add more children
                $menu->addChild('Etape list', array('route' => 'admin_etape_index'))
                ->setAttributes(array('class' => 'nav-link'));
                $menu->addChild('Circuit list', array('route' => 'admin_circuit_index'))
                ->setAttributes(array('class' => 'nav-link'));
                $menu->addChild('Programmation list', array('route' => 'admin_programmation_circuit_index'))
                ->setAttributes(array('class' => 'nav-link'));
            }
   
        else{
            $menu->addChild('Home', array('route' => 'home'))
            ->setAttributes(array(
                'class' => 'nav-link',
                'icon' => 'fa fa-list'
            ));
            // ... add more children
            $menu->addChild('Circuit list', array('route' => 'frontoffice_circuitlist'))
            ->setAttributes(array('class' => 'nav-link'));
            $menu->addChild('Like list', array('route' => 'front_circuit_likes'))
            ->setAttributes(array('class' => 'nav-link'));
            
        }
        

        return $menu;
    }
    
    public function createUserMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav  ml-auto');
        
        //if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
        if($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            // Get username of the current logged in user
            $username = $this->container->get('security.token_storage')->getToken()->getUser()->getUsername();
            $label = 'Hi '. $username;
        }
        else 
       {
            $label = 'Hi visitor'; 
        }
        $menu->addChild('User', array('label' => $label))
        ->setAttribute('dropdown', true)
        ->setAttribute('icon', 'fa fa-user');
        
        return $menu;
    }
    
}
