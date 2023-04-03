<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Application $application
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Application'), ['action' => 'edit', $application->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Application'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Applications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Application'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="applications view content">
            <h3><?= h($application->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Tenant') ?></th>
                    <td><?= $application->has('tenant') ? $this->Html->link($application->tenant->id, ['controller' => 'Tenants', 'action' => 'view', $application->tenant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Property') ?></th>
                    <td><?= $application->has('property') ? $this->Html->link($application->property->id, ['controller' => 'Properties', 'action' => 'view', $application->property->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($application->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tenant Hide') ?></th>
                    <td><?= $application->tenant_hide ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Landlord Hide') ?></th>
                    <td><?= $application->landlord_hide ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Tenant Cancel') ?></th>
                    <td><?= $application->tenant_cancel ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Landlord Cancel') ?></th>
                    <td><?= $application->landlord_cancel ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Accepted') ?></th>
                    <td><?= $application->accepted ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
