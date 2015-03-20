<?php
namespace Signalzwei\Bundle\SabreDavBundle\SabreDav\Auth\Backend;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Sabre\DAV\Auth\Backend\BackendInterface;
use Sabre\DAV\Exception;
use Sabre\DAV\Server;

class TokenBackend implements BackendInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * Constructor
     *
     * @param TokenStorageInterface $context
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @inheritdoc
     */
    public function authenticate(Server $server, $realm)
    {
        if (null === $this->tokenStorage->getToken()) {
            throw new Exception('No token available');
        }
        return $this->tokenStorage->getToken()->isAuthenticated();
    }

    /**
     * @inheritdoc
     */
    public function getCurrentUser()
    {
        if ($this->tokenStorage->getToken()) {
            return $this->tokenStorage->getToken()->getUsername();
        }
    }
}