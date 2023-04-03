<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Properties Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ApplicationsTable&\Cake\ORM\Association\HasMany $Applications
 *
 * @method \App\Model\Entity\Property newEmptyEntity()
 * @method \App\Model\Entity\Property newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Property[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Property get($primaryKey, $options = [])
 * @method \App\Model\Entity\Property findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Property patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Property[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Property|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Property[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PropertiesTable extends Table
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

        $this->setTable('properties');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Applications', [
            'foreignKey' => 'property_id',
        ]);
        $this->hasMany('PropertyImages', [
            'foreignKey' => 'property_id',
        ]);
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
            ->nonNegativeInteger('user_id')
            ->requirePresence('user_id', 'create')
            ->notEmptyString('user_id');

        $validator
            ->scalar('street')
            ->maxLength('street', 64)
            ->requirePresence('street', 'create')
            ->notEmptyString('street');

        $validator
            ->scalar('suburb')
            ->maxLength('suburb', 64)
            ->requirePresence('suburb', 'create')
            ->notEmptyString('suburb');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 4)
            ->requirePresence('postcode', 'create')
            ->notEmptyString('postcode');

        $validator
            ->scalar('state')
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

//        $validator
//            ->scalar('short_description')
//            ->maxLength('short_description', 64)
//            ->requirePresence('short_description', 'create')
//            ->notEmptyString('short_description');

        $validator
            ->scalar('long_description')
            ->maxLength('long_description', 512)
            ->requirePresence('long_description', 'create')
            ->notEmptyString('long_description');

        $validator
            ->nonNegativeInteger('number_of_bedrooms')
            ->requirePresence('number_of_bedrooms', 'create')
            ->notEmptyString('number_of_bedrooms');

        $validator
            ->nonNegativeInteger('number_of_bathrooms')
            ->requirePresence('number_of_bathrooms', 'create')
            ->notEmptyString('number_of_bathrooms');

        $validator
            ->nonNegativeInteger('bond')
            ->requirePresence('bond', 'create')
            ->notEmptyString('bond');

        $validator
            ->nonNegativeInteger('weekly_rent')
            ->requirePresence('weekly_rent', 'create')
            ->notEmptyString('weekly_rent');

        $validator
            ->scalar('property_type')
            ->requirePresence('property_type', 'create')
            ->notEmptyString('property_type');

        $validator
            ->nonNegativeInteger('building_size')
            ->requirePresence('building_size', 'create')
            ->notEmptyString('building_size');

        $validator
            ->nonNegativeInteger('property_size')
            ->requirePresence('property_size', 'create')
            ->notEmptyString('property_size');

        $validator
            ->boolean('available')
            ->requirePresence('available', 'create')
            ->notEmptyString('available');

        $validator
            ->nonNegativeInteger('residency_limit')
            ->requirePresence('residency_limit', 'create')
            ->notEmptyString('residency_limit');

        $validator
            ->nonNegativeInteger('max_stay')
            ->requirePresence('max_stay', 'create')
            ->notEmptyString('max_stay');

        $validator
            ->integer('min_stay')
            ->requirePresence('min_stay', 'create')
            ->notEmptyString('min_stay');

        $validator
            ->scalar('parking')
            ->requirePresence('parking', 'create')
            ->notEmptyString('parking');

        $validator
            ->boolean('women_only')
            ->requirePresence('women_only', 'create')
            ->notEmptyString('women_only');

        $validator
            ->boolean('landlord_resident')
            ->requirePresence('landlord_resident', 'create')
            ->notEmptyString('landlord_resident');

        $validator
            ->scalar('placeholder')
            ->maxLength('placeholder', 255)
            ->allowEmptyString('placeholder');

        $validator
            ->dateTime('last_updated')
            ->notEmptyDateTime('last_updated');


        $validator
            ->allowEmptyFile('image')
            ->add('image',[
                'mimeType'=>[
                    'rule'=>['mimeType',['image/jpg','image/png','image/jpeg']],
                        'message'=>'Please Upload only jpg and png.',
                    ],
                'filesize'=>[
                    'rule'=>['filesize','<=','10MB'],
                    'message'=>'Image file must be less than 10 MB.',
                ],
    ]);
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
