<?php getHeader(); ?>

<?php getNavbar(); ?>

    <div id="wrapper">

        <?php include('inc/left-menu.php'); ?>
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">                        
                        
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="active"><a href="#tab1" data-toggle="tab"><?php echo($trl->getText('page_pgdtls_tab1')); ?></a></li>
                            <li role="presentation"><a href="#tab2" data-toggle="tab"><?php echo($trl->getText('page_pgdtls_tab2')); ?></a></li>
                            <li role="presentation"><a href="#tab3" data-toggle="tab"><?php echo($trl->getText('page_pgdtls_tab3')); ?></a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div id="tab1" class="tab-pane fade in active">
                        
                                <h3><?php echo($trl->getText('page_pgdtls_title')); ?></h3>
                                <form action="index.php" id="pagedetails" method="post">
                                    <input type="hidden" value="save_page_details" id="action" name="action"/>
                                    <input type="hidden" value="<?php echo( $currentPage->getid() ); ?>" id="page_id" name="page_id"/>
                                    <label><?php echo($trl->getText('page_pgdtls_page_title')); ?></label><br/>
                                    <input type="text" id="page_title" name="page_title" size="80" value="<?php echo($currentPage->getTitle() ); ?>"/><br/>
                                    <label><?php echo($trl->getText('page_pgdtls_page_url')); ?></label><br/>
                                    <input type="text" id="page_url" name="page_url" size="160" value="<?php echo($currentPage->getURL() ); ?>"/>

                                    <br/><br/>
                                    <label><?php echo($trl->getText('page_pgdtls_content_text')); ?></label><br/>
                                    <textarea id="page_content" name="page_content"><?php echo($currentPage->getContent() ); ?></textarea>
                                </form>

                                <div class="button_area">
                                    <a href="#" onclick="document.getElementById('pagedetails').submit();return true;" class = "btn btn-primary" role="button"><?php echo($trl->getText('page_pgdtls_save')); ?></a>
                                </div>

                                
                            </div> <!-- tab1 -->
                            <div id="tab2" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-md-4">
                                        Current content blocks
                                        <?php 
                                        $content_blocks = $currentPage->getContentBlocks();
                                        if( is_array($content_blocks) ) {
                                            echo('<ul>');
                                            foreach($content_blocks as $content_block) {
                                                echo('<li>');
                                                echo($content_block->getTitle());
                                                echo('</li>');
                                            }
                                            echo('</ul>');
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        Please assign content block's
                                        
                                        
                                    </div>
                                    <div class="col-md-4">
                                        Available content blocks
                                        
                                        
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
        </div><!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

<script>
    document.getElementById("page_title").focus();
    tinymce.init({ selector:'#page_content', height:'350px', width:'800px' });
</script>

<?php getFooter();