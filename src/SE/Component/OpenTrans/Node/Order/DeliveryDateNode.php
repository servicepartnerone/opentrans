<?php

namespace SE\Component\OpenTrans\Node\Order;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\AbstractNode;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 *
 * @Serializer\XmlRoot("DELIVERY_DATE")
 * @Serializer\ExclusionPolicy("all")
 */
class DeliveryDateNode extends AbstractNode
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
     * @Serializer\SerializedName("DELIVERY_START_DATE")
     * @Serializer\Type("DateTime")
     *
     * @var string
     */
    protected $deliveryStartDate;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("DELIVERY_END_DATE")
     * @Serializer\Type("DateTime")
     *
     * @var string
     */
    protected $deliveryEndDate;

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
    public function getDeliveryStartDate()
    {
        return $this->deliveryStartDate;
    }

    /**
     * @param string $deliveryStartDate
     */
    public function setDeliveryStartDate($deliveryStartDate)
    {
        $this->deliveryStartDate = $deliveryStartDate;
    }

    /**
     * @return string
     */
    public function getDeliveryEndDate()
    {
        return $this->deliveryEndDate;
    }

    /**
     * @param string $deliveryEndDate
     */
    public function setDeliveryEndDate($deliveryEndDate)
    {
        $this->deliveryEndDate = $deliveryEndDate;
    }


}