<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AcadamicQualification Model
 *
 * @method \App\Model\Entity\AcadamicQualification newEmptyEntity()
 * @method \App\Model\Entity\AcadamicQualification newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\AcadamicQualification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AcadamicQualification get($primaryKey, $options = [])
 * @method \App\Model\Entity\AcadamicQualification findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\AcadamicQualification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AcadamicQualification[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\AcadamicQualification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AcadamicQualification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AcadamicQualification[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AcadamicQualification[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\AcadamicQualification[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\AcadamicQualification[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AcadamicQualificationTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('acadamic_qualification');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('course')
            ->maxLength('course', 220)
            ->requirePresence('course', 'create')
            ->notEmptyString('course');

        $validator
            ->scalar('descricption')
            ->requirePresence('descricption', 'create')
            ->notEmptyString('descricption');

        $validator
            ->scalar('program')
            ->maxLength('program', 220)
            ->requirePresence('program', 'create')
            ->notEmptyString('program');

        return $validator;
    }
}
