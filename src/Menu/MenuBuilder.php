<?php
namespace App\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;
    
    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        
        $menu->addChild('Accueil', ['route' => 'accueil']);
        $menu->addChild('Compte-Rendu', ['route' => 'compte_rendu']);
        $menu->addChild('Praticiens', ['route' => 'praticien']);
        $menu->addChild('Deconnexion', ['route' => 'logout']);
        
        
        return $menu;
    }
}