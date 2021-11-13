<?php
namespace Live\Collection;

use PHPUnit\Framework\TestCase;

class FileCollectionTest extends TestCase
{
    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function objectCanBeConstructed()
    {
        $collection = new FileCollection();
        return $collection;
    }

    /**
    * @test
    * @depends objectCanBeConstructed
    */
    public function dataCanBeSaved()
    {
        $collection = new FileCollection('data_saved.txt');
        $collection->set('data', 'value');
        $this->assertTrue( $collection->write());
    }
    
    /**
     * @test
     * @depends dataCanBeSaved
     */
    public function dataCanBeRead()
    {
        $collection = new FileCollection();
        
        $collection->set('data', 'value');
        $collection->write();
        $this->assertGreaterThan(0, count($collection->read()));
    }
}
