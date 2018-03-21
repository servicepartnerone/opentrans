<?php

namespace SE\Component\OpenTrans\Tests\Node\Order;

/**
 * @group serialization
 *
 * @package SE\Component\OpenTrans\Tests
 * @author Daniel Hahn <daniel.hahn@servicepartner.one>
 */
class ContactNodeTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @test
     */
    public function CanBeInitialized()
    {
        $loader = new \SE\Component\OpenTrans\NodeLoader();
        $node1 = new \SE\Component\OpenTrans\Node\Order\ContactNode();
        $node2 = $loader->getInstance(\SE\Component\OpenTrans\NodeLoader::NODE_ORDER_CONTACT);

        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ContactNode', $node1);
        $this->assertInstanceOf('\SE\Component\OpenTrans\Node\Order\ContactNode', $node2);

        $this->assertEquals(get_class($node1), get_class($node2));
    }

    /**
     *
     * @test
     */
    public function SerializeAndDeserializeTest()
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $contact = new \SE\Component\OpenTrans\Node\Order\ContactNode();
        $contact->setName($contactName = sha1(uniqid(microtime(true))));
        $contact->setEmail($contactEmail = sha1(uniqid(microtime(true))));
        $contact->addPhone($phone1 = new \SE\Component\OpenTrans\Node\Order\PhoneNode("office",sha1(uniqid(microtime(true))) ));
        $contact->addPhone($phone2 = new \SE\Component\OpenTrans\Node\Order\PhoneNode("office",sha1(uniqid(microtime(true))) ));

        $xml = $serializer->serialize($contact, 'xml');
        $this->assertTag($parent = array(
            'tag' => 'CONTACT', 'children' => array( 'count' => 4)
        ), $xml);

        $this->assertTag(array('parent' => $parent, 'tag' => 'CONTACT_NAME'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'EMAIL'), $xml);
        $this->assertTag(array('parent' => $parent, 'tag' => 'PHONE'), $xml);

        $actual = $serializer->deserialize($xml, get_class($contact), 'xml');
        $this->assertEquals($contactName, $actual->getName());
        $this->assertEquals($contactEmail, $actual->getEmail());
    }

}