<?php

namespace App\Domain\V2\SatuSehat\Services;

use Satusehat\Integration\OAuth2Client;
use Satusehat\Integration\KYC;

class SatuSehatService
{
    private $oauthClient;

    public function __construct()
    {
        $this->oauthClient = new OAuth2Client();
    }

    public function generateKYCUrl(string $name, string $nik)
    {
        $this->oauthClient->token();

        $kyc = new KYC();

        $json = $kyc->generateUrl($name, $nik);
        $kyc_link = json_decode($json, true);

        return (object) $kyc_link['data'];
    }
}
