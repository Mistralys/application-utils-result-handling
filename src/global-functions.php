<?php

declare(strict_types=1);

namespace AppUtils;

use AppUtils\Interfaces\StringableInterface;

/**
 * Creates a new operation result.
 *
 * @param object|NULL $subject The origin of the result message to retrieve again later. If NULL, an empty `stdClass` object will be used.
 * @param string|StringableInterface|NULL $label
 * @return OperationResult
 */
function operationResult(?object $subject=null, $label=null) : OperationResult
{
    return new OperationResult($subject, $label);
}

/**
 * Creates a new operation result collection.
 *
 * @param object|NULL $subject The origin of the result message to retrieve again later. If NULL, an empty `stdClass` object will be used.
 * @param string|StringableInterface|NULL $label
 * @return OperationResult_Collection
 */
function operationCollection(?object $subject=null, $label=null) : OperationResult_Collection
{
    return new OperationResult_Collection($subject, $label);
}
