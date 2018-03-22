<?php


namespace SE\Component\OpenTrans\Tests\Node\Order;

/**
 * @group serialization
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 */
class PhoneNodeTest  extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\PhoneNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_PHONE);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PhoneNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\PhoneNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $node = new \SE\Component\OpenTrans\Node\Order\PhoneNode($type = 'office', $value = '1234567');
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        $xml = $serializer->serialize($node, 'xml');
        $this->assertTag(array('tag' => 'PHONE', 'attributes' => array('type' => $type)), $xml, $xml);

        /* @var $actual \SE\Component\OpenTrans\Node\Order\PhoneNode */
        $actual = $serializer->deserialize($xml, get_class($node), 'xml');
        $this->assertEquals($type, $actual->getType());
        $this->assertEquals($value, $actual->getValue());
    }
}