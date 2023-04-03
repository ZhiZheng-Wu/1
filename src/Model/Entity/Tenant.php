<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tenant Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $weekly_budget
 * @property \Cake\I18n\FrozenDate $moving_date
 * @property bool $hidden
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Application[] $applications
 */
class Tenant extends Entity
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
        'weekly_budget' => true,
        'moving_date' => true,
        'hidden' => true,
        'user' => true,
        'applications' => true,
    ];
}
