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

<section id="mainContent">
    <div class="row text-center">
        <h2>Helping you understand computing projects</h2>
        <h6 class="subheader">Project Bazaar is a repository of computing projects and dissertations.</h6>
    </div>

    <div class="row text-center" id="infoSection" data-equalizer>

        <div class="large-4 columns">
            <img src="<?php echo asset_url().'images/learn.png'; ?>" />
            <h3>Projects</h3>
            <p data-equalizer-watch>Learn what it is needed to undertake a computing project and dissertation. Browse a selection of projects and dissertations from your course and other to gain a greater understanding.</p>
            <a class="button success" href="<?=base_url('projects')?>">View Projects</a>
            <hr class="hidden-for-medium-up"/>
        </div>


        <div class="large-4 columns">
            <img src="<?php echo asset_url().'images/proposals.png'; ?>" />
            <h3>Proposals</h3>
            <p data-equalizer-watch>Stuck for project ideas? Tutors use Project Bazaar to post potential projects they hope students will explore. These proposals can help you see what is expected in a project and even give you ideas for your own.</p>
            <a class="button success" href="<?=base_url('proposals')?>">View Proposals</a>
            <hr class="hidden-for-medium-up"/>
        </div>

        <div class="large-4 columns">
            <img src="<?php echo asset_url().'images/research.png'; ?>" />
            <h3>Research</h3>
            <p data-equalizer-watch>Have a project or dissertation idea of your own and want to know which tutor will be the best supervisor for you? No problem! Browse tutor research interests to find out.</p>
            <a class="button success" href="<?=base_url('research')?>">View Research Interests</a>
            <hr class="hidden-for-medium-up"/>
        </div>


    </div>

</section>