<?php
namespace App\Providers\OAuth2;

use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use SocialNorm\Providers\OAuth2Provider;

class IamProvider extends OAuth2Provider
{
    protected $authorizeUrl = "http://83.235.169.221/openam/oauth2/authorize";
    protected $accessTokenUrl = "http://83.235.169.221/openam/oauth2/access_token";
    protected $userDataUrl = "http://83.235.169.221/openam/oauth2/userinfo";
    protected $scope = [];

    protected $headers = [
        'authorize' => [],
        'access_token' => [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ],
        'user_details' => [],
    ];

    protected function compileScopes()
    {
        return implode(' ', $this->scope);
    }

    // Getters:
    protected function getAuthorizeUrl()
    {
        return $this->authorizeUrl;
    }
    protected function getAccessTokenBaseUrl()
    {
        return $this->accessTokenUrl;
    }
    protected function getUserDataUrl()
    {
        return $this->userDataUrl;
    }

    // protected function requestUserData()
    // {
    //     $url = $this->buildUserDataUrl();
    //     $response = $this->httpClient->get($url, [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $this->accessToken
    //         ]
    //     ]);
    //     return $this->parseUserDataResponse((string)$response->getBody());
    // }

    // Parsers:
    protected function parseTokenResponse($response)
    {
        return $this->parseJsonTokenResponse($response);
    }
    protected function parseUserDataResponse($response)
    {
        return json_decode($response, true);
    }

    // Response:
    protected function userId()
    {
        return $this->getProviderUserData('sub');
    }
    protected function nickname()
    {
        return $this->getProviderUserData('name');
    }
    protected function fullName()
    {
        return $this->getProviderUserData('given_name') . ' ' . $this->getProviderUserData('family_name');
    }
    protected function avatar()
    {
        return "";
    }
    protected function email()
    {
        return $this->getProviderUserData('email');
    }
}
