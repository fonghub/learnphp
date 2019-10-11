<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Doganoo\PHPAlgorithms\Common\Abstracts;

use Doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use Doganoo\PHPAlgorithms\Common\Interfaces\INode;
use Doganoo\PHPAlgorithms\Common\Util\Comparator;

/**
 * Class AbstractNode
 * @package Doganoo\PHPAlgorithms\Common\Abstracts
 */
abstract class AbstractNode implements INode {

    private $value = null;

    public function __construct($value = null) {
        $this->setValue($value);
    }

    public function setValue($value):void {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * returns the height
     *
     * @return int
     */
    public function getHeight(): int {
        return $this->height($this);
    }

    /**
     * helper method
     *
     * @param IBinaryNode|null $node
     * @return int
     */
    private function height(?AbstractNode $node): int {
        if (null === $node) {
            return 0;
        }

        return 1 + max($this->height($node->getLeft()), $this->height($node->getRight()));
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof AbstractNode) {
            if (Comparator::equals($this->getValue(), $object->getValue())) return 0;
            if (Comparator::lessThan($this->getValue(), $object->getValue())) return -1;
            if (Comparator::greaterThan($this->getValue(), $object->getValue())) return 1;
        }
        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "value" => $this->getValue()
            , "height" => $this->getHeight()
        ];
    }
}