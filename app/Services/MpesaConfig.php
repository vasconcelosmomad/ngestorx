<?php

namespace App\Services;

use Samuelbie\Mpesa\Config as BaseConfig;

class MpesaConfig extends BaseConfig
{
    public function generateURI(string $endpoint): string
    {
        // Remove o : inicial do endpoint se existir
        $endpoint = ltrim($endpoint, ':');
        
        // Separa a porta do caminho
        $parts = explode('/', $endpoint, 2);
        $port = $parts[0];
        $path = $parts[1] ?? '';
        
        // Gera a URL com a porta
        return 'https://' . $this->getApiHost() . ':' . $port . '/' . $path;
    }
} 