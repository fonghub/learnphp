<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace Doganoo\PHPAlgorithms\Datastructure\Set;

use Doganoo\PHPAlgorithms\Common\Abstracts\AbstractSet;
use Doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException;
use Doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use Doganoo\PHPAlgorithms\Common\Interfaces\ISet;
use Doganoo\PHPAlgorithms\Common\Util\Comparator;
use Doganoo\PHPAlgorithms\Datastructure\Table\HashTable;
use function is_iterable;

/**
 * Class HashSet
 *
 * @package Doganoo\PHPAlgorithms\Datastructure\Set
 */
class HashSet extends AbstractSet implements ISet {

    private $hashMap = null;

    public function __construct() {
        $this->hashMap = new HashTable();
    }

    /**
     * Adds all of the elements in the specified collection to this set if they're not already present (optional
     * operation).
     *
     * @param $elements
     * @return bool
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function addAll($elements): bool {
        $added = false;
        if (is_iterable($elements)) {
            foreach ($elements as $element) {
                $elementAdded = $this->add($element);
                $added        = $added || $elementAdded;
            }
        }
        return $added;
    }

    /**
     * Adds the specified element to this set if it is not already present (optional operation).
     *
     * @param $element
     * @return bool
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function add($element): bool {
        $contains = $this->contains($element);
        if ($contains) {
            return false;
        }
        return $this->hashMap->add($element, true);
    }

    /**
     * Returns true if this set contains the specified element.
     *
     * @param $object
     * @return bool
     */
    public function contains($object): bool {
        return $this->hashMap->containsKey($object);
    }

    /**
     * Removes all of the elements from this set (optional operation).
     */
    public function clear(): void {
        $this->hashMap->clear();
    }

    /**
     * Returns true if this set contains all of the elements of the specified collection.
     *
     * @param $elements
     * @return bool
     */
    public function containsAll($elements): bool {
        $contains = false;
        if (is_iterable($elements)) {
            foreach ($elements as $element) {
                $containsElement = $this->contains($element);
                $contains        = $contains && $containsElement;
            }
        }
        return $contains;
    }

    /**
     * Returns true if this set contains no elements.
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->hashMap->size() === 0;
    }

    /**
     * Removes the specified element from this set if it is present (optional operation).
     *
     * @param $object
     * @return bool
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function remove($object): bool {
        return $this->hashMap->remove($object);
    }

    /**
     * Retains only the elements in this set that are contained in the specified collection (optional operation).
     *
     * @param $elements
     * @return bool
     */
    public function retainAll($elements): bool {
        // TODO: Implement retainAll() method.
        return false;
    }

    /**
     * Returns the number of elements in this set (its cardinality).
     *
     * @return int
     */
    public function size(): int {
        return $this->hashMap->size();
    }

    /**
     * Returns an array containing all of the elements in this set.
     *
     * @return array
     */
    public function toArray(): array {
        return $this->hashMap->keySet();
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof HashSet) {
            if (Comparator::equals($this->hashMap, $object->hashMap)) return 0;
            if (Comparator::lessThan($this->hashMap, $object->hashMap)) return -1;
            if (Comparator::greaterThan($this->hashMap, $object->hashMap)) return 1;
        }
        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "hash_map" => $this->hashMap,
        ];
    }

}