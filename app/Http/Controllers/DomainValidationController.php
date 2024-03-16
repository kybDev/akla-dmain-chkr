<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DomainValidationController extends Controller
{
    public function validateDomains(Request $request)
    {
        $csv = $request->file('csv_file');
      
        $domains = array_map('str_getcsv', file($csv));
        // Assuming the first row contains header, if not, you may need to adjust the index.
        array_shift($domains);


        $results = [];

        foreach ($domains as $domain) {
            $result = $this->checkDomain($domain[0]);
            $results[] = [
                'domain' => $domain[0],
                'is_abusive' => $result['is_abusive'],
                'abuse_confidence_score' => $result['abuse_confidence_score']
            ];
        }

        return view('results', ['results' => $results]);
    }

    private function checkDomain($domain)
    {
        // Perform API request to AbuseIPDB
        // Make sure to replace YOUR_API_KEY with your actual API key
        $apiKey = 'e74e40cbf7230c053605096a4753f4b95699d26a3db9c8a35fa223d898393ae2a90dc356c2b2295f';
        $client = new Client();
        $response = $client->request('GET', 'https://api.abuseipdb.com/api/v2/check', [
            'headers' => [
                'Key' => $apiKey,
            ],
            'query' => [
                'ipAddress' => $domain,
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);

        return [
            'is_abusive' => $body['data']['isWhitelisted'] ? false : true,
            'abuse_confidence_score' => $body['data']['abuseConfidenceScore']
        ];
    }
}
