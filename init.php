<?php
/**
	 * Plugin Name:       Doctors-slides
	 * Plugin URI:        https://doctors.com/plugins/slides/
	 * Description:       Totally slides plugin
	 * Version:           1.0.0
	 * Requires at least: 5.2
	 * Requires PHP:      7.2
	 * Author:            Taufik Akunjee
	 * Author URI:        https://taufikcse.com/
	 * License:           GPL v2 or later
	 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
	 * Text Domain:       slides-plugin
	 * Domain Path:       /languages
*/
defined('ABSPATH') or die('directory browsing is disabled');


 
class Doctor{
	public function __construct(){
		//required files
		if(file_exists(dirname(__FILE__).'/metabox/init.php')){
			require_once(dirname(__FILE__).'/metabox/init.php');
		}
		if(file_exists(dirname(__FILE__).'/metabox/metabox-config.php')){
			require_once(dirname(__FILE__).'/metabox/metabox-config.php');
		}
		add_action('init',array($this,'doctors_slides'));

		add_action('wp_enqueue_scripts',array($this,'external_js_and_css_files'));
	}

	public function external_js_and_css_files(){
		wp_enqueue_style('owl',PLUGINS_URL('css/owl.carousel.css',__FILE__));
		wp_enqueue_style('owlcustom',PLUGINS_URL('css/owl.custom.css',__FILE__));
		wp_enqueue_script('owljs',PLUGINS_URL('js/owl.carousel.min.js',__FILE__),array('jquery'));
		wp_enqueue_script('customjs',PLUGINS_URL('js/owl.custom.js',__FILE__),array('jquery'));
	}

	public function doctors_slides() {

	    $labels = array(
	        'name'                  => _x( 'Doctors', 'Doctors general name', 'slides-plugin' ),
	        'singular_name'         => _x( 'Doctor', 'Doctor singular name', 'slides-plugin' ),
	        'menu_name'             => _x( 'Doctors', 'Admin Menu text', 'slides-plugin' ),
	        'name_admin_bar'        => _x( 'Doctor', 'Add New on Toolbar', 'slides-plugin' ),
	        'add_new'               => __( 'Add New Info', 'slides-plugin' ),
	        'add_new_item'          => __( 'Add New Info', 'slides-plugin' ),
	        'new_item'              => __( 'New Doctor', 'slides-plugin' ),
	        'edit_item'             => __( 'Edit Doctor Info', 'slides-plugin' ),
	        'view_item'             => __( 'View Doctors List', 'slides-plugin' ),
	        'all_items'             => __( 'All Doctors', 'slides-plugin' ),
	        'search_items'          => __( 'Search Doctors Info', 'slides-plugin' ),
	        'parent_item_colon'     => __( 'Parent Doctors Info:', 'slides-plugin' ),
	        'not_found'             => __( 'No Doctors info found.', 'slides-plugin' ),
	        'not_found_in_trash'    => __( 'No Doctors info found in Trash.', 'slides-plugin' ),
	        'featured_image'        => _x( 'Doctor Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'slides-plugin' ),
	        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'slides-plugin' ),
	        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'slides-plugin' ),
	        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'slides-plugin' ),
	        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'slides-plugin' ),
	        'insert_into_item'      => _x( 'Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'slides-plugin' ),
	        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'slides-plugin' ),
	        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'slides-plugin' ),
	        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'slides-plugin' ),
	        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'slides-plugin' ),
	    );
	 
	    $args = array(
	        'labels'             => $labels,
	        'public'             => true,
	        'publicly_queryable' => true,
	        'show_ui'            => true,
	        'show_in_menu'       => true,
	        'query_var'          => true,
	        'rewrite'            => array( 'slug' => 'doctor' ),
	        'capability_type'    => 'post',
	        'has_archive'        => true,
	        'hierarchical'       => false,
	        'menu_position'      => null,
	        'menu_icon'			 =>'dashicons-plus-alt',
	        'supports'           => array( 'title','thumbnail')
	    );
	 
	    register_post_type( 'doctors_info', $args );

	        //taxonomy

	        $label = array(
	        'name'                       => _x( 'speciality', 'taxonomy general name', 'textdomain' ),
	        'singular_name'              => _x( 'speciality', 'taxonomy singular name', 'textdomain' ),
	        'search_items'               => __( 'Search speciality', 'textdomain' ),
	        'popular_items'              => __( 'Popular speciality', 'textdomain' ),
	        'all_items'                  => __( 'All speciality', 'textdomain' ),
	        'parent_item'                => null,
	        'parent_item_colon'          => null,
	        'edit_item'                  => __( 'Edit speciality', 'textdomain' ),
	        'update_item'                => __( 'Update speciality', 'textdomain' ),
	        'add_new_item'               => __( 'Add New speciality', 'textdomain' ),
	        'new_item_name'              => __( 'New speciality Name', 'textdomain' ),
	        'separate_items_with_commas' => __( 'Separate specialitys with commas', 'textdomain' ),
	        'add_or_remove_items'        => __( 'Add or remove speciality', 'textdomain' ),
	        'choose_from_most_used'      => __( 'Choose from the most used specialitys', 'textdomain' ),
	        'not_found'                  => __( 'No speciality found.', 'textdomain' ),
	        'menu_name'                  => __( 'specialitys', 'textdomain' ),
	    );
	 
	    $arguments = array(
	        'hierarchical'          => true,
	        'labels'                => $label,
	        'show_ui'               => true,
	        'show_admin_column'     => true,
	        'update_count_callback' => '_update_post_term_count',
	        'query_var'             => true,
	        'rewrite'               => array( 'slug' => 'speciality' ),
	    );
	 
	    register_taxonomy( 'speciality', 'doctors_info', $arguments );
	}


	public function doctors_shortcode(){

		add_shortcode('doctors-info', array( $this, 'doctors_info_output' ) );

	}

	public function doctors_info_output(){
		ob_start(); 
		$prefix = '_prefix_';
		
		$doctors_info = new WP_Query(array(
			'post_type' => 'doctors_info',
			'posts_per_page' => -1
		));

		?>
		<div class="taufik-doctors">
		<?php while($doctors_info->have_posts()) : $doctors_info->the_post();
		?>

			<div class="doctors-info">
				<div class="info-left">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				</div>
				<div class="info-right">
					<div class="informations">
						<ul>
							<li>Name: <span><?php echo get_post_meta(get_the_id(), $prefix.'doctors_name', true); ?></span></li>
							<li>Speciality: <span>
								
								<?php $specialities = get_the_terms(get_the_id(), 'doctors-speciality');

								foreach($specialities as $speciality) {
									echo $speciality->name;
								} ?>
							</span></li>
							<li>Age: <span><?php echo get_post_meta(get_the_id(), $prefix.'doctors_age', true); ?></span></li>
							<li>Degree: <span><?php echo get_post_meta(get_the_id(), $prefix.'doctors_degree', true); ?></span></li>
							<li>Chamber: <span><?php echo get_post_meta(get_the_id(), $prefix.'doctors_chamber', true); ?></span></li>
							
						</ul>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

		</div>

		<?php return ob_get_clean();
	}



}


$doctor = new Doctor();

$doctor->doctors_shortcode();

