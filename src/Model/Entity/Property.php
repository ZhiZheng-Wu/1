<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Property Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $street
 * @property string $suburb
 * @property string $postcode
 * @property string $state
 * @property string $short_description
 * @property string $long_description
 * @property int $number_of_bedrooms
 * @property int $number_of_bathrooms
 * @property int $bond
 * @property int $weekly_rent
 * @property string $property_type
 * @property int $building_size
 * @property int $property_size
 * @property bool $available
 * @property int $residency_limit
 * @property int $max_stay
 * @property int $min_stay
 * @property string $parking
 * @property bool $women_only
 * @property bool $landlord_resident
 * @property string|null $placeholder
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property string|null $image
 * 
 
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Application[] $applications
 */
class Property extends Entity
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
        'user_id' => true,
        'street' => true,
        'suburb' => true,
        'postcode' => true,
        'state' => true,
        'short_description' => true,
        'long_description' => true,
        'number_of_bedrooms' => true,
        'number_of_bathrooms' => true,
        'bond' => true,
        'weekly_rent' => true,
        'property_type' => true,
        'building_size' => true,
        'property_size' => true,
        'available' => true,
        'residency_limit' => true,
        'max_stay' => true,
        'min_stay' => true,
        'parking' => true,
        'women_only' => true,
        'landlord_resident' => true,
        'placeholder' => true,
        'last_updated' => true,           
        'image' => true,
        'user' => true,
        'applications' => true
    ];
}
