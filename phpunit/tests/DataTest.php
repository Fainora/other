<?php
use PHPUnit\Framework\TestCase;

require 'CsvFileIterator.php';

class DataTest extends TestCase
{
    // Зависимости
    /**
     * @dataProvider additionProvider
     * @dataProvider additionWithNonNegativeNumbersProvider
     * @dataProvider additionWithNegativeNumbersProvider
     */
    public function testAdd($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
        //$this->assertSame($expected, $a + $b);
    }

    public function additionProvider()
    {
        // return [
        //     'adding zeros'  => [0, 0, 0],
        //     'zero plus one' => [0, 1, 1],
        //     'one plus zero' => [1, 0, 1],
        //     'one plus one'  => [1, 1, 3]
        // ];
        return new CsvFileIterator('data.csv');
    }

    public function additionWithNonNegativeNumbersProvider()
      {
          return [
              [0, 1, 1],
              [1, 0, 1],
              [1, 1, 3]
          ];
      }

      public function additionWithNegativeNumbersProvider()
      {
          return [
              [-1, 1, 0],
              [-1, -1, -2],
              [1, -1, 0]
          ];
      }
}