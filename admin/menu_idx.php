<?php getHeader(); ?>
    
<?php getNavbar(); ?>

<div id="wrapper">
    <?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'inc/left-menu.php'); ?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo($trl->getText('menu_title')); ?></h2>
                    
                    <div class="button_area">
                        <a href="index.php?action=newmenu" class = "btn btn-primary" role="button"><?php echo($trl->getText('menu_newmenubtn')); ?></a>
                    </div>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th><?php echo($trl->getText('menuidx_tablehdid')); ?></th><th><?php echo($trl->getText('menuidx_tablehdname')); ?></th>
                        </tr>
                        <?php
                        if(is_array($menulist) && count($menulist) > 0 ) {
                            foreach($menulist as $amenu) {
                                echo('</tr><td>');
                                echo( $amenu->getid() );
                                echo('</td><td>');
                                echo('<a href="index.php?action=editmenu&menu_id='.$amenu->getid().'">'.$amenu->getTitle().'</a>' );
                                echo('</td></tr>');
                            }
                        } else {
                            ?>
                            <tr><td colspan="2">
                            <?php echo($trl->getText('menuidx_nopagesfound')); ?>
                            </td></tr>
                        <?php
                        }
                        ?>
                    </table>
                </div> <!-- /#col-md-12 -->
            </div><!-- /#row -->
        </div> <!-- /#container-fluid -->
    </div><!-- /#page-content-wrapper -->
</div> <!-- /#wrapper -->

<?php getFooter(); ?>