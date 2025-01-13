<?php

declare(strict_types=1);

namespace AppUtils;

use AppUtils\Interfaces\StringableInterface;

/**
 * Creates a new operation result.
 *
 * @param object $subject
 * @param string|StringableInterface|NULL $label
 * @return OperationResult
 */
function operationResult(object $subject, $label=null) : OperationResult
{
    return new OperationResult($subject, $label);
}

/**
 * Creates a new operation result collection.
 *
 * @param object $subject
 * @param string|StringableInterface|NULL $label
 * @return OperationResult_Collection
 */
function operationCollection(object $subject, $label=null) : OperationResult_Collection
{
    return new OperationResult_Collection($subject, $label);
}
