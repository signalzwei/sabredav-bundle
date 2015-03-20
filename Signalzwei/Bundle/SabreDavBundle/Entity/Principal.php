<?php

namespace Signalzwei\Bunle\SabreDavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Principal
 *
 * @ORM\Table(name="prinipals")
 * @ORM\Entity
 */
class Principal
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $url;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $displayname;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $vcardurl;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDisplayname()
    {
        return $this->displayname;
    }

    /**
     * @param mixed $displayname
     */
    public function setDisplayname($displayname)
    {
        $this->displayname = $displayname;
    }

    /**
     * @return mixed
     */
    public function getVcardUrl()
    {
        return $this->vcardurl;
    }

    /**
     * @param mixed $vcardurl
     */
    public function setVcardurl($vcardurl)
    {
        $this->vcardurl = $vcardurl;
    }


}
