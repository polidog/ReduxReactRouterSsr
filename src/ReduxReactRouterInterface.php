<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/10/18
 */

namespace Polidog\ReduxReactRouterSsr;


interface ReduxReactRouterInterface
{
    /**
     * @param string $rootContainer redux container
     * @param string $location      location path
     * @param array $store          preload state
     * @param string $id            element id
     *
     * @return array [$markup, $js]
     */
    public function __invoke($rootContainer, $location, array $store, $id);
}