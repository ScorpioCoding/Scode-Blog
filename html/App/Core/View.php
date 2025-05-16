<?php

namespace App\Core;


/** THE VIEW
 * 
 */
class View
{
  public function __construct()
  {
    echo ('test within the class not static');
  }

  public static function setView($args = array())
  {
    $view = PATH_MOD;
    $view .= ucfirst($args['module']) . DS . 'Views' . DS;
    $view .= ucfirst($args['view']);
    $view .= '.php';

    try {
      self::checkFile($view);
      return $view;
    } catch (NewException $e) {
      echo $e->getErrorMsg();
      return false;
    }
  }

  public static function setTemplate($args = array())
  {
    $template = PATH_MOD;
    $template .= ucfirst($args['module']) . DS . 'Templates' . DS;
    $template .= ucfirst($args['template']);
    $template .= '.phtml';

    try {
      self::checkFile($template);
      return $template;
    } catch (NewException $e) {
      echo $e->getErrorMsg();
      return false;
    }
  }


  /*
   * rendering the page - View.php
   * @params   array   $paths
   * @params   array   $data
   */
  public static function render($args = array(), $meta = array(), $trans = array(), $data = array())
  {
    try {
      $view = self::setView($args);

      $template = self::setTemplate($args);

      if ($view) {
        extract($meta);
        extract($data);
        require $template;
      } else {
        throw new NewException("View.php : render : Rendering FAILED");
      }
    } catch (NewException $e) {
      echo $e->getErrorMsg();
    }
  } //END render


  /*
   * Path checking at View base level - View.php
   * @params   array   $file
   */
  public static function checkFile($file)
  {
    if (!is_readable($file)) {
      throw new NewException("View.php : checkFile : File doesn't exist in Views : $file ");
      return false;
    } else {
      return true;
    }
  } //END checkFile



  //END-Class
}