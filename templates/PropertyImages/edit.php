<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PropertyImage $propertyImage
 * @var string[]|\Cake\Collection\CollectionInterface $properties
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $propertyImage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $propertyImage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Property Images'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="propertyImages form content">
            <?= $this->Form->create($propertyImage) ?>
            <fieldset>
                <legend><?= __('Edit Property Image') ?></legend>
                <?php
                    echo $this->Form->control('property_id', ['options' => $properties]);
                    echo $this->Form->control('image');
                    echo $this->Form->control('main');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
