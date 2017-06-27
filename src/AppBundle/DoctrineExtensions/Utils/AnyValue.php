<?php
namespace AppBundle\DoctrineExtensions\Utils;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class AnyValue extends FunctionNode {

    public $value;

    public function parse( Parser $parser ) {
        $parser->match( Lexer::T_IDENTIFIER );
        $parser->match( Lexer::T_OPEN_PARENTHESIS );
        $this->value = $parser->StringPrimary();
        $parser->match( Lexer::T_CLOSE_PARENTHESIS );
    }

    public function getSql( SqlWalker $sqlWalker ) {
        return 'ANY_VALUE(' . $this->value->dispatch( $sqlWalker ) . ')';
    }
}
