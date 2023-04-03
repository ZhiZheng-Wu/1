<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity
 *
 * @property int $id
 * @property int $tenant_id
 * @property int $property_id
 * @property bool $tenant_hide
 * @property bool $landlord_hide
 * @property bool $tenant_cancel
 * @property bool $landlord_cancel
 * @property bool $accepted
 *
 * @property \App\Model\Entity\Tenant $tenant
 * @property \App\Model\Entity\Property $property
 */
class Application extends Entity
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
        'tenant_id' => true,
        'property_id' => true,
        'tenant_hide' => true,
        'landlord_hide' => true,
        'tenant_cancel' => true,
        'landlord_cancel' => true,
        'accepted' => true,
        'tenant' => true,
        'property' => true,
    ];
}
