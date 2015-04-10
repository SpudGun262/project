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

                <ul class="off-canvas-list show-for-small-only">
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
                <p class="show-for-small-only">ᕦ(ò_óˇ)ᕤ</p>
            </div>

    </div>

</div><!-- End Main -->

    <div id="mobileFooter" class="show-for-small-only">
        <div id="mobileLogo">
            <a class="logo" href="<?=base_url();?>">Project Bazaar</a>
        </div>
        <div class="mobileMenu" id="mobileMenuButton">
            <a><i class="fa fa-bars fa-fw"></i>&nbsp;Menu</a>
        </div>
    </div>

    <nav id="mobileNav">
        <ul id="mobileNavSub">
            <li><a href="<?=base_url('home')?>"><i class="fa fa-home fa-fw"></i>&nbsp;Home</a></li>
            <?php
            $CI =& get_instance();
            if (!$CI->session->userdata('user_auth')) {

                echo '<li><a href="' . base_url('login') . '"><i class="fa fa-sign-in fa-fw"></i>&nbsp;Login</a></li>';
                echo '<li class="last"><a href="' . base_url('user') . '"><i class="fa fa-plus-square fa-fw"></i>&nbsp;Join</a></li>';

            } else {

                echo '<li><a href="' . base_url('user/profile') . '"><i class="fa fa-user fa-fw"></i>&nbsp;Profile</a></li>';
                echo '<li><a href="' . base_url('login/logout') . '"><i class="fa fa-sign-out fa-fw"></i>&nbsp;Logout</a></li>';

            }
            ?>
        </ul>
        <ul id="mobileNavMain">
            <li><a href="<?=base_url('about')?>"><i class="fa fa-info-circle fa-fw fa-2x"></i>About</a></li>
            <li><a href="<?=base_url('projects')?>"><i class="fa fa-graduation-cap fa-fw fa-2x"></i>Projects</a></li>
            <li><a href="<?=base_url('proposals')?>"><i class="fa fa-key fa-fw fa-2x"></i>Proposals</a></li>
            <li><a href="<?=base_url('research')?>"><i class="fa fa-desktop fa-fw fa-2x"></i>Research</a></li>
        </ul>

    </nav>

<script src="<?php echo base_url('/assets/js/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/foundation.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/navMenu.js'); ?>"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>