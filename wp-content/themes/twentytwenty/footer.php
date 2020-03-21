<?php
/**
 * Template for displaying the footer
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->
	
	<!-- GENERAL MODAL FOR CONFIRMING DELETING RECORDS -->
	<div id="confirm-delete-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body">
					<div class="row no-margin">
						<div class="col-sm-12 text-center">
							<h3>Sunteți sigur că doriți să ștergeți această înregistrare?</h3>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
					<button type="button" class="btn btn-danger" id="btn-delete-record">Șterge</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	
	
	
	<div id="footer" role="contentinfo">
		<!--<div id="colophon">

		<?php get_sidebar( 'footer' ); ?>

			<div id="site-info">
				<a href="<?php //echo home_url( '/' ); ?>" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a>
			</div><!-- #site-info -->

		<!--</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	wp_footer();
?>
</body>
</html>
