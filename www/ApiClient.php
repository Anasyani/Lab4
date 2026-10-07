<?php
require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10,
            // hh.ru требует User-Agent
            'headers' => ['User-Agent' => 'lab4-student-app/1.0'],
        ]);
    }

    public function request(string $url): array
    {
        try {
            $response = $this->client->get($url);
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
            return is_array($data) ? $data : ['error' => 'Некорректный ответ API'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
