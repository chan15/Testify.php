<?php

/*
 * This is a minimal example of Testify using run() with a custom reporter
 *
 */

require '../vendor/autoload.php';

use Testify\Testify;

$tf = new Testify("A basic test suite using run a custom reporter.");

// Add a test case
$tf->test("Just testing around", function($tf) {

	$tf->assert(true, "Must pass !");
	$tf->assertFalse(false);
	$tf->assertEquals(1,'1');
	$tf->assertSame(1,1);

	$tf->assertInArray('a',array(1,2,3,4,5,'a'));
	$tf->pass("Always pass");

});

$tf->test("I've got a bad feeling about this one", function($tf) {

	$tf->assert(false);
	$tf->assertFalse(true);
	$tf->assertEquals(1,'-21');
	$tf->assertSame(1,'1');

	$tf->assertInArray('b',array(1,2,3,4,5,'a'));
	$tf->fail();

});

$tf->test("This should work fine", function($tf) {

    $tf->assert(true, "Must pass again!");
	$tf->assertFalse(false);

});

$tf->run(function($title, $suiteResults, $cases) {
    $tests = 0;
    $passed = 0;
    $errors = '';
    
    echo "<strong>{$title}</strong><br>";    
    foreach($cases as $caseTitle => $case) {
        $tests += 1;
        if( !$case['fail'] ){
            echo "<span style='color:#008800;'>{$caseTitle}</span><br>";
            $passed += 1;
        }else{
            foreach ($case['tests'] as $test) {
                if( $test['result'] == 'fail' ){
                    $error = "<span style='color:#880000;'>{$caseTitle}</span><br>";
                    echo $error;                    
                    $errors .= "- $error<code style='color:#bb0000;'>&nbsp;[{$test['file']}][{$test['line']}] {$test['source']}</code><br>";
                    continue 2;              
                }                
            }
        }
    }
    
    echo "------<br><span>$passed/$tests passed</span>";
    if( $errors ){
        echo '<br><br>The following test functions failed:<br>';
        echo $errors;
    }
});
