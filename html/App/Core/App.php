<?php

namespace App\Core;

use App\Config\SetDb;
use App\Config\SetMeta;
use App\Config\SetRoutes;
use App\Config\SetSubDomain;


class App
{

  public function __construct()
  {
    self::setDatabase();
    self::setMeta();
    self::setSubDomain();
    self::router();
  }

  private static function setDatabase()
  {
    (new DotEnv(PATH_ENV . 'database.env'))->load();
    (new SetDb());
  }

  private static function setMeta()
  {
    (new DotEnv(PATH_ENV . 'meta.env'))->load();
    (new SetMeta());
  }

  /**
   * Retreave the subdomain name
   * "http://api.example.org -> api -> Api
   * "http://admin.example.org -> admin -> Admin
   * "http://example.org -> site -> Site
   * 
   * @return void
   */
  private static function setSubDomain()
  {
    (new SetSubDomain());
  }

  private static function router()
  {

    $routes = (new SetRoutes)->getRoutes();

    $router = new Router();

    foreach ($routes as $route => $params) {
      $router->addRoute($route, $params);
    }
    ;

    //PARSING URL
    $tokens = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES);

    //DISPATCH
    try {
      $router->dispatch($tokens);
    } catch (NewException $e) {
      echo $e->getErrorMsg();
    }
  }

  //END-Class
}