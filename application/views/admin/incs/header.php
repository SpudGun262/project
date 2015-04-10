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

<div id="mainHeader">
    <nav class="top-bar show-for-medium-up" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1 class="logo"><a href="<?=base_url('admin/dashboard');?>">Project Bazaar</a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li><a href="<?=base_url('admin/dashboard');?>">Dashboard</a></li>
                <li><a href="<?=base_url('admin/projects');?>">Projects</a></li>
                <li><a href="<?=base_url('admin/proposals');?>">Proposals</a></li>
                <li><a href="<?=base_url('admin/tutors');?>">Tutors</a></li>
                <li><a href="<?=base_url('admin/courses');?>">Courses</a></li>
                <li><a href="<?=base_url('admin/login/logout');?>" id="logout">Logout</a></li>
            </ul>
        </section>
    </nav>
</div>