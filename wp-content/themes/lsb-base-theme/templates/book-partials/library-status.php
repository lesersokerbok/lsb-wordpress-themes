<?php

$counties = get_post_meta($post->ID, 'lsb_library_status', true);

?>

<?php if( $counties ) : ?>
<div class="content-part library-status">
	<table class="table">
		<thead>
			<tr>
				<th colspan="2">
					<form class="form-inline">
					 <label for="countySelect"><?php _e( 'Lån boka på ditt bibliotek:', 'lsb' ); ?></label>
						<select class="form-control" id="countySelect">
							<option><?php _e('Velg fylke', 'lsb') ?></option>
							<?php foreach( $counties as $key => $county_libraries ) : ?>
								<?php if( $key ) : ?>
								<option value="<?php echo sanitize_title($key) ?>"><?php echo esc_html( $key ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</form>
				</th>
			</tr>
		</thead>

	<?php foreach( $counties as $key => $county_libraries ) : ?>
		<tbody class="hidden county <?php echo sanitize_title( $key ); ?>">
		<?php foreach( $county_libraries as $library ) : ?>
			<tr>
				<td>
					<a href="<?php echo esc_url( $library['url'] ) ?>">
						<?php echo esc_html( $library['name'] ) ?>
					</a>
				</td>
				<td>
					<a class="btn btn-default" target="_blank" href="<?php echo esc_url( $library['book_url'] ) ?>">
						<?php _e('Lån boka', 'lsb'); ?>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	<?php endforeach; ?>
	</table>
</div>
<?php endif; ?>
