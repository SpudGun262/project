<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Bazaar</title>

    <link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/foundation.min.css'; ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url().'css/normalize.css'; ?>" />

    <script src="<?php echo asset_url().'js/modernizr.js'; ?>"></script>
</head>
<body>

<p>Header</p>

<ul>
    <li><?='<a href="' . base_url('admin/dashboard') . '">Dashboard</a>'?></li>
    <li><?='<a href="' . base_url('admin/projects') . '">Projects</a>'?></li>
    <li><?='<a href="' . base_url('admin/proposals') . '">Proposals</a>'?></li>
    <li><?='<a href="' . base_url('admin/login/logout') . '"id="logout">Logout</a>'?></li>
</ul>