<?php 
$shopire_slider_options_hide_show = get_theme_mod('shopire_slider_options_hide_show','1'); 
$shopire_slider_option 		= get_theme_mod('shopire_slider_option',shopire_slider_options_default());
$shopire_slider_data_option = get_theme_mod('shopire_slider_data_option',shopire_slider_data_options_default());
if($shopire_slider_options_hide_show=='1'):
?>	
<section id="wf_slider" class="wf_slider wf_slider_banner wf_slider--ten">
	<div class="wf-container">
		<div class="wf-row wf-g-4">
			<div class="wf-col-lg-12 wf-col-md-12">
				<div class="wf_owl_carousel owl-theme owl-carousel slider" data-owl-options='{
					"loop": true,
					"animateOut": "fadeOut",
					"animateIn": "fadeIn",
					"items": 1,
					"autoplay": true,
					"autoplayTimeout": 7000,
					"smartSpeed": 1000,
					"nav": true,
					"navText": ["<i class=\"fal fa-arrow-left\"></i>","<i class=\"fal fa-arrow-right\"></i>"],
					"dots": false,
					"responsive": {
						"0": {
							"dots": true,
							"nav": false
						},
						"576": {
							"dots": true,
							"nav": false
						},
						"768": {
							"dots": false,
							"nav": true
						}
					},
					"margin": 0
					}'>
					<?php
						if ( ! empty( $shopire_slider_option ) ) {
							$allowed_html = array(
									'br'     => array(),
									'em'     => array(),
									'strong' => array(),
									'span' => array(),
									'b'      => array(),
									'i'      => array(),
									);
						$shopire_slider_option = json_decode( $shopire_slider_option );
						foreach ( $shopire_slider_option as $item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'shopire_translate_single_string', $item->title, 'slider section' ) : '';
							$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'shopire_translate_single_string', $item->subtitle, 'slider section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'shopire_translate_single_string', $item->text, 'slider section' ) : '';
							$button = ! empty( $item->text2) ? apply_filters( 'shopire_translate_single_string', $item->text2,'slider section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'shopire_translate_single_string', $item->link, 'slider section' ) : '';
							$image = ! empty( $item->image_url ) ? apply_filters( 'shopire_translate_single_string', $item->image_url, 'slider section' ) : '';
							$align = ! empty( $item->slide_align ) ? apply_filters( 'shopire_translate_single_string', $item->slide_align, 'slider section' ) : '';
					?>
						<div class="wf_slider-item">
							<?php if(! empty( $image )): ?>
								<img src="<?php echo esc_url($image); ?>">
							<?php endif; ?>
							<div class="wf_slider-wrapper">
								<div class="wf_slider-inner">
									<div class="wf_slider-innercell">
										<div class="wf-container">
											<div class="wf-row wf-text-<?php echo esc_attr($align); ?>">
												<div class="wf-col-lg-12 wf-col-md-12 first wf-my-auto">
													<div class="wf_slider-content">
														<?php if ( ! empty( $title ) ) : ?>
															<h5 class="subtitle"><i class="far fa-bolt"></i> <?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
														<?php endif; ?>
														
														<?php if ( ! empty( $subtitle ) ) : ?>
															<h2 class="title"><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?></h2>
														<?php endif; ?>
														
														<?php if ( ! empty( $text ) ) : ?>
															<p class="text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
														<?php endif; ?>
														
														<div class="wf_btn-group">
															<?php if ( ! empty( $button ) ) : ?>
																<a href="<?php echo esc_url($link); ?>" class="wf-btn wf-btn-white"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></a>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
			<div class="wf-row wf-g-4 wf-mt-0 banner-wrapper">
				<?php
					if ( ! empty( $shopire_slider_data_option ) ) {
						$allowed_html = array(
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'span' => array(),
								'b'      => array(),
								'i'      => array(),
								);
					$shopire_slider_data_option = json_decode( $shopire_slider_data_option );
					foreach ( $shopire_slider_data_option as $item ) {
						$title = ! empty( $item->title ) ? apply_filters( 'shopire_translate_single_string', $item->title, 'slider More Data' ) : '';
						$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'shopire_translate_single_string', $item->subtitle, 'slider More Data' ) : '';
						$button = ! empty( $item->text2) ? apply_filters( 'shopire_translate_single_string', $item->text2,'slider More Data' ) : '';
						$link = ! empty( $item->link ) ? apply_filters( 'shopire_translate_single_string', $item->link, 'slider More Data' ) : '';
						$image = ! empty( $item->image_url ) ? apply_filters( 'shopire_translate_single_string', $item->image_url, 'slider More Data' ) : '';
				?>
				<div class="wf-col-lg-4 wf-col-sm-6 wf-col-12">
					<div class="banner-wrapper-item effect_1">
						<?php if ( ! empty( $image ) ) : ?>
							<div class="wf-image">
								<a href="<?php echo esc_url($link); ?>">
									<img src="<?php echo esc_url($image); ?>" alt="<?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?>">
								</a>
							</div>
						<?php endif; ?>
						<div class="banner-wrapper-inner">
							<div class="info">
								<div class="content">
									<?php if ( ! empty( $title ) ) : ?>
										<div class="subtitle"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></div>
									<?php endif; ?>
									
									<?php if ( ! empty( $subtitle ) ) : ?>
										<h3 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?></a></h3>
									<?php endif; ?>
									
									<?php if ( ! empty( $button ) ) : ?>
										<a class="wf-btn wf-btn-white" href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>