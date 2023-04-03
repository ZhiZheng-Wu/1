<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property[]|\Cake\Collection\CollectionInterface $properties
 */

// DataTable JS plugin
//echo $this->Html->css('//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css',['block' => true]);
//echo $this->Html->script('//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js',['block' => true]);
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
    input[type='search'], select {
        width: auto;
        height: auto;
    }

    label {
        font-size: 1em;
    }
</style>
<nav class="top-nav">
    <div class="top-nav-title">
        <a href="<?= $this->Url->build('/') ?> "><?= $this->Html->image('pogo.png') ?></a>
    </div>
    <div class="top-nav-links">
        <?= $this->Html->link(
            '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">add</i></span><span class="text">New Property</span>', ['action' => 'add'], ['escape' => false, 'class' => 'btn btn-success btn-icon-split'])
        ?>

        <?= $this->Html->link(__(
            '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">view_list</i></span>
                 <span class="text">Archives</span>'
        ), ['controller'=>'Properties','action' => 'archives'],['escape' => false, 'class'=>'btn btn-info btn-icon-split']) ?>
    </div>
</nav>
<br>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Properties</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="propertiesTable" class="table table-bordered">
                <thead>
                <tr>
                    <th><?= h('Street Address') ?></th>
                    <th><?= h('Postcode') ?></th>
                    <th><?= h('Bedroom') ?></th>
                    <th><?= h('Bathroom') ?></th>
                    <th><?= h('Bond') ?></th>
                    <th><?= h('Weekly Price') ?></th>
                    <th><?= h('Property Type') ?></th>
                    <!-- <th><?= $this->Paginator->sort('image') ?></th> -->

                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <!-- Removed: ID Suburb, State, Description, Room, Stay Type, Maximum Stay, Minimum Stay, Property Type -->
                </thead>
                <tbody>
                <?php foreach ($properties as $property): ?>
                    <tr>
                        <td><?= h($property->street) ?></td>
                        <td><?= h($property->postcode) ?></td>
                        <td><?= h($property->number_of_bedrooms) ?></td>
                        <td><?= $this->Number->format($property->number_of_bathrooms) ?></td>
                        <td>$<?= $this->Number->format($property->bond) ?></td>
                        <td>$<?= $this->Number->format($property->weekly_rent) ?></td>
                        <!-- Display furnished status instead of 0/1-->
                        <!--
                    <td><?php
                        $furnished = $property->furnished;

                        if ($furnished == 1) {
                            echo '<p style="background-color:green;color:White;width:100%;text-align:center;font-weight:bold;font-style:italic;border-radius:25px;">Yes</p>';
                        } else if ($furnished == 0) {
                            echo '<p style="background-color:red;color:White;width:100%;text-align:center;font-weight:bold;font-style:italic;border-radius:25px;">No</p>';
                        } ?></td>
-->

                        <td><?php
                            if ($property->property_type == 0) {
                                echo $property->property_type = "House";
                            } elseif ($property->property_type == 1) {
                                echo $property->property_type = "Flat";
                            } elseif ($property->property_type == 2) {
                                echo $property->property_type = "Townhouse";
                            } elseif ($property->property_type == 3) {
                                echo $property->property_type = "Apartment";
                            } elseif ($property->property_type == 4) {
                                echo $property->property_type = "Granny Flat";
                            } else
                                echo $property->property_type = "Student Accommodation"
                            ?></td>

                        <!-- <td><?= $this->Html->image($property->placeholder); ?></td> -->


                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $property->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $property->id]) ?>
                            <?php $propertyfull = $property->street . " " . $property->postcode; /* so won't use id */ ?>
<!--                            $this->Form->postLink(__('Delete'), ['action' => 'delete', $property->id], ['confirm' => __('Are you sure you want to delete property: {0}?', $propertyfull)])-->
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#propertiesTable').DataTable();
        });
    </script>
