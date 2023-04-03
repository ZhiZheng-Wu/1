<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tenant $tenant
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Tenant'), ['action' => 'edit', $tenant->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tenant'), ['action' => 'delete', $tenant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenant->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tenants'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tenant'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tenants view content">
            <h3><?= h($tenant->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $tenant->has('user') ? $this->Html->link($tenant->user->id, ['controller' => 'Users', 'action' => 'view', $tenant->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($tenant->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weekly Budget') ?></th>
                    <td><?= $this->Number->format($tenant->weekly_budget) ?></td>
                </tr>
                <tr>
                    <th><?= __('Moving Date') ?></th>
                    <td><?= h($tenant->moving_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Hidden') ?></th>
                    <td><?= $tenant->hidden ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Applications') ?></h4>
                <?php if (!empty($tenant->applications)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Tenant Id') ?></th>
                            <th><?= __('Property Id') ?></th>
                            <th><?= __('Tenant Hide') ?></th>
                            <th><?= __('Landlord Hide') ?></th>
                            <th><?= __('Tenant Cancel') ?></th>
                            <th><?= __('Landlord Cancel') ?></th>
                            <th><?= __('Accepted') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($tenant->applications as $applications) : ?>
                        <tr>
                            <td><?= h($applications->id) ?></td>
                            <td><?= h($applications->tenant_id) ?></td>
                            <td><?= h($applications->property_id) ?></td>
                            <td><?= h($applications->tenant_hide) ?></td>
                            <td><?= h($applications->landlord_hide) ?></td>
                            <td><?= h($applications->tenant_cancel) ?></td>
                            <td><?= h($applications->landlord_cancel) ?></td>
                            <td><?= h($applications->accepted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Applications', 'action' => 'view', $applications->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Applications', 'action' => 'edit', $applications->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Applications', 'action' => 'delete', $applications->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applications->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
