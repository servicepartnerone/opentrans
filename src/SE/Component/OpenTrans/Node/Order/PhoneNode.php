<?php

namespace SE\Component\OpenTrans\Node\Order;

use \JMS\Serializer\Annotation as Serializer;
use SE\Component\OpenTrans\Node\AbstractNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 *
 * @Serializer\XmlRoot("PHONE")
 * @Serializer\ExclusionPolicy("all")
 */
class PhoneNode extends AbstractNode
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("type")
     * @Serializer\Type("string")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("value")
     * @Serializer\Type("string")
     * @Serializer\XmlValue
     *
     * @var string
     */
    protected $value;

    /**
     *
     * @param string $type
     * @param string $value
     */
    public function __construct($type = null, $value = null)
    {
        if($type !== null) {
            $this->setType($type);
        }

        if($value !== null) {
            $this->setValue($value);
        }
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

}