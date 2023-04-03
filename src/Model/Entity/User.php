<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
/* Authentication */
use Authentication\PasswordHasher\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property bool $site_access
 * @property string $password
 * @property string $role
 * @property string $phone_number
 * @property string $email
 * @property string $gender
 * @property \Cake\I18n\FrozenDate $date_of_birth
 * @property string $relationship_status
 * @property string $profile_pic
 * @property bool $pet
 * @property bool $children
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property bool $verified
 * @property string|null $verification_notes
 *
 * @property \App\Model\Entity\Property[] $properties
 * @property \App\Model\Entity\Tenant[] $tenants
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'site_access' => true,
        'password' => true,
        'role' => true,
        'phone_number' => true,
        'email' => true,
        'gender' => true,
        'date_of_birth' => true,
        'relationship_status' => true,
        'profile_pic' => true,
        'pet' => true,
        'children' => true,
        'last_updated' => true,
        'verified' => true,
        'verification_notes' => true,
        'properties' => true,
        'tenants' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
    /* Based on I2 code */
    protected function _getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    /* Start Authentication */
    /* Based on authentication tutorial */
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
    /* End Authentication */
}
