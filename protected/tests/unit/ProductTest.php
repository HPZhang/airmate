<?php
/**
 * Test class for Product.
 * Generated by PHPUnit on 2012-05-11 at 15:21:19.
 */
class ProductTest extends CTestCase
{
    /**
     * @var Product
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Product;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testModel().
     */
    public function testModel()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testTableName().
     */
    public function testTableName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRules().
     */
    public function testRules()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testRelations().
     */
    public function testRelations()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testAttributeLabels().
     */
    public function testAttributeLabels()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * @todo Implement testSearch().
     */
    public function testSearch()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    public function testRandomInsert()
    {
        for($i = 1; $i <= 100; $i++)
        {
            $product = new Product();
            $product->id_product = $i;
            $product->mark = 1;
            $product->insert();
        }
        for($i = 101; $i <= 500; $i++)
        {
            $product = new Product();
            $product->id_product = $i;
            $product->mark = 2;
            $product->insert();
        }
    }
}
?>
