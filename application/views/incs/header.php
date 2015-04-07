<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Bazaar</title>



    <link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/foundation.css'; ?>" />
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.6/integration/foundation/dataTables.foundation.css"/>
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo asset_url().'css/normalize.css'; ?><!--" />-->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--    TODO: Edit the standard foundation.css and then minify it yourself becasue it looks like some styles are missing from the min version-->

    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.2.js"></script>
    <script src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.6/integration/foundation/dataTables.foundation.js"></script>
    <script src="<?php echo asset_url().'js/modernizr.js'; ?>"></script>
</head>
<body>

<p>Header</p>

<ul>
    <li><a href="<?=base_url('home')?>"><i class="fa fa-home fa-fw"></i>&nbsp; Home</a></li>
    <li><a href="<?=base_url('about')?>"><i class="fa fa-info-circle fa-fw"></i>&nbsp; About</a></li>
    <li><a href="<?=base_url('projects')?>"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp; Projects</a></li>
    <li><a href="<?=base_url('proposals')?>"><i class="fa fa-key fa-fw"></i>&nbsp; Proposals</a></li>
</ul>

<?php

    $CI =& get_instance();
    if (!$CI->session->userdata('user_auth')) {

        echo '<p><a href="' . base_url('login') . '">Login</a></p>';
        echo '<p><a href="' . base_url('user') . '" id="sign-up">Create An Account</a></p>';

    } else {

        $time = date('H:i:s');

        if ($time >= '06:00:00' && $time <= '11:59:59') {
            echo '<p>Morning ' . $this->session->userdata('user_auth')['first_name'] . '</p>';

        } elseif ($time > '12:00:00' && $time <= '17:59:59') {

            echo '<p>Afternoon ' . $this->session->userdata('user_auth')['first_name'] . '</p>';

        } elseif ($time > '18:00:00' && $time <= '23:59:59') {

            echo '<p>Evening ' . $this->session->userdata('user_auth')['first_name'] . '</p>';

        } elseif ($time > '00:00:00' && $time <= '05:59:59') {

            echo '<p>Wow you\'re up late! Or is this early for you ' . $this->session->userdata('user_auth')['first_name'] . '?</p>';

        }

        echo '<p><a href="' . base_url('user/profile') . '" id="profile"><i class="fa fa-user fa-fw"></i>&nbsp;Profile</a></p>';
        echo '<p><a href="' . base_url('login/logout') . '" id="logout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a></p>';

    }

?>

