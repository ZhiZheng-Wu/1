<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyImage[]|\Cake\Collection\CollectionInterface $propertyImages
 */
?>
<div class="propertyImages index content">
    <?= $this->Html->link(__('New Property Image'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Property Images') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('property_id') ?></th>
                    <th><?= $this->Paginator->sort('image') ?></th>
                    <th><?= $this->Paginator->sort('main') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($propertyImages as $propertyImage): ?>
                <tr>
                    <td><?= $this->Number->format($propertyImage->id) ?></td>
                    <td><?= $propertyImage->has('property') ? $this->Html->link($propertyImage->property->id, ['controller' => 'Properties', 'action' => 'view', $propertyImage->property->id]) : '' ?></td>
                    <td><?= h($propertyImage->image) ?></td>
                    <td><?= h($propertyImage->main) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $propertyImage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $propertyImage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $propertyImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyImage->id)]) ?>
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
