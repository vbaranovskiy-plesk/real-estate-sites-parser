<?php
namespace App\Site;

use Exception;

abstract class TokenPrefetch extends Profitbase
{
    private ?string $cachedToken = null;

    protected function getPbDomain(): string
    {
        return 'profitbase.ru';
    }

    protected function getAccountId(): string
    {
        return preg_replace('/^pb/', '', $this->getSubdomain());
    }

    protected function getAuthToken(): string
    {
        if ($this->cachedToken !== null) {
            return $this->cachedToken;
        }

        $siteUrl = $this->getSiteUrl();
        $url = 'https://sso.' . $this->getPbDomain() . '/api/oauth2/token';
        $body = json_encode([
            'client_id' => 'site_widget',
            'client_secret' => 'site_widget',
            'grant_type' => 'site_widget',
            'scope' => 'SITE_WIDGET',
            'referer' => $siteUrl,
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'X-Tenant-Id: ' . $this->getAccountId(),
                'Referer: ' . rtrim($siteUrl, '/') . '/',
                'Origin: ' . $siteUrl,
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        if ($response === false) {
            $err = curl_error($ch);
            curl_close($ch);
            throw new Exception('Unable to fetch auth token for ' . static::class . ': ' . $err);
        }
        curl_close($ch);

        $decoded = json_decode($response, true);
        if (!isset($decoded['access_token'])) {
            throw new Exception('SSO did not return access_token for ' . static::class . ': ' . $response);
        }

        return $this->cachedToken = $decoded['access_token'];
    }
}