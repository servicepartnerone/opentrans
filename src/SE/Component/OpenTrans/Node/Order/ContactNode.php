<?php

namespace SE\Component\OpenTrans\Node\Order;

use \JMS\Serializer\Annotation as Serializer;
use \SE\Component\OpenTrans\Node\AbstractNode;
use \SE\Component\OpenTrans\Node\Order\PhoneNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 *
 * @Serializer\XmlRoot("CONTACT")
 * @Serializer\ExclusionPolicy("all")
 */
class ContactNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("CONTACT_NAME")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array<SE\Component\OpenTrans\Node\Order\PhoneNode>")
     * @Serializer\XmlList(inline=true, entry="PHONE")
     * @var array|\SE\Component\OpenTrans\Node\Order\PhoneNode
     */
    protected $phone = array();


    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("FAX")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $fax;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("EMAIL")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PUBLIC_KEY")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $publicKey;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("URL")
     * @Serializer\Type("string")
     *
     * @var string
     */
    protected $url;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array|PhoneNode
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param array|PhoneNode $phone
     */
    public function setPhone(array $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param PhoneNode $phone
     */
    public function addPhone(PhoneNode $phone)
    {
        $this->phone[] = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


}