<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\PropertiesTable&\Cake\ORM\Association\HasMany $Properties
 * @property \App\Model\Table\TenantsTable&\Cake\ORM\Association\HasMany $Tenants
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->hasMany('Properties', [
            'foreignKey' => 'user_id',
        ]);
        /* Switch hasMany if it doesn't display any records, as it may've changed the output returned which affects output function usages */
        $this->hasOne('Tenants', [
            'foreignKey' => 'user_id',
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
            ->scalar('first_name')
            ->maxLength('first_name', 64)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 64)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->boolean('site_access')
            ->requirePresence('site_access', 'create')
            ->notEmptyString('site_access');

        $validator
            ->scalar('password')
            ->maxLength('password', 256)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->notEmptyString('role');

        $validator
          ->scalar('phone_number')
          //->maxLength('phone_number', 10)
          ->lengthBetween('phone_number', [10,10], "Phone number should be formatted into 10 continuous [no space] digits")
          ->numeric('phone_number', 'Digits [0-9] only')
          ->requirePresence('phone_number', 'create')
          ->notEmptyString('phone_number');


      $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']); /* Added based on a bake with a unique field*/

        $validator
            ->scalar('gender')
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->date('date_of_birth')
            ->requirePresence('date_of_birth', 'create')
            ->notEmptyDate('date_of_birth');

        $validator
            ->scalar('relationship_status')
            ->requirePresence('relationship_status', 'create')
            ->notEmptyString('relationship_status');
//
//        $validator
//            ->scalar('profile_pic')
//            ->maxLength('profile_pic', 255)
//            ->requirePresence('profile_pic', 'create')
//            ->notEmptyFile('profile_pic');

        $validator
            ->boolean('pet')
            ->requirePresence('pet', 'create')
            ->notEmptyString('pet');

//
//        $validator
//            ->boolean('children')
//            ->requirePresence('children', 'create')
//            ->notEmptyString('children');

        $validator
            ->dateTime('last_updated')
            ->notEmptyDateTime('last_updated');
//
//        $validator
//            ->boolean('verified')
//            ->requirePresence('verified', 'create')
//            ->notEmptyString('verified');

        $validator
            ->scalar('verification_notes')
            ->maxLength('verification_notes', 1024)
            ->allowEmptyString('verification_notes');


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
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);

        return $rules;
    }
}
