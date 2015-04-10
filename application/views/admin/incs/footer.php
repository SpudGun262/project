<div class="footer">
    <div class="row">
        <nav role="navigation">

            <ul class="hide-for-small column">
                <li><a href="<?=base_url('home')?>"><i class="fa fa-home fa-fw"></i>&nbsp; Home</a></li>
                <li><a href="<?=base_url('about')?>"><i class="fa fa-info-circle fa-fw"></i>&nbsp; About</a></li>
                <li><a href="<?=base_url('projects')?>"><i class="fa fa-graduation-cap fa-fw"></i>&nbsp; Projects</a></li>
                <li><a href="<?=base_url('proposals')?>"><i class="fa fa-key fa-fw"></i>&nbsp; Proposals</a></li>
                <li><a href="<?=base_url('research')?>"><i class="fa fa-desktop fa-fw"></i>&nbsp; Research</a></li>
            </ul>

        </nav>
    </div>

    <div class="row text-center">
        <p>Designed and developed by Tom Walker 2015<br/>
            <a href="https://twitter.com/tomwalker262">@tomwalker</a>
        </p>
        <p class="show-for-medium-up">Created for <span class="edgeHill"><a href="http://www.edgehill.ac.uk/">Edge Hill University</a></span></p>
    </div>

</div>

<script src="<?php echo asset_url().'js/fastclick.js'; ?>"></script>
<script src="<?php echo asset_url().'js/foundation.min.js'; ?>"></script>
<script>
    $(document).foundation();
</script>

</body>
</html>