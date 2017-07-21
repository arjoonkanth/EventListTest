<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com
 * @since      1.0.0
 *
 * @package    Event_Listing
 * @subpackage Event_Listing/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Event_Listing
 * @subpackage Event_Listing/public
 * @author     A <A>
 */
class Event_Listing_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/event-listing-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/event-listing-public.js', array( 'jquery' ), $this->version, false );

	}

	public function get_archive_post_type_template(){
		if ( post_type_exists( 'event_listing' ) ) {

			// ob_start();

			// $output = ob_get_contents();

			// ob_end_clean();

			// return $output;


			if (have_posts()) : while (have_posts()) : the_post();

				echo '<div class="cpt-event-list">';

					echo '<h2><a href="'.get_permalink(get_the_ID()).'">'.get_the_title().'</h2>';

					echo '<p>This post was written by '.get_the_author().'</p>';

				echo '</div>';

			endwhile; else :
			endif;
		}
	}

	public function get_single_post_type_template(){

		if (have_posts()) : while (have_posts()) : the_post();

			echo '<div>';

				echo '<h1>'.get_the_title().'</h1>';

				echo '<p>This post was written by '.get_the_author().'</p>';

				$meta = get_post_meta(get_the_ID());

	            $sdate = $meta['mbt-start-date'][0];
	            $edate = $meta['mbt-end-date'][0];
		    ?>

		        <ul>
		            <li><strong>Start Date</strong> - <span><?php echo $sdate; ?></span></li>
		            <li><strong>End Date</strong> - <span><?php echo $edate; ?></span></li>
		        </ul>

		<?php

			echo '</div>';

		endwhile; else :
			echo "<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>";
		endif;


	}

	public function register_shortcodes() {
		add_shortcode( 'q_archive_listings', array( $this, 'event_list' ) );
		add_shortcode( 'q_single_listing', array( $this, 'event_view' ) );
	} // register_shortcodes()

}
