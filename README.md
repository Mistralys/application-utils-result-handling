# AppUtils - Result handling

Collection of classes used to store information on the results of application operations.

This is part of the [AppUtils project](https://github.com/Mistralys/application-utils).

# Features

- Store detailed status messages.
- Store success as well as error or warning messages.
- Recognize results easily with numeric codes.

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

echo doSomething();

function doSomething() : OperationResult 
{
    $result = new OperationResult();
    
    if(!file_exists('waldo.txt'))
    {
        return $result->makeError(
            'The operation failed because the target file does not exist.',
            ERROR_FILE_NOT_FOUND
        );
    }
    
    return $result;
}
```

