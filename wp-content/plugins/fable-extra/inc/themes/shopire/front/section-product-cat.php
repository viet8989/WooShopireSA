<section id="wf_product_categories_wrapper" class="wf_product_categories_wrapper">
    <div class="wf-container">

        <?php
        // Define your popular categories array
        // In a real-world scenario, you might fetch this dynamically
        $popular_categories = array(
            array(
                'id' => 15,
                'name' => 'Dụng cụ cầm tay',
                'slug' => 'dung-cu-cam-tay' // Add slug for the "See all" link
            ),
            array(
                'id' => 365,
                'name' => 'Dụng cụ dùng điện',
                'slug' => 'dung-cu-dien-cam-tay'
            ),
            array(
                'id' => 391,
                'name' => 'Dụng cụ dùng pin',
                'slug' => 'dung-cu-dung-pin'
            ),
            array(
                'id' => 400,
                'name' => 'Dụng cụ khí nén',
                'slug' => 'dung-cu-khi-nen'
            ),
            array(
                'id' => 401,
                'name' => 'Dụng cụ cắt gọt cơ khí',
                'slug' => 'dung-cu-cat-got-co-khi'
            ),
            array(
                'id' => 429,
                'name' => 'Dụng cụ đo chính xác',
                'slug' => 'dung-cu-do-chinh-xac'
            ),
            array(
                'id' => 451,
                'name' => 'Dụng cụ đo điện',
                'slug' => 'dung-cu-do-dien'
            ),
            array(
                'id' => 462,
                'name' => 'Thiết bị thủy lực',
                'slug' => 'thiet-bi-thuy-luc'
            ),
            array(
                'id' => 475,
                'name' => 'Thiết bị nâng hạ',
                'slug' => 'thiet-bi-nang-ha'
            ),
            array(
                'id' => 490,
                'name' => 'Thiết bị ngành hàn',
                'slug' => 'thiet-bi-nganh-han'
            ),
            array(
                'id' => 507,
                'name' => 'Thiết bị phun sơn',
                'slug' => 'thiet-bi-phun-son'
            ),
            array(
                'id' => 521,
                'name' => 'Keo dán công nghiệp',
                'slug' => 'keo-dan-cong-nghiep'
            )
        );

        if ( class_exists( 'woocommerce' ) ) {
            // Loop through each category
            foreach ( $popular_categories as $category ) {
                // Ensure category ID and name are valid
                if ( ! isset( $category['id'] ) || ! isset( $category['name'] ) || ! isset( $category['slug'] ) ) {
                    continue; // Skip if essential data is missing
                }

                $term_id = $category['id'];
                $category_name = $category['name'];
                $category_slug = $category['slug'];
                $see_all_url = home_url( '/danh-muc-san-pham/' . $category_slug . '/' ); // Dynamic URL
                ?>

                <section id="wf_product_category_<?php echo esc_attr( $term_id ); ?>" class="wf_product_category wf_product_category_one wf-py-default front-product-cat wf-mb-5">
                    <div class="wf-container">
                        <div class="wf-row align-items-center wf-mb-5" style="background-color: lightsteelblue;">
                            <div class="wf-col-lg-6 wf-col-md-8">
                                <div class="section-title wf-text-md-left wf-text-center">
                                    <h3 class="title"><?php echo esc_html( $category_name ); ?></h3>
                                </div>
                            </div>
                            <div class="wf-col-lg-6 wf-col-md-4">
                                <div class="wf-text-md-right wf-text-center wf-md-0 wf-mt-2">
                                    <a href="<?php echo esc_url( $see_all_url ); ?>" class="more-link">
                                        Xem tất cả
                                        <i class="far fa-arrow-right wf-ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php
                        $args = array(
                            'post_type'      => 'product',
                            'posts_per_page' => 8, // Number of products per category
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'term_id',
                                    'terms'    => $term_id,
                                ),
                            ),
                            // Optional: Order products by popularity or date
                            // 'meta_key' => 'total_sales',
                            // 'orderby'  => 'meta_value_num',
                            // 'order'    => 'DESC',
                        );

                        $loop = new WP_Query( $args );

                        if ( $loop->have_posts() ) : ?>
                            <div class="wf-row wf-g-4">
                                <div class="wf-col-lg-12">
                                    <div class="woocommerce columns-4">
                                        <ul class="products columns-4">
                                            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                                <?php
                                                // Load the product template. Ensure 'woocommerce/content-product.php' exists in your theme or child theme.
                                                wc_get_template_part( 'content', 'product' );
                                                ?>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <p class="wf-text-center"><?php esc_html_e( 'No products found in this category.', 'your-text-domain' ); ?></p>
                        <?php endif; ?>
                    </div>
                </section>

                <?php
            } // End foreach loop
        } else {
            // Fallback message if WooCommerce is not active
            echo '<p class="wf-text-center">' . esc_html__( 'WooCommerce is not active. Please install and activate it to display products.', 'your-text-domain' ) . '</p>';
        }
        ?>

    </div>
</section>