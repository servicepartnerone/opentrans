<?php
/**
 * This file is part of the OpenTrans php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SE\Component\OpenTrans\Node;

use \JMS\Serializer\Annotation as Serializer;

use \SE\Component\OpenTrans\Node\NodeInterface;
use \SE\Component\OpenTrans\Util;

/**
 *
 * @package SE\Component\OpenTrans
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 */
abstract class AbstractNode implements NodeInterface
{
    /**
     *
     * @Serializer\Expose
     * @Serializer\Type("array")
     * @Serializer\XmlKeyValuePairs
     * @Serializer\XmlList(inline=true)
     * @Serializer\Accessor(getter="getNormalizedCustomEntries")
     * @var array
     */
    protected $customEntries = array();
    
    /**
     *
     * @param array $customEntries
     */
    public function setCustomEntries(array $customEntries)
    {
        if(empty($customEntries) === true) {
            $this->customEntries = $customEntries;
        }

        foreach($customEntries as $key => $value) {
            $this->addCustomEntry($key, $value);
        }
    }

    /**
     *
     * @param string $key
     * @param mixed $value
     */
    public function addCustomEntry($key, $value)
    {
        if(empty($this->customEntries)) {
            $this->customEntries = array();
        }

        $this->customEntries = array_merge(
            $this->customEntries,
            array($key => $value)
        );
    }

    /**
     *
     * @return array
     */
    public function getCustomEntries()
    {
        return $this->customEntries;
    }

    /**
     *
     * @return array
     */
    public function getNormalizedCustomEntries()
    {
        if(empty($this->customEntries)) {
            return null;
        }
        return Util::arrayChangeKeyCaseRecursive($this->customEntries, CASE_UPPER);
    }
}