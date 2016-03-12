<?php
/**
 * Created by PhpStorm.
 * User: nightnr
 * Date: 12.3.2016
 * Time: 11:07
 */

namespace PubLeashBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Translation\Translator;
use Symfony\Component\HttpFoundation\RequestStack;

class MainMenu implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private static $BREADCRUMB_MAP = [
        "publeash_publication_publication" => [
            'trans.books_browse'
        ],
        "publeash_publication_addpublication" => [
            'trans.books_add'
        ],
        "fos_user_security_login" => [
            'user.login'
        ],
        "publeash_library_library" => [
            'trans.library'
        ]
    ];

    private static $MENU_ITEM_TO_ROUTE_MAP = [
        'trans.books_browse' => 'publeash_publication_publication',
        'trans.books_add' => 'publeash_publication_addpublication',
        'user.login' => 'fos_user_security_login',
        'trans.library' => 'publeash_library_library'
    ];


    public function breadcrumbs(FactoryInterface $factory, array $options) {
        /**
         * @var RequestStack $requestStack
         */
        $requestStack = $this->container->get('request_stack');
        dump($requestStack->getCurrentRequest()->get('_route'));
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'breadcrumb');
        $menu->addChild('trans.home', array('route' => 'publeash_default_index'));
        $route = $requestStack->getCurrentRequest()->get('_route');
        if(isset(self::$BREADCRUMB_MAP[$route])) {
            foreach(self::$BREADCRUMB_MAP[$route] as $menuItem) {
                $menu->addChild($menuItem, array('route' => isset(self::$MENU_ITEM_TO_ROUTE_MAP[$menuItem])?self::$MENU_ITEM_TO_ROUTE_MAP[$menuItem]:'publeash_default_index'));
            }
        }
        return $menu;
    }

    public function mainMenuLeft(FactoryInterface $factory, array $options)
    {
        /**
         * @var Translator $translator
         */
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-left');

        $menu->addChild('trans.home', array('route' => 'publeash_default_index'));

        $menu->addChild('trans.books',
            [
                'uri' => '#',
                'childrenAttributes' => [
                    'class' => 'dropdown-menu'
                ],
                'linkAttributes' => [
                    'data-toggle' => 'dropdown',
                    'class' => 'dropdown-toggle',
                    'role' => 'button',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false'
                ],
                'attributes' => [
                    'class' => 'dropdown'
                ]
            ]
        );


        $menu['trans.books']->addChild('trans.books_browse', array('route' => 'publeash_publication_publication'));
        $menu['trans.books']->addChild('trans.books_add', array('route' => 'publeash_publication_addpublication'));

        $menu->addChild('trans.library', array('route' => 'publeash_library_library'));

        return $menu;
    }

    public function mainMenuRight(FactoryInterface $factory, array $options)
    {
        /**
         * @var Translator $translator
         */
        $translator = $this->container->get('translator');
        $menu = $factory->createItem('root');

        $menu->addChild('trans.login', array('route' => 'publeash_default_index'))->setLabel($translator->trans('trans.home', [], 'PubLeashBundle'));

        $menu->addChild('trans.books', array('route' => 'publeash_default_index'))->setLabel($translator->trans('trans.books', [], 'PubLeashBundle'));
        $menu['trans.books']->addCHild('trans.books_browse', array('route' => 'publeash_default_index'))->setLabel($translator->trans('trans.books_browse', [], 'PubLeashBundle'));
        $menu['trans.books']->addCHild('trans.books_add', array('route' => 'publeash_default_index'))->setLabel($translator->trans('trans.books_add', [], 'PubLeashBundle'));

        $menu->addChild('trans.library', array('route' => 'publeash_default_index'))->setLabel($translator->trans('trans.library', [], 'PubLeashBundle'));

        return $menu;
    }
}