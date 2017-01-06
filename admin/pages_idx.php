<?php getHeader(); ?>
    
<?php getNavbar(); ?>

<div id="wrapper">
    <?php include(ROOT_DIR.DIRECTORY_SEPARATOR.'inc/left-menu.php'); ?>
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo($trl->getText('page_title')); ?></h2>
                    
                    <div class="button_area">
                        <a href="index.php?action=newpage" class = "btn btn-primary" role="button"><?php echo($trl->getText('page_newpagebtn')); ?></a>
                    </div>
                    
                    <table class="table table-bordered">
                        <tr>
                            <th><?php echo($trl->getText('pageidx_tablehdid')); ?></th>
                            <th><?php echo($trl->getText('pageidx_tablehdname')); ?></th>
                            <th><?php echo($trl->getText('pageidx_tablehdactive')); ?></th>
                            <th><?php echo($trl->getText('pageidx_tablehdchangedon')); ?></th>
                        </tr>
                        <?php
                        if(is_array($pagelist) && count($pagelist) > 0 ) {
                            foreach($pagelist as $page) {                                
                                echo('</tr><td>');
                                echo( $page->getid() );
                                echo('</td><td>');
                                echo('<a href="index.php?action=editpage&page_id='.$page->getid().'">'.$page->getTitle().'</a>' );
                                echo('</td><td>');
                                echo($page->getActive() );
                                echo('</td><td>');
                                echo($page->getChangedOn() );
                                echo('</td></tr>');
                            }
                        } else {
                            ?>
                            <tr><td colspan="2">
                            <?php echo($trl->getText('pageidx_nopagesfound')); ?>
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