<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AcadamicQualificationFixture
 */
class AcadamicQualificationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'acadamic_qualification';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'course' => 'Lorem ipsum dolor sit amet',
                'descricption' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'program' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
