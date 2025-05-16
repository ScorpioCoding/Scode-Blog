<?php

namespace App\Core;

class Meta
{
  protected $meta = array();

  public function __construct($args = array())
  {
    $this->meta = self::loadMeta();
    self::setMeta($args);
  }

  protected function loadMeta()
  {
    date_default_timezone_set('Europe/Brussels');

    $html_encoding = "UTF-8";
    $html_type = "website";

    $copy_wright_years = COMPANY_COPYWRIGHT_STARTING_YEAR;
    $copy_wright_years .= " - ";
    $copy_wright_years .= date("Y");
    $copy_wright_years .= " - ";


    $scorpio = 'do we need this';

    return array(

      'scMetaLanguage' => '', //gets modified by the requested controller
      'scMetaNamespace' => '', //gets modified by the requested controller
      'scMetaController' => '', //gets modified by the requested controller
      'scMetaAction' => '', //gets modified by the requested controller
      'scMetaPath' => '', //gets modified by the requested controller
      'scMetaCharset' => $html_encoding,
      'scMetaGoogleSiteVerification' => GOOGLE_VERIFICATION_CODE,
      'scMetaDescription' => COMPANY_DESCRIPTION,
      'scMetaKeywords' => COMPANY_KEYWORDS,
      'scMetaCopyright' => COMPANY_NAME,
      'scMetaOgSiteName' => COMPANY_NAME,
      'scMetaOgUrl' => COMPANY_URL,
      'scMetaOgType' => $html_type,
      'scMetaOgTitle' => '', //gets modified by the requested controller
      'scMetaOgDescription' => COMPANY_DESCRIPTION,
      'scMetaOgImage' => COMPANY_IMG,
      'scTwitterSite' => TWITTER_HANDLE,
      'scTwitterDomain' => TWITTER_DOMAIN,
      'scPintRestKey' => PINTREST_VERIFICATION_CODE,
      'scMetaScorpio' => $scorpio,
      'scMetaCopyYears' => $copy_wright_years,
      'scMetaCopyLink' => COMPANY_URL,
    );
  }

  protected function setMeta($args = array())
  {
    //IN here we set the different controller information

    $lang = isset($args['lang']) ? $args['lang'] : $this->meta['scMetaLanguage'];

    $this->meta['scMetaOgUrl'] = $this->meta['scMetaOgUrl'];
    $this->meta['scMetaOgUrl'] .= '/' . $lang;
    $this->meta['scMetaOgUrl'] .= '/' . $args['controller'];
    $this->meta['scMetaOgUrl'] .= '/' . $args['action'];

    $this->meta['scMetaRoute'] = strtolower($args['controller']);
    $this->meta['scMetaRoute'] .= (strtolower($args['action']) === 'index') ? "" : DS . strtolower($args['action']);

    $this->meta['scPathCoreCss'] .= '/core/css/core';
    $this->meta['scPathCoreJs'] .= '/core/js/core';

    $this->meta['scPathCss'] .= '/';
    $this->meta['scPathCss'] .= strtolower($args['module']);
    $this->meta['scPathCss'] .= '/css/';
    $this->meta['scPathCss'] .= strtolower($args['controller']);

    $this->meta['scPathJs'] .= '/';
    $this->meta['scPathJs'] .= strtolower($args['module']);
    $this->meta['scPathJs'] .= '/js/';
    $this->meta['scPathJs'] .= strtolower($args['controller']);

    $this->meta['scPathTempCss'] .= '/';
    $this->meta['scPathTempCss'] .= strtolower($args['module']);
    $this->meta['scPathTempCss'] .= '/css/';
    $this->meta['scPathTempCss'] .= strtolower($args['template']);

    $this->meta['scPathTempJs'] .= '/';
    $this->meta['scPathTempJs'] .= strtolower($args['module']);
    $this->meta['scPathTempJs'] .= '/js/';
    $this->meta['scPathTempJs'] .= strtolower($args['template']);


    $this->meta['scMetaLanguage'] = $lang;
    $this->meta['scMetaNamespace'] = ucfirst($args['namespace']);
    $this->meta['scMetaController'] = ucfirst($args['controller']);
    $this->meta['scMetaAction'] = $args['action'];

    $this->meta['scMetaOgTitle'] = ucfirst($args['controller']);
    $this->meta['scMetaOgDescription'] .= ' ';
  }

  public function getMeta(): array
  {
    return $this->meta;
  }






  //END CLASS
}