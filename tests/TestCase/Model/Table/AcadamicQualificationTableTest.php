<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AcadamicQualificationTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AcadamicQualificationTable Test Case
 */
class AcadamicQualificationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AcadamicQualificationTable
     */
    protected $AcadamicQualification;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.AcadamicQualification',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AcadamicQualification') ? [] : ['className' => AcadamicQualificationTable::class];
        $this->AcadamicQualification = $this->getTableLocator()->get('AcadamicQualification', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->AcadamicQualification);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\AcadamicQualificationTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
