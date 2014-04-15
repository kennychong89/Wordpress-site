        <!-- sidebars -->
        <div class="b footer">
            <div class="b footer-texture">
                <div class="b footer-mask">
                    <div class="b footer-corner">
                        <div class="container l1012">
                            <div class="corner corner-left"></div>
                            <div class="corner corner-right"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <!-- copyright -->
                    <div class="b footer-copyright">
                        <div class="container">
                            <div class="grid_1_2">
                                <p>
                                    <?php echo myThemes::get( 'footer-left' , true ); ?>
                                </p>
                            </div>
                            <div class="grid_1_2">
                                <p class="fr">
                                    <?php echo myThemes::get( 'footer-right' , true ); ?>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    
        <?php echo myThemes::get( 'script' );  ?>
            
        <?php wp_footer(); ?>
            
	</body>
</html>