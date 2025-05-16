<?php

namespace App\Config;

class SetSubDomain
{

  public function __construct()
  {
    $url = $_SERVER['HTTP_HOST'];

    $parsedUrl = parse_url('http://' . $url, PHP_URL_HOST);
    $host = str_replace(COMPANY_DOMAIN_NAME, '', $parsedUrl);
    $host = rtrim($host, '.');


    $company_subdomains = explode(',', COMPANY_SUBDOMAINS);

    if ($host === "" || $host === "www") {
      define('WEBSITE_MODULE', $company_subdomains[0]);
    } else {
      $host = ucfirst($host);
      foreach ($company_subdomains as $sub) {
        $sub = trim($sub, " \n\r\t\v\x00");
        $sub = ucfirst($sub);
        if ($sub === $host) {
          define('WEBSITE_MODULE', $sub);
          break;
        }
      }

    }

  }


}