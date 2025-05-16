<?php

namespace Modules\Site\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Translation;
use App\Core\Meta;

use Modules\Site\Models\mCommon;


/**
 *  Blog Controller
 */
class Blog extends Controller
{
  protected function before()
  {
  }

  public function indexAction($args = array())
  {
    //Template for rendering
    $args['template'] = 'Frontend';
    $args['view'] = "Blog";
    //MetaData
    $meta = array();
    $meta = (new Meta($args))->getMeta();
    // Translation
    $trans = array();
    $trans = Translation::translate($args);
    // Extra data
    $data = array();
    $errors = array();

    $isHas = mCommon::hasTable('post');
    if ($isHas["state"] === true) {
      $isCount = mCommon::countTable('post');
      if ($isCount["state"] === true && $isCount["data"][0] > 0) {
        $isData = mCommon::readAll('post');
        if ($isData["state"] === true) {
          $data = $isData["data"];
        } else {
          $errors = $isData["data"];
        }
      } elseif ($isCount["state"] === true && $isCount["data"][0] === 0) {
        $errors = "No Posts Found!";
      } elseif ($isCount["state"] === false) {
        $errors = $isCount["data"];
      }
    } elseif ($isHas["state"] === false) {
      $errors = $isHas["data"];
    }

    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";


    View::render($args, $meta, $trans, [
      'data' => $data,
      'errors' => $errors,
    ]);
  }


  protected function after()
  {
  }

  //END-Class
}