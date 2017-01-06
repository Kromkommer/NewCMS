        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo( getCMSHostName() ); ?>/js/jquery-3.0.0.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo( getCMSHostName() ); ?>/vendor/bootstrap/js/bootstrap.min.js"></script>

            <!-- Menu Toggle Script -->
        <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        </script>
    </body>
</html>