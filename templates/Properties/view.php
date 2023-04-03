<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Property $property
 */
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<h1 class="h3 mb-4 text-gray-800">Property Details</h1>


<div class="row">
    <aside class="column">
        <div class="side-nav" style="padding: 12px">
            <h4 class="heading"><?= __('Actions') ?> </h4>

            <?= $this->Html->link(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">image</i></span>
                            <span class="text">Preview File</span>',

                ['action' => 'view_file', $property->placeholder],
                ['escape' => false, 'class'=>'btn btn-warning btn-icon-split','target' => '_blank'])
            ?>

            <?= $this->Html->link(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">edit</i></span>
                         <span class="text">Edit Property</span>',
                ['action' => 'edit', $property -> id],
                ['escape' => false, 'class'=>'btn btn-primary btn-icon-split'])
            ?>



            <?php $propertyfull = $property->street . ", " . $property->postcode; /* so won't use id */ ?>

<!--            $this->Html->link(-->
<!--                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">delete</i></span>-->
<!--                    <span class="text">Delete Property</span>',-->
<!---->
<!--                ['action' => 'delete', $property->id],-->
<!--                ['escape' => false,  'confirm' => __('Are you sure you want to delete Property: {0}?', $propertyfull), 'class'=>'btn btn-danger btn-icon-split'])-->


            <?= $this->Html->link(
                '<span class="icon text-white-40"><i class="icon-info-blocks material-icons">add</i></span><span class="text">New Property</span>',['action' => 'add'],['escape' => false,'class'=>'btn btn-success btn-icon-split'])
            ?>
        </div>


    </aside>
</div>

<br>


<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Property Address</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->street) ?>, <?= h($property->suburb)?>, <?= h($property->postcode)?>, <?= h($property->state)?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Street</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->street) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Suburb</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->suburb) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            State</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->state) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Postcode</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->postcode) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Property Type</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <td><?php
                                if($property->property_type == 0) {
                                    echo $property -> property_type = "House";
                                } elseif ($property->property_type == 1) {
                                    echo $property -> property_type = "Flat";
                                } elseif ($property->property_type == 2) {
                                    echo $property -> property_type = "Townhouse";
                                } elseif ($property->property_type == 3) {
                                    echo $property -> property_type = "Apartment";
                                } elseif ($property->property_type == 4) {
                                    echo $property -> property_type = "Granny Flat";
                                } else
                                    echo $property -> property_type = "Student Accommodation"
                                ?></td></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Description</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->long_description) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Bond</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><td>$<?= $this->Number->format($property->bond) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Number of Bedrooms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->number_of_bedrooms) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Number of Bathrooms</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->number_of_bathrooms) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Resident Limit</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->residency_limit) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Minimum Stay</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->min_stay) ?> months </div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Maximum Stay</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= h($property->max_stay) ?> months </div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Parking</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ucfirst(h($property->parking)) ?></div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Price</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> $<?= h($property->weekly_rent) ?> per week</div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
