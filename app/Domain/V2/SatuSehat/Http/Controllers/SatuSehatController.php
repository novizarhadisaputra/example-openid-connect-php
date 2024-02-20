<?php

namespace App\Domain\V2\SatuSehat\Http\Controllers;

use App\Http\Controllers\Controller;
use DtoIhc\HisV2AuthMiddleware\Auth;
use App\Interfaces\Http\Controllers\ResponseTrait;
use App\Domain\V2\SatuSehat\Services\SatuSehatService;
use App\Domain\V2\SatuSehat\Http\Requests\GenerateUrlKYCRequest;
use App\Domain\V2\SatuSehat\Http\Resources\GenerateKYCUrlResource;

class SatuSehatController extends Controller
{
    use ResponseTrait;

    protected SatuSehatService $satuSehatService;
    protected Auth $auth;

    public function __construct(SatuSehatService $satuSehatService)
    {
        $this->satuSehatService = $satuSehatService;
        $this->resourceItem = GenerateKYCUrlResource::class;
        $this->auth = new Auth();
    }

    public function generateUrlKYC(GenerateUrlKYCRequest $request): GenerateKYCUrlResource
    {
        $params = (object) [
            'token'  => $request->cookie('storageToken'), // Replace "CLIENT_TOKEN" with the actual client token value
            'module' => 'KYC',
            'action' => 'CREATE',
        ];

        $this->auth->validate($params);

        $data = $this->satuSehatService->generateKYCUrl($request->name, $request->nik);
        return $this->respondWithCustomItem($data);
    }
}
