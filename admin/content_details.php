<?php getHeader(); ?>

<?php getNavbar(); ?>

    <div id="wrapper">

        <?php include('inc/left-menu.php'); ?>
        
        <!-- Content details -->
        <div id="content-details-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">                        
                        
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><?php echo($trl->getText('content_pgdtls_tab1')); ?></a></li>
                            <li role="presentation"><a href="#tab2" data-toggle="tab"><?php echo($trl->getText('content_pgdtls_tab2')); ?></a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                        
                                <h3><?php echo($trl->getText('content_pgdtls_title')); ?></h3>
                                <form action="index.php" id="contentdetails" method="post">
                                    <input type="hidden" value="save_content_details" id="action" name="action"/>
                                    <input type="hidden" value="nl" id="languageid" name="languageid"/>
                                    <input type="hidden" value="1" id="active" name="active"/>
                                    <input type="hidden" value="<?php echo( $currentContent->getid() ); ?>" id="content_id" name="content_id"/>
                                    <label><?php echo($trl->getText('content_dtls_title')); ?></label><br/>
                                    <input type="text" id="content_title" name="content_title" size="80" value="<?php echo($currentContent->getTitle() ); ?>"/><br/>
                                    <label><?php echo($trl->getText('content_dtls_ownid')); ?></label><br/>
                                    <input type="text" id="content_ownid" name="content_ownid" size="40" value="<?php echo($currentContent->getOwnID() ); ?>"/>

                                    <br/><br/>
                                    <label><?php echo($trl->getText('content_dtls__text')); ?></label><br/>
                                    <textarea id="content_data" name="content_data"><?php echo($currentContent->getContent() ); ?></textarea>
                                </form>

                                <div class="button_area">
                                    <a href="#" onclick="document.getElementById('contentdetails').submit();return true;" class = "btn btn-primary" role="button"><?php echo($trl->getText('content_dtls_save')); ?></a>
                                </div>

                                
                            </div> <!-- tab1 -->
                            <div id="tab2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-12">
                               
                                    </div>
                                </div> <!-- 2nd row -->
                            </div> <!-- tab2 -->
                            <div id="tab3" class="tab-pane fade">
                                <h3>Menu 2</h3>
                                <p>Some content in menu 2.</p>
                            </div> <!-- tab3 -->
                        </div> <!-- tab-content -->
                    </div> <!-- /#col-md-12 -->
                </div><!-- /#row -->
            </div> <!-- /#container-fluid -->
        </div><!-- /#content-details-wrapper -->
    </div>
    <!-- /#wrapper -->

<script>
    document.getElementById("content_title").focus();
    tinymce.init({ selector:'#content_data', height:'350px', width:'800px' });
</script>

<?php getFooter();