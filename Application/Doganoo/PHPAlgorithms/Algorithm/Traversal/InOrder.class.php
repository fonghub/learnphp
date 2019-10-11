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

namespace Doganoo\PHPAlgorithms\Algorithm\Traversal;

use Doganoo\PHPAlgorithms\Common\Abstracts\AbstractTraverse;
use Doganoo\PHPAlgorithms\Common\Abstracts\AbstractTree;
use Doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;

/**
 * Class InOrder
 *
 * @package Doganoo\PHPAlgorithms\Algorithm\Traversal
 */
class InOrder extends AbstractTraverse {

    /** @var AbstractTree|null */
    private $binarySearchTree = null;

    /**
     * InOrder constructor.
     *
     * @param AbstractTree $tree
     */
    public function __construct(AbstractTree $tree) {
        $this->binarySearchTree = $tree;
    }

    /**
     * traverses the tree in in order
     */
    public function traverse() {
        $this->_traverse($this->binarySearchTree->getRoot());
    }

    /**
     * helper method for traversing
     *
     * @param IBinaryNode|null $node
     */
    public function _traverse(?IBinaryNode $node) {
        if (null !== $node) {
            if (null !== $node->getLeft()) {
                $this->_traverse($node->getLeft());
            }
            parent::visit($node->getValue());
            if (null !== $node->getRight()) {
                $this->_traverse($node->getRight());
            }
        }
    }

}