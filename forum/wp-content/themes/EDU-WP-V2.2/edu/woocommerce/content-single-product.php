<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>

<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_show_product_images hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

</div><!-- #product-<?php the_ID(); ?> -->

 
<div style="border-radius: 15px; border: 5px solid rgb(104, 104, 104); padding: 10px;"><b><i>ALL</i></b>  listed project topics on our website are complete material from chapter <b>1-5</b>&nbsp;&nbsp;in typed format <b>( Ms word and PDF )</b> which are well supervised and approved by lecturers who are intellectual in their various fields of discipline,&nbsp;&nbsp;documented to assist you with complete, quality and well organized researched materials.</div><div style="border-radius: 15px; border: 5px solid rgb(104, 104, 104); padding: 10px;">&nbsp;<b>The Project File Details</b>: Complete Chapter 1-5:&nbsp;<span style="color: red;">Yes</span>&nbsp;| Instant Download:&nbsp;<span style="color: red;">Yes</span>&nbsp;| Ms Word and PDF Format:&nbsp;<span style="color: red;">Yes</span>&nbsp;| All Chapters, Abstract, Figures, Appendix, References:<span style="color: red;">&nbsp;Yes&nbsp;</span></div>
<?php do_action( 'woocommerce_after_single_product' ); ?>

 <p><br /></p><p><b><i><span style="background-color: yellow; color: blue;">Search your department,newly approved project or related topics   </span></i></b>

<div class="wp-block-woocommerce-product-search"><div class="wc-block-product-search"><form role="search" method="get" action="https://projectandmaterials.com/"><label for="wc-block-product-search-4" class="wc-block-product-search__label">Search</label><div class="wc-block-product-search__fields"><input type="search" id="wc-block-product-search-4" class="wc-block-product-search__field" placeholder="Search project topics and materials " name="s"/><input type="hidden" name="post_type" value="product"/><button type="submit" class="wc-block-product-search__button" label="Search project topics and materials "><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-arrow-right-alt2" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 20 20"><path d="M6 15l5-5-5-5 1-2 7 7-7 7z"></path></svg></button></div></form></div></div>

<p><br /></p><p> 

<p style="text-align: justify;"><b>FOR QUICK RESULT:&nbsp;</b><i><span style="text-align: justify;">Search your&nbsp;</span><span style="text-align: justify;">department or newly approved topic</span><span style="text-align: justify;">. Enter your topic or department in the search box, click on the right arrow to get search results on your topic/related topic.</span><span style="text-align: justify;">&nbsp;</span><span style="text-align: justify;">Thanks and feel free to contact us</span><span style="text-align: justify;">&nbsp;for any question that regards to your project/thesis.&nbsp;</span><span style="text-align: justify;">Hire a writer</span><span style="text-align: justify;">&nbsp;to assist in your newly approved&nbsp;</span><a href="https://projectandmaterials.com " style="text-align: justify;">project/thesis</a><span style="text-align: justify;">,&nbsp;</span><a href="https://projectandmaterials.com/proposal/" style="text-align: justify;">Project proposal&nbsp;</a><span style="text-align: justify;">|&nbsp;</span><a href="https://projectandmaterials.com/assignments/" style="text-align: justify;">School Assignments</a><span style="text-align: justify;">&nbsp;|&nbsp;</span><a href="https://projectandmaterials.com/analysis/" style="text-align: justify;">Chapter 4 Data Analysis</a><span style="text-align: justify;">&nbsp;|&nbsp;</span><a href="https://projectandmaterials.com/analysis/" style="text-align: justify;">Questionnaire</a><span style="text-align: justify;">&nbsp;|&nbsp;</span><a href="https://projectandmaterials.com/serminal-reportjournals-term-paper/" style="text-align: justify;">Serminal topic</a><span style="text-align: justify;">&nbsp;|&nbsp;</span><a href="https://projectandmaterials.com/serminal-reportjournals-term-paper/" style="text-align: justify;">journal writing</a><span style="text-align: justify;">&nbsp;|&nbsp;</span><a href="https://projectandmaterials.com/serminal-reportjournals-term-paper/" style="text-align: justify;">Term paper</a><span style="text-align: justify;">&nbsp;</span><span style="text-align: justify;">relax and get the stress off your shoulder&nbsp;</span><span style="text-align: justify;">as we get you covered with our professionals' writers. Access your Free&nbsp;</span><a href="https://projectandmaterials.com/courses" style="text-align: justify;">Research courses/Assignments</a><span style="text-align: justify;">&nbsp;(introductory and general researched course materials of various discipline)</span></i></p>