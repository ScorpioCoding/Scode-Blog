<?php

return (object) array(


  '' => [
    'lang' => 'en',
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Home',
    'action' => 'index'
  ],

  '/' => [
    'lang' => 'en',
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Home',
    'action' => 'index'
  ],

  '/{lang}/home' => [
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Home',
    'action' => 'index'
  ],

  '/{lang}/about' => [
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'About',
    'action' => 'index'
  ],

  '/{lang}/contact' => [
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Contact',
    'action' => 'index'
  ],

  '/{lang}/blog' => [
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Blog',
    'action' => 'index'
  ],

  '/{lang}/article/{slug:[a-z0-9]+(?:-[a-z0-9]+)*}' => [
    'module' => 'Site',
    'namespace' => 'Modules\Site\Controllers',
    'controller' => 'Article',
    'action' => 'index'
  ],



);