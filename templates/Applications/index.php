<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Application> $applications
 */
?>
<div class="applications index content">
    <?= $this->Html->link(__('New Application'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Applications') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('tenant_id') ?></th>
                <th><?= $this->Paginator->sort('property_id') ?></th>
                <th><?= $this->Paginator->sort('tenant_hide') ?></th>
                <th><?= $this->Paginator->sort('landlord_hide') ?></th>
                <th><?= $this->Paginator->sort('tenant_cancel') ?></th>
                <th><?= $this->Paginator->sort('landlord_cancel') ?></th>
                <th><?= $this->Paginator->sort('accepted') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($applications as $application): ?>
                <tr>
                    <td><?= $this->Number->format($application->id) ?></td>
                    <td><?= $application->has('tenant') ? $this->Html->link($application->tenant->id, ['controller' => 'Tenants', 'action' => 'view', $application->tenant->id]) : '' ?></td>
                    <td><?= $application->has('property') ? $this->Html->link($application->property->id, ['controller' => 'Properties', 'action' => 'view', $application->property->id]) : '' ?></td>
                    <td><?= h($application->tenant_hide) ?></td>
                    <td><?= h($application->landlord_hide) ?></td>
                    <td><?= h($application->tenant_cancel) ?></td>
                    <td><?= h($application->landlord_cancel) ?></td>
                    <td><?= h($application->accepted) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $application->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $application->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
