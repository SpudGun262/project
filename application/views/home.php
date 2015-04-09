<script src="<?php echo asset_url().'js/parallax.js'; ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/heroBanner.css'; ?>" />
<div class="row">
    <?php

    //flashdata used to display logout message
    echo $this->session->flashdata('logout');

    //flashdata message which displays when a new account is created
    echo $this->session->flashdata('welcome');

    ?>
</div>
<div class="heroBanner hide-for-small">
    <div class="largeLogo"><img src="<?php echo asset_url().'images/logo.png'; ?>"></div>
    <div class="bg-element01"></div>
    <div class="bg-element02"></div>
    <div class="fg-element01"></div>
    <div class="foreground"></div>
</div>

<div class="row">

    <?php

    //flashdata used to display logout message
    echo $this->session->flashdata('logout');

    //flashdata message which displays when a new account is created
    echo $this->session->flashdata('welcome');

    ?>

    <h1>This is the homepage</h1>

</div>
