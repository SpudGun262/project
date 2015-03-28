footer

<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.2.js"></script>
<script src="<?php echo asset_url().'js/fastclick.js'; ?>"></script>
<script src="<?php echo asset_url().'js/foundation.min.js'; ?>"></script>
<script>
    $(document).foundation();
</script>
<script>
    $('a.close').on('click', function() {
        $('div.reveal-modal').foundation('reveal', 'close');
    });
</script>

</body>
</html>