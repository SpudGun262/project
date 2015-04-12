<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>Project Bazaar</title>

    <link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/foundation.css'; ?>" />
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.6/integration/foundation/dataTables.foundation.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/normalize.css'; ?>" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--    TODO: Edit the standard foundation.css and then minify it yourself becasue it looks like some styles are missing from the min version-->

    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.2.js"></script>
    <script src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.6/integration/foundation/dataTables.foundation.js"></script>
    <script src="<?php echo asset_url().'js/modernizr.js'; ?>"></script>
</head>
<body>

<div id="main">


    <div id="mainHeader" class="fixed">
        <nav class="top-bar show-for-medium-up" data-topbar role="navigation">
            <ul class="title-area">
                <li class="name">
                    <h1 class="logo"><a href="<?=base_url();?>">Project Bazaar</a></h1>
                </li>
            </ul>

            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li><a href="<?=base_url('home')?>"><i class="fa fa-home fa-fw"></i>&nbsp; Home</a></li>
                    <li><a href="<?=base_url('about')?>"><i class="fa fa-info-circle fa-fw"></i>&nbsp; About</a></li>
                    <li><a href="<?=base_url('projects')?>"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp; Projects</a></li>
                    <li><a href="<?=base_url('proposals')?>"><i class="fa fa-key fa-fw"></i>&nbsp; Proposals</a></li>
                    <li><a href="<?=base_url('research')?>"><i class="fa fa-desktop fa-fw"></i>&nbsp; Research</a></li>
                    <?php

                    $CI =& get_instance();
                    if (!$CI->session->userdata('user_auth')) {

                        echo '<li class="has-form"><a href="' . base_url('login') . '" class="button secondary"><i class="fa fa-sign-in fa-fw"></i>&nbsp;Login</a></li>';
                        echo '<li class="has-form"><a href="' . base_url('user') . '" class="button success"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Create An Account</a></li>';

                    } else {

                        echo '<li class="has-form"><a href="' . base_url('user/profile') . '" class="button"><i class="fa fa-user fa-fw"></i>&nbsp;Profile</a></li>';
                        echo '<li class="has-form"><a href="' . base_url('login/logout') . '" class="button secondary" ><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a></li>';

                    }
                    ?>
                </ul>

                    <?php

                    if ($CI->session->userdata('user_auth')) {

                        $time = date('H:i:s');

                        echo '<ul class="left">';

                        if ($time >= '06:00:00' && $time <= '11:59:59') {
                            echo '<li><a>Morning ' . $this->session->userdata('user_auth')['first_name'] . '</a></li>';

                        } elseif ($time > '12:00:00' && $time <= '17:59:59') {

                            echo '<li><a>Afternoon ' . $this->session->userdata('user_auth')['first_name'] . '</a></li>';

                        } elseif ($time > '18:00:00' && $time <= '23:59:59') {

                            echo '<li><a>Evening ' . $this->session->userdata('user_auth')['first_name'] . '</a></li>';

                        } elseif ($time > '00:00:00' && $time <= '05:59:59') {

                            echo '<li><a>Wow you\'re up late! Or is this early for you ' . $this->session->userdata('user_auth')['first_name'] . '?</a></li>';

                        }

                        echo '</ul>';
                    }
                    ?>

            </section>
        </nav>
    </div>


