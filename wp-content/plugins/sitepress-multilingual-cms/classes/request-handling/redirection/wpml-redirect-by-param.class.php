<?php

class WPML_Redirect_By_Param extends WPML_Redirection {

	private $post_like_params = array(
		'p'       => 1,
		'page_id' => 1,
	);
	private $term_like_params = array(
		'cat_ID' => 1,
		'cat'    => 1,
		'tag'    => 1,
	);

	/** @var SitePress */
	private $sitepress;

	/**
	 * @param array                    $tax_sync_option
	 * @param WPML_URL_Converter       $url_converter
	 * @param WPML_Request             $request_handler
	 * @param WPML_Language_Resolution $lang_resolution
	 * @param SitePress                $sitepress
	 */
	public function __construct( $tax_sync_option, &$url_converter, &$request_handler, &$lang_resolution, &$sitepress ) {
		parent::__construct( $url_converter, $request_handler, $lang_resolution );
		global $wp_rewrite;

		$this->sitepress = &$sitepress;

		if ( ! isset( $wp_rewrite ) ) {
			require_once ABSPATH . WPINC . '/rewrite.php';
			$wp_rewrite = new WP_Rewrite();
		}

		$this->term_like_params = array_merge( $this->term_like_params, array_filter( $tax_sync_option ) );
	}

	public function init_hooks() {
		add_action( 'template_redirect', array( $this, 'template_redirect_action' ), 1 );
	}

	/**
	 * @return bool|string
	 */
	public function get_redirect_target() {
		$target = $this->redirect_hidden_home();
		if ( (bool) $target === false ) {
			$target   = ( $new_qs = $this->get_target_link_querystring() ) !== false
					? ( $new_qs !== '' ? '/?' . $new_qs : '/' ) : false;
			$qs_parts = explode( '?', $this->request_handler->get_request_uri() );
			$path     = array_shift( $qs_parts );
			$target   = $target !== false ? rtrim( $path, '/' ) . $target : false;
		}

		return $target;
	}

	private function find_potential_translation( $query_params, $lang_code ) {
		if ( count( $translatable_params = array_intersect_key( $query_params, $this->post_like_params ) ) === 1 ) {
			/** @var WPML_Post_Translation $wpml_post_translations */
			global $wpml_post_translations;
			$potential_translation = $wpml_post_translations->element_id_in(
				$query_params[ ( $parameter = key( $translatable_params ) ) ],
				$lang_code
			);
		} elseif ( count( $translatable_params = array_intersect_key( $query_params, $this->term_like_params ) ) === 1 ) {
			/** @var WPML_Term_Translation $wpml_term_translations */
			global $wpml_term_translations;

			$termId = $query_params[ ( $parameter = key( $translatable_params ) ) ];
			if ( is_array( $termId ) ) {
				$termId = $termId[0];
			}

			$potential_translation = $wpml_term_translations->term_id_in( (int) $termId, $lang_code );
		}
		/** @var String $parameter */
		return isset( $potential_translation, $parameter ) ? array( $parameter, $potential_translation ) : false;
	}

	/**
	 * @param string $query_params_string
	 * @param string $lang_code
	 *
	 * @return array|false
	 */
	private function needs_redirect( $query_params_string, $lang_code ) {
		global $sitepress;

		$element_lang = false;
		parse_str( $query_params_string, $query_params );
		if ( isset( $query_params['lang'] ) ) {
			if ( $sitepress->get_default_language() === $query_params['lang'] ) {
				unset( $query_params['lang'] );
				$changed = true;
			}
		} else {
			$element_lang = $this->get_element_language( $query_params_string );
			if ( $element_lang && $element_lang !== $sitepress->get_default_language() ) {
				$query_params['lang'] = $element_lang;
				$changed              = true;
			}
		}

		if ( ( $potential_translation = $this->find_potential_translation( $query_params, $lang_code ) ) !== false
			 && (int) $query_params[ $potential_translation[0] ] !== (int) $potential_translation[1]
			 && ! $element_lang
		) {
			$query_params[ $potential_translation[0] ] = $potential_translation[1];
			$changed                                   = true;
		}

		return isset( $changed ) ? $query_params : false;
	}

	private function get_target_link_querystring() {
		$raw_query_string = $this->request_handler->get_request_uri();
		$qs_parts         = explode( '?', $raw_query_string );
		$query_string     = array_pop( $qs_parts );

		$query_params_new = $this->needs_redirect(
			$query_string,
			$this->url_converter->get_language_from_url( $raw_query_string )
		);

		return $query_params_new !== false ? rawurldecode( http_build_query( $query_params_new ) ) : false;
	}

	/**
	 * @param string $query_params_string
	 *
	 * @return null|string
	 */
	private function get_element_language( $query_params_string ) {
		$language                          = '';
		list( $element_id, $element_type ) = $this->get_element_details( $query_params_string );

		if ( $element_id && $element_type ) {
			$language = $this->sitepress->get_language_for_element( $element_id, $element_type );
		}

		return $language;
	}

	/**
	 * @param string $url
	 *
	 * @return array
	 */
	private function get_element_details( $url ) {
		$element_id   = '';
		$element_type = '';
		parse_str( $url, $query_args );

		if ( isset( $query_args['p'] ) ) {
			$element_id   = $query_args['p'];
			$element_type = 'post_' . get_post_type( (int) $element_id );
		} elseif ( isset( $query_args['cat'] ) ) {
			$element_id   = $query_args['cat'];
			$term         = get_term( (int) $element_id );
			$element_type = 'tax_' . $term->taxonomy;
		}

		return array( $element_id, $element_type );
	}

	/**
	 * @link https://onthegosystems.myjetbrains.com/youtrack/issue/wpmlcore-2822
	 */
	public function template_redirect_action() {
		if ( $this->sitepress->get_wp_api()->is_front_page()
			 && $this->sitepress->get_wp_api()->get_query_var( 'page' )
			 && $this->sitepress->get_default_language() !== $this->sitepress->get_current_language()
		) {
			remove_action( 'template_redirect', 'redirect_canonical' );
		}
	}
}
