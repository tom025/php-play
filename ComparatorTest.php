<?php

require_once 'PHPPlayAssertions.php';

use function PHPPlay\Assertions\{assertThat, isTrue, isFalse, equalTo, identicalTo, not};
use PHPUnit\Framework\TestCase;

final class ComparatorTest extends TestCase
{
    public function testComparators()
    {
        $a = 5;

        assertThat($a == 5, isTrue());
        assertThat($a == '5', isTrue());
        assertThat($a === 5, isTrue());
        assertThat($a === '5', isFalse());

        assertThat($a, equalTo(5));
        assertThat($a, equalTo('5'));
        assertThat($a, identicalTo(5));
        assertThat($a, not(identicalTo('5')));

        $pos = strpos('testing', 'test');
        assertThat($pos, isTrue());
    }
}