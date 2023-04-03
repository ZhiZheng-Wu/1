<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PropertyImage Entity
 *
 * @property int $id
 * @property int $property_id
 * @property string $image
 * @property bool $main
 *
 * @property \App\Model\Entity\Property $property
 */
class PropertyImage extends Entity
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
        'property_id' => true,
        'image' => true,
        'main' => true,
        'property' => true,
    ];
}
