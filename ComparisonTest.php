<?php

require_once 'PHPPlayAssertions.php';

use function PHPPlay\Assertions\{assertThat, isTrue, isFalse, equalTo, identicalTo, not};
use PHPUnit\Framework\TestCase;

final class ComparisonTest extends TestCase
{
    public function testComparators()
    {
        // Based on https://phptherightway.com/pages/The-Basics.html
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
        assertThat($pos, identicalTo(0));
        assertThat($pos, equalTo(false));
        assertThat($pos, not(identicalTo(false)));
    }

    function ifStatementData()
    {
        return [
            [true, true],
            ['true', true],
            [1, true],
            ['1', true],
            [2, true],
            ['2', true],
            [false, false],
            ['false', true],
            [0, false],
            ['', false],
            ['0', false],
        ];
    }

    /**
     * @dataProvider ifStatementData
     */
    public function testIfStatements($value, $expectation)
    {
        assertThat(ifElse($value), identicalTo($expectation));
        assertThat(justIf($value), identicalTo($expectation));
        assertThat(boolCast($value), identicalTo($expectation));
    }

    function breakingSwitchStatementCases()
    {
        return [
            [true, ['case 2']],
            [3, ['default']],
            [2, ['case 2']],
            [1, ['case 1']],
            [0, ['case 0']],
            ['', ['case 0']],
            ['foobar', ['case 0']],
        ];
    }

    /**
     * @dataProvider breakingSwitchStatementCases
     */

    public function testBreakingSwitchStatement($value, $expected)
    {
        $this->_testFunction('breakingSwitchStatement', $value, $expected);
    }


    function fallThroughSwitchStatementData()
    {
        return [
            [true, ['case 2', 'case 1', 'case 0', 'case true', 'case false']],
            [1, ['case 1', 'case 0', 'case true', 'case false']],
            ['1', ['case 1', 'case 0', 'case true', 'case false']],
            [2, ['case 2', 'case 1', 'case 0', 'case true', 'case false']],
            ['2', ['case 2', 'case 1', 'case 0', 'case true', 'case false']],
            [false, ['case 0', 'case true', 'case false']],
            [0, ['case 0', 'case true', 'case false']],
            ['', ['case 0', 'case true', 'case false']],
            ['foobar', ['case 0', 'case true', 'case false']],
        ];
    }

    /**
     * @uses         breakingSwitchStatement()
     * @uses         fallThroughSwitchStatement()
     * @dataProvider fallThroughSwitchStatementData
     */
    public function testFallthroughSwitchStatement($value, $expectedCases)
    {
        $functionUnderTest = 'fallThroughSwitchStatement';
        $this->_testFunction($functionUnderTest, $value, $expectedCases);
    }

    private function _testFunction(string $functionUnderTest, $value, $expectedCases): void
    {
        $actual = call_user_func($functionUnderTest, $value);
        assertThat(
            $actual,
            identicalTo($expectedCases),
            sprintf("expected '%s' to match cases: [%s], but was: [%s]",
                $value,
                implode(', ', $expectedCases),
                implode(', ', $actual)
            )
        );
    }
}

function breakingSwitchStatement($a)
{
    $acc = [];
    switch ($a) {
        case 2:
            array_push($acc, 'case 2');
            break;
        case 1:
            array_push($acc, 'case 1');
            break;
        case 0:
            array_push($acc, 'case 0');
            break;
        case false:
            array_push($acc, 'case false');
            break;
        default:
            array_push($acc, 'default');
    }
    return $acc;
}

function fallThroughSwitchStatement($a)
{
    $acc = [];
    switch ($a) {
        case 2:
        {
            array_push($acc, 'case 2');
        }
        case 1:
        {
            array_push($acc, 'case 1');
        }
        case 0:
        {
            array_push($acc, 'case 0');
        }
        case true:
        {
            array_push($acc, 'case true');
        }
        case false:
        {
            array_push($acc, 'case false');
        }
    }
    return $acc;
}

function ifElse($a)
{
    if ($a) {
        return true;
    } else {
        return false;
    }
}

function justIf($a)
{
    if ($a) return true;
    return false;
}

function boolCast($a)
{
    return (bool)$a;
}

