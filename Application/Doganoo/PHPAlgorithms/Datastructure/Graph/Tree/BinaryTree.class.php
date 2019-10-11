<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
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

namespace Doganoo\PHPAlgorithms\Datastructure\Graph\Tree;

use Doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use Doganoo\PHPAlgorithms\Common\Abstracts\AbstractTree;
use Doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use Doganoo\PHPAlgorithms\Common\Util\Comparator;
use Doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinaryNode;

/**
 * Class BinaryTree
 *
 * @package Doganoo\PHPAlgorithms\Datastructure\Graph\Tree
 */
class BinaryTree extends AbstractTree {
    /** @var int $size number of nodes in the tree */
    private $size = 0;

    /**
     * @param int $value
     * @return bool
     */
    public function insertValue(int $value) {
        return $this->insert(new BinaryNode($value));
    }

    /**
     * inserts a new value
     *
     * TODO find the right way of insertion - currently acting as a BST
     *
     * @param IBinaryNode|null $node
     * @return bool
     */
    public function insert(?IBinaryNode $node) {
        if (!$node instanceof IBinaryNode) {
            return false;
        }
        if (null === $this->getRoot()) {
            $this->setRoot($node);
            $this->size++;
            return true;
        }
        /** @var BinaryNode $current */
        $current = $this->getRoot();
        if ($node->getValue() < $current->getValue()) {
            while (null !== $current->getLeft()) {
                $current = $current->getLeft();
            }
            $this->size++;
            $current->setLeft($node);
            return true;
        } else if ($node->getValue() > $current->getValue()) {
            while (null !== $current->getRight()) {
                $current = $current->getRight();
            }
            $current->setRight($node);
            $this->size++;
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @return null
     */
    public function search($value) {
        $node = null;
        $traversal = new InOrder($this);
        $traversal->setCallable(function ($val) use ($value, &$node) {
            if (Comparator::equals($value, $val)) {
                $node = new BinaryNode($value);
            }
        });
        $traversal->traverse();
        return $node;
    }

    /**
     * returns the number of nodes in the tree
     *
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }
}