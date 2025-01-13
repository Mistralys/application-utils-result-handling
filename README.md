# AppUtils - Result handling

Collection of classes used to store information on the results of application operations.

This is part of the [AppUtils project](https://github.com/Mistralys/application-utils).

# Features

- Store detailed status messages.
- Store success as well as error or warning messages.
- Store a single result or a collection of results.
- Ideal to collect validation messages, for example.
- Recognize results easily with numeric codes.
- Extend the classes to add custom methods.

# Requirements

- PHP 7.4 or higher
- [Composer](https://getcomposer.org/)

# Usage

## Single possible result

If an operation can only have a single possible result state,
you can use the `OperationResult` class.

```php
use function AppUtils\operationResult

const ERROR_FILE_NOT_FOUND = 1;

function doSomething() : OperationResult 
{
    // Create a new result object using the global function
    $result = operationResult();
    
    if(!file_exists('waldo.txt')) {
        return $result->makeError(
            'The waldo file could not be found :(',
            ERROR_FILE_NOT_FOUND
        );
    }
    
    return $result;
}

$result = doSomething();

if(!$result->isValid()) {
    echo $result;
}
```

> NOTE: The `isValid()` method returns `true` if 
> no state was set, or the state is of the success type. 

## Collection of results

### Introduction

If an operation can have multiple possible result states,
like a validation operation, for example, you can use the
result collection class.

Every call to `makeError()`, `makeWarning()` or `makeSuccess()`
will add a new result instance to the collection.

> All result types are stored in the collection, so it is
> important to note that both failed and successful operations
> can be tracked.

### Quick Start 

```php
use function AppUtils\operationCollection;
use AppUtils\OperationResult_Collection;

const VALIDATION_ERROR_NAME_TOO_SHORT = 1;
const VALIDATION_WARNING_NOT_RECOMMENDED_LENGTH = 2;

function validateSomething() : OperationResult_Collection 
{
    $collection = operationCollection();
    
    $collection->makeError(
        'The name must be at least 5 characters long',
        VALIDATION_ERROR_NAME_TOO_SHORT
    );
    
    $collection->makeWarning(
        'The name must be at most 50 characters long',
        VALIDATION_WARNING_NOT_RECOMMENDED_LENGTH
    )
    
    return $collection;
}

$collection = validateSomething();

if(!$collection->isValid()) {
     $results = $collection->getResults();
     // do something with the results
}
```

> NOTE: The `isValid()` method returns `true` if none of the
> results in the collection are of the error or warning type.

### Accessing the results

Accessing results is made to be as easy as possible, with many
different ways to get the information you need.

```php
use function AppUtils\operationCollection;

$collection = operationCollection();

// Get all results in the order they were added
$results = $collection->getResults(); 

// Get all errors
$errors = $collection->getErrors();

// Get all warnings
$warnings = $collection->getWarnings();

// Get all successes
$successes = $collection->getSuccesses();

// Get all notices
$notices = $collection->getNotices();

// Check if the collection contains any result of a specific type
if($collection->isError()) {}
if($collection->isWarning()) {}
if($collection->isSuccess()) {}
if($collection->isNotice()) {}

// Check if the collection contains a specific result code
if($collection->containsCode(1)) {
    // do something
}

// Get all unique result codes
$codes = $collection->getCodes();
```

### Counting results

All result types can be counted individually, and the total
number of results can be counted as well.

```php
use function AppUtils\operationCollection;

$collection = operationCollection();

// Count the total number of results
$all = $collection->countResults();
$errors = $collection->countErrors();
$warnings = $collection->countWarnings();   
$successes = $collection->countSuccesses();
$notices = $collection->countNotices();
    

```

## Extend the result classes

Both the `OperationResult` and collection classes are designed to be extended, 
so you can add your own custom methods to them. 

The most common use for this is to correctly document the result subject's type:

```php
use AppUtils\OperationResult;

/**
 * @method MyOperation getSubject() 
 */
class MyOperationResult extends OperationResult
{
    public function __construct(MyOperation $subject)
    {
        parent::__construct($subject);
    }
}
```
