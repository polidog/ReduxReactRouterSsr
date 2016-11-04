<?php
/**
 * Created by PhpStorm.
 * User: polidog
 * Date: 2016/10/18
 */

namespace Polidog\ReduxReactRouterSsr;

use V8Js;

final class ReduxReactRouterJs implements ReduxReactRouterInterface
{
    /*
     * @var V8Js
     */
    private $v8;

    /**
     * @var string
     */
    private $reactBundleSrc;

    /**
     * @var string
     */
    private $appBundleSrc;

    /**
     * @param string $reactBundleSrc Bundled code include React, ReactDom, and Redux
     * @param string $appBundleSrc   Bundled application code
     */
    public function __construct($reactBundleSrc, $appBundleSrc)
    {
        $this->v8 = new V8Js();

        $this->reactBundleSrc = $reactBundleSrc;
        $this->appBundleSrc = $appBundleSrc;

        $this->v8->error = function ($container) {
        };

        $this->v8->redirect = function($code, $url) {

        };

        $this->v8->error404 = function() {

        };

        $this->v8->error500 = function($message) {

        };
    }


    public function __invoke($rootContainer, $location, array $store, $id)
    {
        $storeJson = json_encode($store);
        $code = <<< "EOT"
var console = {warn: function(){}, error: print};
var global = global || this, self = self || this, window = window || this;
var document = typeof document === 'undefined' ? '' : document;
{$this->reactBundleSrc}
var React = global.React, ReactDOM = global.ReactDOM, ReactDOMServer = global.ReactDOMServer, match = global.match, RouterContext = global.RouterContext;
{$this->appBundleSrc}
var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer}, routes = global.routes;
if (! App) { PHP.error('{$rootContainer}'); };

var html = "";
match({routes, location: '{$location}'},function(error, redirectLocation, renderProps){
    if (redirectLocation) {
        PHP.redirect(301, redirectLocation.pathname + redirectLocation.search);
    } else if (error) {
        PHP.error500(error.message);
    } else if (renderProps) {
        var Provider = global.Provider, configureStore = global.configureStore, App = global.{$rootContainer};
        html = ReactDOMServer.renderToString(React.createElement(Provider, { store: configureStore({$storeJson}) }, React.createElement(RouterContext, renderProps)));

    } else {
        PHP.error404();
    }
});
tmp = {html: html};
EOT;
        $v8 = $this->v8->executeString($code);
        $js = "ReactDOM.render(React.createElement(Provider,{store:configureStore($storeJson) },React.createElement(App)),document.getElementById('{$id}'));";

        return [$v8->html, $js];
        // TODO: Implement __invoke() method.
    }

}