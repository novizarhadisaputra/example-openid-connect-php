<?php

namespace App\Domain\V2\Authentication\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Jumbojett\OpenIDConnectClient;
use App\Http\Controllers\Controller;
use App\Interfaces\Http\Controllers\ResponseTrait;

class LoginSSOController extends Controller
{
    use ResponseTrait;

    protected $issuer;
    protected $client_id;
    protected $client_secret;
    protected $redirect_url;
    protected $oidc;

    public function __construct()
    {
        $this->issuer = env('OIDC_AUTH_URL');
        $this->client_id = env('OIDC_CLIENT_ID');
        $this->client_secret = env('OIDC_CLIENT_SECRET');
        $this->redirect_url = env('APP_URL') . '/v2/auth/callback';
        $this->oidc = new OpenIDConnectClient(
            $this->issuer,
            $this->client_id,
            $this->client_secret,
        );
    }

    public function authentication()
    {
        // setup configuration
        $this->configuration();

        return $this->oidc->authenticate();
    }

    public function callback(Request $request)
    {
        try {
            $this->authentication();

            // get data user info;
            $userInfo = $this->oidc->requestUserInfo();

            // merge data user with request from callback;
            $request->merge(['user' => (array) $userInfo]);

            // set session based on request code from callback
            session([$request->code => $request->input()]);

            return $request->input();
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function configuration()
    {
        // setup oidc;
        $this->oidc = new OpenIDConnectClient(
            $this->issuer,
            $this->client_id,
            $this->client_secret,
        );

        // add scopes oidc;
        $this->oidc->addScope(['profile', 'email', 'offline_access']);

        // set redirect url;
        $this->oidc->setRedirectURL($this->redirect_url);

        // set response;
        $response = ['code'];
        $this->oidc->setResponseTypes($response);
    }
}
