<?php


require_once 'PHPPlayAssertions.php';

use function PHPPlay\Assertions\{assertThat, isTrue, isFalse, equalTo, identicalTo, not};
use PHPUnit\Framework\TestCase;

class DateAndTimeTest extends TestCase
{
    public function testCreatingFromFormat()
    {
        $format = '!d. m. Y'; // The '!' creates date times using epoch. See DateTime::createFromFormat docs.
        $dateTime = DateTime::createFromFormat($format, '22. 11. 1968');
        $expected = new DateTime('1968-11-22');
        print_r($dateTime);
        print_r($expected);
        assertThat($dateTime, equalTo($expected));
    }

}
