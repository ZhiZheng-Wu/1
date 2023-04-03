<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TenancyHistory Entity
 *
 * @property int $id
 * @property int $tenant_id
 * @property string $category
 * @property string $document
 *
 * @property \App\Model\Entity\Tenant $tenant
 */
class TenancyHistory extends Entity
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
        'category' => true,
        'document' => true,
        'tenant' => true,
    ];
}
