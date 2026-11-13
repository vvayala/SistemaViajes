<?php

namespace App\Services;

use Apify\Client\ApifyClient;
use Illuminate\Support\Facades\Log;

class FlightService
{
    protected ApifyClient $client;

    public function __construct()
    {
        $this->client = new ApifyClient(token: env('APIFY_TOKEN'));
    }

    /**
     * Busca vuelos en Apify.
     *
     * @return array<int, array<string, mixed>>
     */
    public function search(string $origin, string $destination, string $date, int $people): array
    {
        try {
            $run = $this->client->actor('kuezi~flight-offers-api')->call([
                'originLocationCode'      => $origin,
                'destinationLocationCode' => $destination,
                'departureDate'           => $date,
                'adults'                  => (int) $people,
                'currency'                => 'USD',
                'maxResults'              => 10,
            ]);

            $dataset = $this->client->dataset((string) $run->getDefaultDatasetId());

            return $dataset->listItems()->getItems();

        } catch (\Exception $e) {
            Log::error('Error en Apify: ' . $e->getMessage());

            return [];
        }
    }
}