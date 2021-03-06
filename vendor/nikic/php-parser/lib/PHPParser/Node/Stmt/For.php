<?php

namespace PhpParser\Node\Stmt;

use PhpParser\Node;

/**
 * @property Node\Expr[] $init  Init expressions
 * @property Node\Expr[] $cond  Loop conditions
 * @property Node\Expr[] $loop  Loop expressions
 * @property Node[]      $stmts Statements
 */
class For_ extends Node\Stmt
{
    /**
     * Constructs a for loop node.
     *
     * @param array $subNodes   Array of the following optional subnodes:
     *                          'init'  => array(): Init expressions
     *                          'cond'  => array(): Loop conditions
     *                          'loop'  => array(): Loop expressions
     *                          'stmts' => array(): Statements
     * @param array $attributes Additional attributes
     */
    public function __construct(array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'init'  => array(),
                'cond'  => array(),
                'loop'  => array(),
                'stmts' => array(),
            ),
            $attributes
        );
    }
}