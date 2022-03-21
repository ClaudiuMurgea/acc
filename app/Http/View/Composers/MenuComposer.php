<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;


class MenuComposer
{

    public $parameters;
    public $topMenu;
    public $sideMenu;
    public $simpleMenu;


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        if (!is_null(request()->route())) {
            if (request()->route()->getName() == 'company.steps'){
                return;
            }
            if (!is_null(request()->route()) && \Auth::id()) {
                $pageName = request()->route()->getName();
                $layout = $this->layout($view);


                $activeMenu = $this->activeMenu($pageName, $layout);


                $type = $this->getType();


                $topMenu = 'App\Main\\' . $type . 'TopMenu';
                $sideMenu = 'App\Main\\' . $type . 'SideMenu';
                $simpleMenu = 'App\Main\\' . $type . 'SimpleMenu';
                if ($type == 'Facility'){
                    $extraMenu = true;
                }




                $view->with('top_menu', $topMenu::menu($this->parameters));
                $view->with('side_menu', $sideMenu::menu($this->parameters));
                $view->with('simple_menu', $simpleMenu::menu($this->parameters));
                if (isset($extraMenu)){
                    $view->with('extra_menu', true);
                }
                $view->with('first_level_active_index', $activeMenu['first_level_active_index']);
                $view->with('second_level_active_index', $activeMenu['second_level_active_index']);
                $view->with('third_level_active_index', $activeMenu['third_level_active_index']);
                $view->with('page_name', $pageName);
                $view->with('layout', $layout);
            }
        }
    }

    public function getType(){
        $type = 'Super';

        switch ($type){
            case request()->route()->getPrefix() == '/facility':
                $this->parameters = request()->route()->originalParameters();
                $type = 'Facility';
                break;
            case request()->route()->getPrefix() == '/company':
                $this->parameters = request()->route()->originalParameters();

                $type = 'Company';
        }

        return $type;
    }

    /**
     * Specify used layout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|string
     */
    public function layout($view)
    {

        if (isset($view->layout)) {
            return $view->layout;
        } else if (request()->has('layout')) {
            return request()->query('layout');
        }

        return 'side-menu';
    }

    /**
     * Determine active menu & submenu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activeMenu($pageName, $layout)
    {
        $firstLevelActiveIndex = '';
        $secondLevelActiveIndex = '';
        $thirdLevelActiveIndex = '';

        $type = $this->getType();



        $topMenu = 'App\Main\\'.$type.'TopMenu';
        $sideMenu = 'App\Main\\'.$type.'SideMenu';
        $simpleMenu = 'App\Main\\'.$type.'SimpleMenu';



        if ($layout == 'login'){
            return;
        }

        if ($layout == 'top-menu') {
            foreach ($topMenu::menu($this->parameters) as $menuKey => $menu) {


                if (isset($menu['route_name']) && $menu['route_name'] == $pageName && empty($firstPageName)) {

                    $firstLevelActiveIndex = $menuKey;
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenuKey => $subMenu) {
                        if (isset($subMenu['route_name']) && $subMenu['route_name'] == $pageName && $menuKey != 'menu-layout' && empty($secondPageName)) {
                            $firstLevelActiveIndex = $menuKey;
                            $secondLevelActiveIndex = $subMenuKey;
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu) {
                                if (isset($lastSubMenu['route_name']) && $lastSubMenu['route_name'] == $pageName) {
                                    $firstLevelActiveIndex = $menuKey;
                                    $secondLevelActiveIndex = $subMenuKey;
                                    $thirdLevelActiveIndex = $lastSubMenuKey;
                                }
                            }
                        }
                    }
                }
            }
        } else if ($layout == 'simple-menu') {

            foreach ($simpleMenu::menu() as $menuKey => $menu) {

                if ($menu !== 'devider' && isset($menu['route_name']) && $menu['route_name'] == $pageName && empty($firstPageName)) {
                    $firstLevelActiveIndex = $menuKey;
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenuKey => $subMenu) {
                        if (isset($subMenu['route_name']) && $subMenu['route_name'] == $pageName && $menuKey != 'menu-layout' && empty($secondPageName)) {
                            $firstLevelActiveIndex = $menuKey;
                            $secondLevelActiveIndex = $subMenuKey;
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu) {
                                if (isset($lastSubMenu['route_name']) && $lastSubMenu['route_name'] == $pageName) {
                                    $firstLevelActiveIndex = $menuKey;
                                    $secondLevelActiveIndex = $subMenuKey;
                                    $thirdLevelActiveIndex = $lastSubMenuKey;
                                }
                            }
                        }
                    }
                }
            }
        } else {

            foreach ($sideMenu::menu($this->parameters) as $menuKey => $menu) {
                if ($menu !== 'devider' && isset($menu['route_name']) && $menu['route_name'] == $pageName && empty($firstPageName)) {
                    $firstLevelActiveIndex = $menuKey;
                }

                if (isset($menu['sub_menu'])) {
                    foreach ($menu['sub_menu'] as $subMenuKey => $subMenu) {
                        if (isset($subMenu['route_name']) && $subMenu['route_name'] == $pageName && $menuKey != 'menu-layout' && empty($secondPageName)) {
                            $firstLevelActiveIndex = $menuKey;
                            $secondLevelActiveIndex = $subMenuKey;
                        }

                        if (isset($subMenu['sub_menu'])) {
                            foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu) {
                                if (isset($lastSubMenu['route_name']) && $lastSubMenu['route_name'] == $pageName) {
                                    $firstLevelActiveIndex = $menuKey;
                                    $secondLevelActiveIndex = $subMenuKey;
                                    $thirdLevelActiveIndex = $lastSubMenuKey;
                                }
                            }
                        }
                    }
                }
            }
        }

        return [
            'first_level_active_index' => $firstLevelActiveIndex,
            'second_level_active_index' => $secondLevelActiveIndex,
            'third_level_active_index' => $thirdLevelActiveIndex
        ];
    }
}
