<?php
namespace AppBundle\Security;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

// Based on http://stackoverflow.com/a/21720357
class CorsListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept, credentials');
        $responseHeaders->set('Access-Control-Allow-Origin', 'http://localhost');
        $responseHeaders->set('Access-Control-Allow-Credentials', 'true');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
    }
}