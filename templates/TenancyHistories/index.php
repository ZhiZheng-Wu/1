<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\TenancyHistory> $tenancyHistories
 */
?>
<div class="tenancyHistories index content">
    <?= $this->Html->link(__('New Tenancy History'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tenancy Histories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('tenant_id') ?></th>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('file') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tenancyHistories as $tenancyHistory): ?>
                <tr>
                    <td><?= $this->Number->format($tenancyHistory->id) ?></td>
                    <td><?= $tenancyHistory->has('tenant') ? $this->Html->link($tenancyHistory->tenant->id, ['controller' => 'Tenants', 'action' => 'view', $tenancyHistory->tenant->id]) : '' ?></td>
                    <td><?= h($tenancyHistory->category) ?></td>
                    <td><?= h($tenancyHistory->file) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tenancyHistory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tenancyHistory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tenancyHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tenancyHistory->id)]) ?>
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
