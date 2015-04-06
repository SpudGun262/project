<!--<header class="bird-box">-->
<!--    <div class="logo"><img src="--><?php //echo asset_url().'images/logo.png'; ?><!--"></div>-->
<!--    <div class="back-bird"></div>-->
<!--    <div class="fore-bird"></div>-->
<!--</header>-->

<div class="row">

    <?php

    //flashdata used to display logout message
    echo $this->session->flashdata('logout');

    //flashdata message which displays when a new account is created
    echo $this->session->flashdata('welcome');

    ?>

    <h1>This is the homepage</h1>

</div>

<style>
/*    img {*/
/*        max-width: 100%; }*/
/**/
/*    .bird-box {*/
/*        position: relative;*/
/*        height: 600px;*/
/*        background-image: url(*/<?php //echo asset_url().'images/background.jpg'; ?>/*);*/
/*        background-size: auto 600px;*/
/*        background-position: top center;*/
/*        background-attachment: fixed;*/
/*        overflow: hidden; }*/
/**/
/*    .logo {*/
/*        height: 100px;*/
/*        width: 100%;*/
/*        position: absolute;*/
/*        top: 50%;*/
/*        margin-top: -50px;*/
/*        text-align: center; }*/
/**/
/*    .fore-bird {*/
/*        width: 100%;*/
/*        height: 752px;*/
/*        background-image: url(*/<?php //echo asset_url().'images/foreground.png'; ?>/*);*/
/*        background-repeat: no-repeat;*/
/*        background-position: right bottom;*/
/*        position: absolute;*/
/*        top: -40px; }*/
/**/
/*    .back-bird {*/
/*        width: 960px;*/
/*        height: 298px;*/
/*        background-image: url(*/<?php //echo asset_url().'images/fg-element01.png'; ?>/*);*/
/*        background-repeat: no-repeat;*/
/*        background-position: top left;*/
/*        position: absolute;*/
/*        left: 50%;*/
/*        margin-left: -480px; }*/

</style>

<script src="<?php echo asset_url().'js/parallax.js'; ?>"></script>