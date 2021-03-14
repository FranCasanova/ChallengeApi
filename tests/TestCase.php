<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function parseResponse($response) {
    	if( $response->getStatusCode() == 402 ) {
    		echo $response->getContent();
    	}
    	return json_decode($response->content());
    }
}
