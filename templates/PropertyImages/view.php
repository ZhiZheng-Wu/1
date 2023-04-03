<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyImage $propertyImage
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Property Image'), ['action' => 'edit', $propertyImage->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Property Image'), ['action' => 'delete', $propertyImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $propertyImage->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Property Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Property Image'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="propertyImages view content">
            <h3><?= h($propertyImage->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Property') ?></th>
                    <td><?= $propertyImage->has('property') ? $this->Html->link($propertyImage->property->id, ['controller' => 'Properties', 'action' => 'view', $propertyImage->property->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= h($propertyImage->image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($propertyImage->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Main') ?></th>
                    <td><?= $propertyImage->main ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
