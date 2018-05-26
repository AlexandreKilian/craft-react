<?php

namespace react\context;

use Limenius\ReactRenderer\Context\ContextProviderInterface;

class CraftContextProvider implements ContextProviderInterface{
    
    private $request;

    public function __construct($request){
        $this->request = $request;

    }

    public function getContext($serverSide)
    {
        return [
            'serverSide' => $serverSide,
            'href' => $this->request->getAbsoluteUrl(),
            'scheme' => $this->request->getIsSecureConnection() ? 'https':'http',
            'host' => $this->request->getHostName(),
            "port" => $this->request->getPort(),
            "base" => $this->request->getBaseUrl(),
            "pathname" => '/' . $this->request->getPathInfo(),
            "search" => $this->request->getQueryParams()
        ];

    }
    
}