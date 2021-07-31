<?php

namespace App\DQL;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * Custom DQL function returning the distance in km
 *
 * usage DISTANCE(latitudeFrom, longitudeFrom, latitudeTo, longitudeTo)
 */
class Distance extends FunctionNode
{
    private $latitudeFrom;
    private $longitudeFrom;
    private $latitudeTo;
    private $longitudeTo;

    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->latitudeFrom = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->longitudeFrom = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->latitudeTo = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->longitudeTo = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $sql = 'ACOS(
			COS(RADIANS('.$this->latitudeFrom->dispatch($sqlWalker).')) * COS(RADIANS('.$this->longitudeFrom->dispatch($sqlWalker).')) * COS(RADIANS('.$this->latitudeTo->dispatch($sqlWalker).')) * COS(RADIANS('.$this->longitudeTo->dispatch($sqlWalker).'))
			+ COS(RADIANS('.$this->latitudeFrom->dispatch($sqlWalker).')) * SIN(RADIANS('.$this->longitudeFrom->dispatch($sqlWalker).')) * COS(RADIANS('.$this->latitudeTo->dispatch($sqlWalker).')) * SIN(RADIANS('.$this->longitudeTo->dispatch($sqlWalker).'))
			+ SIN(RADIANS('.$this->latitudeFrom->dispatch($sqlWalker).')) * SIN(RADIANS('.$this->latitudeTo->dispatch($sqlWalker).'))
		) * 6378';

        return $sql;
    }
}
