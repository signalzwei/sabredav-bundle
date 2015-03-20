<?php
namespace Signalzwei\Bundle\SabreDavBundle\Controller;

use Psr\Log\LoggerInterface;
use Signalzwei\Bundle\SabreDavBundle\Sapi;
use Sabre\DAV;
use Sabre\DAVACL;
use Sabre\CalDAV;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 *
 */
class DavController
{
    /**
     * @var DAV\Auth\Backend\BackendInterface
     */
    private $server;

    /**
     * @var
     */
    private $logger;

    /**
     * @param DAV\Server $server
     */
    public function __construct(DAV\Server $server, LoggerInterface $logger)
    {
        $this->server = $server;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @param string  $action
     *
     * @return StreamedResponse
     */
    public function executeAction(Request $request, $action)
    {
        $server = $this->server;

        $baseUri = $request->getBaseUrl().$request->getPathInfo();
        if ($action !== '/') {
            $baseUri = str_replace($action, '', $baseUri);
        }

        $server->setBaseUri($baseUri);

        $this->logger->info("DAVBASE: ".$baseUri);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($server) {
            $server->exec();
        });
        $response->send();


        return $response;
    }
}
