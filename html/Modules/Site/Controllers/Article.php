<?php

namespace Modules\Site\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Core\Translation;
use App\Core\Meta;

use Modules\Site\Models\mCommon;


/**
 *  Article Controller
 */
class Article extends Controller
{
  protected function before()
  {
  }

  public function indexAction($args = array())
  {
    //Template for rendering
    $args['template'] = 'Frontend';
    $args['view'] = "Article";
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
        $isData = mCommon::readBySlug('post', $args['slug']);
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