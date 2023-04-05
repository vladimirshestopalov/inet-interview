<?php

interface IXMLHttpService{
    public function request($url, $method, ...$options);
}
class XMLHTTPRequestService {}

class XMLHttpService extends XMLHTTPRequestService implements IXMLHttpService  {
    public function request($url, $method, ...$options){};
}

class Http {
    private $service;

    public function __construct(IXMLHttpService $xmlHttpService) {
        $this->service=$xmlHttpService;
    }

    public function get(string $url, array $options) {
        $this->service->request($url, 'GET', $options);
    }

    public function post(string $url) {
        $this->service->request($url, 'GET');
    }
}
