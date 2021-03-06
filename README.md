Testify - a micro unit testing framework
========================================
Testify is a micro unit testing framework for PHP 5.3+. It strives for elegance instead of feature bloat. Testing your code is no longer a chore - it's fun again.

## Requirements

* PHP 5.3+ is required
* [Composer](http://getcomposer.org/) to install Testify is recommended (but you can do this manually)


Usage
-----
Here is an example for a test suite with two test cases:

```php
require 'vendor/autoload.php';

use Math\MyCalc;
use Testify\Testify;

$tf = new Testify("MyCalc Test Suite");

$tf->beforeEach(function($tf) {
	$tf->data->calc = new MyCalc(10);
});

$tf->test("Testing the add() method", function($tf) {
	$calc = $tf->data->calc;

	$calc->add(4);
	$tf->assert($calc->result() == 14);

	$calc->add(-6);
	$tf->assertEquals($calc->result(), 8);
});

$tf->test("Testing the mul() method", function($tf) {
	$calc = $tf->data->calc;

	$calc->mul(1.5);
	$tf->assertEquals($calc->result(), 12);

	$calc->mul(-1);
	$tf->assertEquals($calc->result(), -12);
});

$tf();
```

# Documentation

 * `__construct( string $title )` - The constructor
 * `test( string $name, [Closure $testCase = null] )` - Add a test case.
 * `before( Closure $callback )` - Executed once before the test cases are run
 * `after( Closure $callback )` - Executed once after the test cases are run
 * `beforeEach( Closure $callback )` - Executed for every test case, before it is run
 * `afterEach( Closure $callback )` - Executed for every test case, after it is run
 * `run( )` - Run all the tests and before / after functions. Calls report() to generate the HTML report page
 * `assert( boolean $arg, [string $message = ''] )` - Alias for assertTrue() method
 * `assertTrue( boolean $arg, [string $message = ''] )` - Passes if given a truthfull expression
 * `assertFalse( boolean $arg, [string $message = ''] )` - Passes if given a falsy expression
 * `assertEquals( mixed $arg1, mixed $arg2, string [string $message = ''] )` - Passes if $arg1 == $arg2
 * `assertCount( integer $arg1, mixed $arg2, string [string $message = ''] )` - Passes if $arg1 == count($arg2)
 * `assertContains( mixed $needle, mixed $haystack, string [string $message = ''], boolean $ignoreCase )` - Passes if $haystack contains $needle
 * `assertNotEquals( mixed $arg1, mixed $arg2, string [string $message = ''] )` - Passes if $arg1 != $arg2
 * `assertSame( mixed $arg1, mixed $arg2, string [string $message = ''] )` - Passes if $arg1 === $arg2
 * `assertNotSame( mixed $arg1, mixed $arg2, string [string $message = ''] )` - Passes if $arg1 !== $arg2
 * `assertInArray( mixed $arg, array $arr, string [string $message = ''] )` - Passes if $arg is an element of $arr
 * `assertNotInArray( mixed $arg, array $arr, string [string $message = ''] )` - Passes if $arg is not an element of $arr
 * `pass( string [string $message = ''] )` - Unconditional pass
 * `fail( string [string $message = ''] )` - Unconditional fail
 * `report( )` - Generates a pretty CLI or HTML5 report of the test suite status. Called implicitly by run()
 * `__invoke( )` - Alias for run() method

