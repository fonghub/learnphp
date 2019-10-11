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
 * Class PostOrder
 *
 * @package Doganoo\PHPAlgorithms\Algorithm\Traversal
 */
class PostOrder extends AbstractTraverse {

    /** @var AbstractTree|null */
    private $tree = null;

    /**
     * PostOrder constructor.
     *
     * @param AbstractTree $tree
     */
    public function __construct(AbstractTree $tree) {
        $this->tree = $tree;
    }

    /**
     * traverses the tree in post order
     */
    public function traverse() {
        $this->_traverse($this->tree->getRoot());
    }

    /**
     * helper method
     *
     * @param IBinaryNode|null $node
     */
    public function _traverse(?IBinaryNode $node) {
        if (null !== $node) {
            if (null !== $node->getLeft()) {
                $this->_traverse($node->getLeft());
            }
            if (null !== $node->getRight()) {
                $this->_traverse($node->getRight());
            }
            parent::visit($node->getValue());
        }
    }

}