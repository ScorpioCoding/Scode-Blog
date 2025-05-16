<?php

namespace App\Config;

class SetMeta
{
  public function __construct()
  {
    define('COMPANY_NAME', getenv('COMPANY_NAME'));
    define('COMPANY_EMAIL', getenv('COMPANY_NAME'));
    define('COMPANY_DESCRIPTION', getenv('COMPANY_DESCRIPTION'));
    define('COMPANY_KEYWORDS', getenv('COMPANY_KEYWORDS'));
    define('COMPANY_DOMAIN_NAME', getenv('COMPANY_DOMAIN_NAME'));
    define('COMPANY_URL', getenv('COMPANY_URL'));
    define('COMPANY_IMG', getenv('COMPANY_IMG'));
    define('COMPANY_COPYWRIGHT_STARTING_YEAR', getenv('COMPANY_COPYWRIGHT_STARTING_YEAR'));

    define('COMPANY_SUBDOMAINS', getenv('COMPANY_SUBDOMAINS'));

    define('TWITTER_HANDLE', getenv('TWITTER_HANDLE'));
    define('TWITTER_DOMAIN', getenv('TWITTER_DOMAIN'));

    define('GOOGLE_VERIFICATION_CODE', getenv('GOOGLE_VERIFICATION_CODE'));
    define('PINTREST_VERIFICATION_CODE', getenv('PINTREST_VERIFICATION_CODE'));

  }


}