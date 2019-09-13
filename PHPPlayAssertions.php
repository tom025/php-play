<?php

namespace PHPPlay\Assertions;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\Constraint;

function assertThat(...$args): void
{
    Assert::assertThat(...$args);
}

function isTrue(): Constraint
{
    return Assert::isTrue();
}

function isFalse(): Constraint
{
    return Assert::isFalse();
}

function equalTo(...$args): Constraint
{
    return Assert::equalTo(...$args);
}

function identicalTo(...$args): Constraint
{
    return Assert::identicalTo(...$args);
}

function logicalNot(Constraint $constraint) : Constraint
{
    return Assert::logicalNot($constraint);
}

function not(Constraint $constraint) : Constraint
{
    return Assert::logicalNot($constraint);
}
