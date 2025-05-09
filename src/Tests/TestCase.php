<?php
namespace App\Tests;

abstract class TestCase
{
    public function __construct()
    {
        // Base setup for all test cases
    }

    public abstract function run(): array;
    
    protected function assert($condition, $message): array
    {
        if ($condition) {
            return ['status' => 'success', 'message' => $message];
        } else {
            return ['status' => 'failure', 'message' => $message];
        }
    }
    
    protected function assertEquals($expected, $actual, $message): array
    {
        return $this->assert($expected === $actual, $message . " Expected: $expected, Got: $actual");
    }
    
    protected function assertTrue($condition, $message): array
    {
        return $this->assert($condition === true, $message);
    }
    
    protected function assertFalse($condition, $message): array
    {
        return $this->assert($condition === false, $message);
    }
}