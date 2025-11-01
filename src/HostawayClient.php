<?php

namespace RanaTuhin\Hostaway;

use Illuminate\Support\Facades\Http;
use RanaTuhin\Hostaway\Exceptions\InvalidConfigurationException;
use RanaTuhin\Hostaway\Exceptions\RequestFailedException;
use RanaTuhin\Hostaway\Helpers\RequestHelper;
use RanaTuhin\Hostaway\Resources\{
    Listings,
    Reservations,
    Messages,
    Channels,
    Calendar,
    Guests,
    Tasks,
    Users
};

class HostawayClient
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected string $grantType;
    protected ?string $accessToken = null;

    /** @var RequestHelper */
    protected RequestHelper $request;

    public function __construct()
    {
        $this->baseUrl = config('hostaway.base_url', 'https://api.hostaway.com/v1');
        $this->clientId = config('hostaway.client_id');
        $this->clientSecret = config('hostaway.client_secret');
        $this->grantType = config('hostaway.grant_type', 'client_credentials');

        foreach (['client_id', 'client_secret', 'grant_type'] as $key) {
            if (empty(config("hostaway.{$key}"))) {
                throw InvalidConfigurationException::missing($key);
            }
        }

        $this->authenticate();
        $this->request = new RequestHelper($this->baseUrl, $this->accessToken);
    }

    /**
     * Authenticate and store access token.
     */
    protected function authenticate(): void
    {
        $response = Http::asForm()
            ->withHeaders([
                'Cache-control' => 'no-cache',
                'Content-type' => 'application/x-www-form-urlencoded',
            ])
            ->post("{$this->baseUrl}/accessTokens", [
                'grant_type' => $this->grantType,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'scope' => 'general',
            ]);

        if (!$response->successful()) {
            throw RequestFailedException::fromResponse($response->json());
        }

        $this->accessToken = $response->json('access_token');
    }

    /**
     * Return the HTTP request helper.
     */
    public function request(): RequestHelper
    {
        return $this->request;
    }

    /**
     * Initialize API resource classes.
     */
    public function listings(): Listings
    {
        return new Listings($this->request);
    }

    public function reservations(): Reservations
    {
        return new Reservations($this->request);
    }

    public function messages(): Messages
    {
        return new Messages($this->request);
    }

    public function channels(): Channels
    {
        return new Channels($this->request);
    }

    public function calendar(): Calendar
    {
        return new Calendar($this->request);
    }

    public function guests(): Guests
    {
        return new Guests($this->request);
    }

    public function tasks(): Tasks
    {
        return new Tasks($this->request);
    }

    public function users(): Users
    {
        return new Users($this->request);
    }
}
