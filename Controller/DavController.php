<?php
namespace Singalzwei\Bundle\SabreDavBundle\Controller;

use Singalzwei\Bundle\SabreDavBundle\Sapi;
use Sabre\DAV;
use Sabre\DAVACL;
use Sabre\CalDAV;
use Symfony\Component\HttpFoundation\Request;

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
     * @param DAV\Server $server
     */
    public function __construct(DAV\Server $server)
    {
        $this->server = $server;
    }

    /**
     *
     */
    public function executeAction(Request $request)
    {
        // Directory tree
        $tree = array(
            new DAVACL\PrincipalCollection($this->principal),
            new CalDAV\CalendarRootNode($this->principal, $this->calendar)
        );

        $server = new DAV\Server($tree);
        $server->setBaseUri($request->getBaseUrl());

        $response = new StreamedResponse();
        $response->setCallback(function () use ($server) {
            $server->exec();
        });
        $response->send();


        return $response;
    }
}
