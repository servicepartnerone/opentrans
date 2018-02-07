<?php


namespace SE\Component\OpenTrans\Tests\Node\Order;

/**
 * @group serialization
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 */
class DeliveryDateNodeTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\DeliveryDateNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_DELIVERY_DATE);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DeliveryDateNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\DeliveryDateNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SetterAndGetterTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\DeliveryDateNode();
        $node->setType($type = "test");
        $this->assertEquals($type, $node->getType());

        $node->setDeliveryEndDate($endDate = new \DateTime("2001-03-28T09:30:00+01:00"));
        $this->assertEquals($endDate, $node->getDeliveryEndDate());

        $node->setDeliveryStartDate($startDate = new \DateTime("2001-03-28T09:30:00+01:00"));
        $this->assertEquals($startDate, $node->getDeliveryStartDate());
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\DeliveryDateNode();
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $content = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'DELIVERY_DATE', 'content' => ''), $content, $content);

        $node->setType("test");
        $node->setDeliveryStartDate($endDate = new \DateTime("2001-03-28T09:30:00+01:00"));
        $node->setDeliveryEndDate($startDate = new \DateTime("2001-03-28T09:30:00+01:00"));

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'DELIVERY_DATE', 'children' => array( 'count' => 2), 'attributes' => array('type' => 'test')
        ), $xml, $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'DELIVERY_START_DATE'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'DELIVERY_END_DATE'), $xml);
    }
}