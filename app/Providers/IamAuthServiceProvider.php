<?php

namespace App\Providers;

use AdamWathan\EloquentOAuthL5\EloquentOAuthServiceProvider;

class IamAuthServiceProvider extends EloquentOAuthServiceProvider
{
    protected function getProviderLookup()
    {
        return array_merge($this->providerLookup, [
          'iam' => OAuth2\IamProvider::class
        ]);
    }

    public function __construct($app)
    {
        parent::__construct($app);
        $this->providerLookup = array_merge(
            $this->providerLookup,
            $this->additionalProviderLookup
        );
    }
}
