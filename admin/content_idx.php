<?php getHeader(); ?>
    
<?php getNavbar(); ?>

<div id="wrapper">
    <?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'inc/left-menu.php'); ?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo($trl->getText('content_title')); ?></h2>
                    
                    <div class="button_area">
                        <a href="index.php?action=newcontent" class = "btn btn-primary" role="button"><?php echo($trl->getText('content_newcontentbtn')); ?></a>
                    </div>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th><?php echo($trl->getText('contentidx_tablehdid')); ?></th><th><?php echo($trl->getText('contentidx_tablehdname')); ?></th>
                        </tr>
                        <?php
                        if(is_array($contentlist) && count($contentlist) > 0 ) {
                            foreach($contentlist as $content) {
                                echo('</tr><td>');
                                echo( $content->getid() );
                                echo('</td><td>');
                                echo('<a href="index.php?action=editcontent&content_id='.$content->getid().'">'.$content->getTitle().'</a>' );
                                echo('</td></tr>');
                            }
                        } else {
                            ?>
                            <tr><td colspan="2">
                            <?php echo($trl->getText('contentidx_nopagesfound')); ?>
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