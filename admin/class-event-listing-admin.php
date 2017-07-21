<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Event_Listing
 * @subpackage Event_Listing/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Event_Listing
 * @subpackage Event_Listing/admin
 * @author     A <A>
 */
class Event_Listing_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Event_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Event_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/event-listing-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Event_Listing_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Event_Listing_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/event-listing-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Custom post type
	 */

	public function cpt_setup_init(){
		// Register Custom Post Type
		$labels = array(
			'name'                  => _x( 'Event Listings', 'Event Listing General Name', 'event-listing' ),
			'singular_name'         => _x( 'Event Listing', 'Event Listing Singular Name', 'event-listing' ),
			'menu_name'             => __( 'Event Listings', 'event-listing' ),
			'name_admin_bar'        => __( 'Event Listing', 'event-listing' ),
			'archives'              => __( 'Item Archives', 'event-listing' ),
			'attributes'            => __( 'Item Attributes', 'event-listing' ),
			'parent_item_colon'     => __( 'Parent Item:', 'event-listing' ),
			'all_items'             => __( 'All Items', 'event-listing' ),
			'add_new_item'          => __( 'Add New Item', 'event-listing' ),
			'add_new'               => __( 'Add New', 'event-listing' ),
			'new_item'              => __( 'New Item', 'event-listing' ),
			'edit_item'             => __( 'Edit Item', 'event-listing' ),
			'update_item'           => __( 'Update Item', 'event-listing' ),
			'view_item'             => __( 'View Item', 'event-listing' ),
			'view_items'            => __( 'View Items', 'event-listing' ),
			'search_items'          => __( 'Search Item', 'event-listing' ),
			'not_found'             => __( 'Not found', 'event-listing' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'event-listing' ),
			'featured_image'        => __( 'Featured Image', 'event-listing' ),
			'set_featured_image'    => __( 'Set featured image', 'event-listing' ),
			'remove_featured_image' => __( 'Remove featured image', 'event-listing' ),
			'use_featured_image'    => __( 'Use as featured image', 'event-listing' ),
			'insert_into_item'      => __( 'Insert into item', 'event-listing' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'event-listing' ),
			'items_list'            => __( 'Items list', 'event-listing' ),
			'items_list_navigation' => __( 'Items list navigation', 'event-listing' ),
			'filter_items_list'     => __( 'Filter items list', 'event-listing' ),
		);
		$args = array(
			'label'                 => __( 'Event Listing', 'event-listing' ),
			'description'           => __( 'Event Listing Description', 'event-listing' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'revisions', 'page-attributes', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'rewrite'				=> array('slug' => 'event-listing'),	
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'event_listing', $args );

		flush_rewrite_rules();
	}

	function cpt_setup_metabox() {
	    add_meta_box("demo-meta-box", "Dates Meta Box", "custom_meta_box_markup", "event_listing", "side", "high", null);

	    function custom_meta_box_markup($object)
		{
		    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

		    ?>
		        <div>
		            <label for="mbt-start-date">Start Date</label>
		            <input name="mbt-start-date" type="text" value="<?php echo get_post_meta($object->ID, "mbt-start-date", true); ?>">
		        </div>
		        <p></p>
		        <div>
		            <label for="mbt-end-date">End Date</label>
		            <input name="mbt-end-date" type="text" value="<?php echo get_post_meta($object->ID, "mbt-end-date", true); ?>">
		        </div>
		    <?php  
		}
	}

	function save_custom_meta_box($post_id)
	{
	    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
	        return $post_id;

	    if(!current_user_can("edit_post", $post_id))
	        return $post_id;

	    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
	        return $post_id;

	    $mbtstartdate = "";
	    $mbtenddate = "";
 
	    if(isset($_POST["mbt-start-date"]))
	    {
	        $mbtstartdate = $_POST["mbt-start-date"];
	    }   
	    update_post_meta($post_id, "mbt-start-date", $mbtstartdate);

	    if(isset($_POST["mbt-end-date"]))
	    {
	        $mbtenddate = $_POST["mbt-end-date"];
	    }
	    update_post_meta($post_id, "mbt-end-date", $mbtenddate);
	}



}
