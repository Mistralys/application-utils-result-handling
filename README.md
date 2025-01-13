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
use AppUtils\OperationResult;

const ERROR_FILE_NOT_FOUND = 1;

function doSomething() : OperationResult 
{
    $result = new OperationResult();
    
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

## Extend the result class

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
