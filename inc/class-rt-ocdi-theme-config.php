<?php
/**
 * RT OCDI Theme Config
 *
 * Theme Configuration for installing demo packs using OCDI.
 *
 * @package RadiusTheme\RT_OCDI
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * RT OCDI Theme Config
 */
class RT_OCDI_Theme_Config {
	/**
	 * Theme Specific Import Data.
	 *
	 * @var array
	 */
	private $data = [];

	/**
	 * Class Constructor.
	 *
	 * @return array
	 */
	public function get_import_data() {
		$this
			->theme_data()
			->demos()
			->menus()
			->plugins();

		return $this->data;
	}

	/**
	 * Sets the theme data.
	 *
	 * @return $this
	 */
	private function theme_data() {
		$this->data['theme']                 = 'Neeon';
		$this->data['data_server']           = 'https://radiustheme.com/demo/wordpress/demo-content/neeon/one-click/';
		$this->data['demo_link']             = 'https://radiustheme.com/demo/wordpress/themes/neeon/';
		$this->data['import_doc_link']       = 'https://radiustheme.com/demo/wordpress/themes/neeon/docs/#section-4';
		$this->data['email_to_replace']      = 'techlabpro24@gmail.com';
		$this->data['taxonomies_to_import']  = [
			'category',
			'post_tag',
			'product_cat',
			'product_tag',
			'neeon_team_category',
		];
		$this->data['elementor_cpt_support'] = [
			'post',
			'page',
		];
		$this->data['elementor_cats_data']   = [
			'1802' => [
				'2ab710a' => [
					'travel',
					'food',
					'health',
					'politics',
				],
				'af8319c' => [
					'fashion',
					'travel',
					'food',
					'health',
				],
				'410926d' => [
					'fashion',
					'food',
					'racing',
					'sports',
					'technology',
					'travel',
				],
			],
			'1804' => [
				'8bc9f50' => [
					'technology',
				],
				'e8ca4e0' => [
					'fashion',
					'food',
					'animal',
					'action',
					'design',
					'politics',
				],
				'047fc88' => [
					'technology',
					'travel',
					'health',
					'design',
				],
				'35ec74f' => [
					'technology',
				],
				'269a69c' => [
					'technology',
				],
				'd5fd230' => [
					'technology',
					'fashion',
					'travel',
					'food',
				],
				'5fbbe1a' => [
					'fashion',
				],
				'd73824b' => [
					'america',
				],
				'8e5515e' => [
					'food',
				],
				'5c4ef4c' => [
					'animal',
				],
			],
			'1805' => [
				'aed8a49' => [
					'fighter',
					'action',
					'racing',
					'music',
				],
				'8be6b63' => [
					'action',
					'racing',
				],
				'224914d' => [
					'action',
				],
				'41f0d5e' => [
					'fighter',
					'racing',
				],
				'af361ff' => [
					'technology',
					'fashion',
					'travel',
					'food',
					'health',
				],
				'0df92fe' => [
					'fighter',
					'action',
					'racing',
					'animated',
				],
			],
			'1806' => [
				'657ca3a' => [
					'graphics',
				],
				'49bcf4a' => [
					'design',
					'graphics',
				],
				'ba482fe' => [
					'design',
					'graphics',
				],
				'1b92b67' => [
					'design',
				],
				'fb873c6' => [
					'design',
					'graphics',
				],
			],
			'1807' => [
				'8f33a4f' => [
					'politics',
				],
				'333c24e' => [
					'sports',
				],
				'a189e73' => [
					'technology',
				],
				'4f1811c' => [
					'sports',
				],
				'fdf60a7' => [
					'politics',
				],
				'5706b01' => [
					'music',
				],
				'0ffdf28' => [
					'action',
					'design',
					'graphics',
					'politics',
					'music',
				],
				'f0daf26' => [
					'politics',
				],
				'd52ca9c' => [
					'travel',
					'sports',
					'politics',
				],
			],
			'1808' => [
				'839d53f' => [
					'fashion',
				],
				'9521971' => [
					'fashion',
				],
				'348edd5' => [
					'travel',
				],
				'0cfb9a2' => [
					'fashion',
				],
				'5c15c84' => [
					'fashion',
					'travel',
				],
				'c12cb71' => [
					'fashion',
				],
				'9984e2a' => [
					'technology',
					'fashion',
					'travel',
					'food',
					'health',
					'sports',
				],
				'f8484e3' => [
					'fashion',
				],
			],
			'6788' => [
				'9f67ab6'  => [
					'sports',
				],
				'50c61e2'  => [
					'sports',
				],
				'5986ac27' => [
					'sports',
				],
				'79472f4'  => [
					'sports',
				],
			],
			'6790' => [
				'524768e5' => [
					'america',
					'europe',
					'canada',
				],
				'7a94bd36' => [
					'travel',
					'food',
					'health',
					'sports',
					'animal',
				],
				'70a3240d' => [
					'america',
				],
			],
			'7191' => [
				'73bac22f' => [
					'gym',
				],
				'92c5edb'  => [
					'gym',
				],
				'3df073d'  => [
					'technology',
					'fashion',
					'travel',
					'food',
					'sports',
				],
				'8896039'  => [
					'gym',
				],
				'2141612e' => [
					'gym',
				],
				'1121234d' => [
					'gym',
				],
				'284c1371' => [
					'yoga',
				],
				'58ff2230' => [
					'gym',
				],
				'4cb9f911' => [
					'gym',
				],
				'70ab5002' => [
					'fitness',
				],
				'72587c51' => [
					'gym',
					'yoga',
					'fitness',
				],
			],
			'7513' => [
				'77952400' => [
					'medical',
				],
				'1e3a0f8a' => [
					'medical',
				],
				'172a8984' => [
					'medical',
				],
				'4f84d4f7' => [
					'medical',
				],
				'ea08f1'   => [
					'technology',
					'fashion',
					'food',
					'health',
					'sports',
					'animal',
				],
				'6a03bb9'  => [
					'dental',
				],
				'53487296' => [
					'eye-care',
				],
				'34f30486' => [
					'operation',
				],
				'771a18d9' => [
					'medical',
					'operation',
				],
				'70fa9836' => [
					'medical',
				],
				'c779fd7'  => [
					'medical',
				],
				'2944eae8' => [
					'medical',
				],
			],
			'7515' => [
				'5dd54b0'  => [
					'economy',
				],
				'5082ae84' => [
					'business',
				],
				'5bf10012' => [
					'finance',
				],
				'460bdb06' => [
					'business',
				],
				'7ab0f801' => [
					'economy',
				],
				'5df1730b' => [
					'business',
				],
				'edd04c8'  => [
					'business',
				],
				'1c006c56' => [
					'fashion',
					'travel',
					'sports',
					'animal',
					'fighter',
				],
				'519506ce' => [
					'business',
				],
				'63185146' => [
					'business',
				],
				'3da462e4' => [
					'business',
				],
				'482e6c29' => [
					'business',
					'finance',
					'economy',
				],
				'c8d6931'  => [
					'business',
				],
			],
			'7776' => [
				'2a52a83d' => [
					'life-style',
				],
				'75a82682' => [
					'fashion',
					'travel',
					'life-style',
				],
				'50ec00f3' => [
					'life-style',
				],
				'1c0c6a6'  => [
					'life-style',
				],
				'adeb542'  => [
					'fashion',
					'life-style',
				],
				'503671f0' => [
					'life-style',
				],
			],
			'7902' => [
				'3b3f2fc7' => [
					'food',
				],
				'48fb2bb6' => [
					'dessert',
				],
				'4ac5796'  => [
					'meat',
				],
				'd3c4e5d'  => [
					'breakfast',
				],
				'bb63d84'  => [
					'pizza',
				],
				'48aa4c0'  => [
					'soup',
				],
				'9fce62b'  => [
					'dessert',
				],
				'a51ae0a'  => [
					'salad',
				],
				'ec22eb9'  => [
					'breakfast',
				],
				'72352d77' => [
					'food',
				],
				'5452c725' => [
					'launch',
				],
				'54f83030' => [
					'food',
				],
				'50ef1efb' => [
					'fashion',
					'travel',
					'food',
					'health',
					'sports',
					'animal',
				],
				'22169d1a' => [
					'breakfast',
				],
			],
			'8034' => [
				'4895f247' => [
					'wedding',
					'nature',
					'adventure',
					'wildlife',
				],
				'da5f12d'  => [
					'wedding',
					'nature',
				],
				'493c516a' => [
					'wedding',
					'nature',
					'adventure',
					'wildlife',
				],
			],
			'8159' => [
				'6e7eccc6' => [
					'animal',
				],
				'103d063b' => [
					'animal',
				],
				'717a05e'  => [
					'animal',
					'wildlife',
					'curiosity',
					'biology',
					'marine',
				],
				'e666012'  => [
					'technology',
					'curiosity',
				],
				'757c43a1' => [
					'animal',
				],
				'6bc49307' => [
					'curiosity',
					'biology',
				],
			],
			'8325' => [
				'c211e3'   => [
					'modern',
					'popular',
					'trending',
				],
				'325064b5' => [
					'music',
				],
				'160af3fd' => [
					'modern',
					'popular',
					'trending',
				],
				'317a0ce6' => [
					'modern',
				],
				'2c30cf7'  => [
					'modern',
					'trending',
				],
				'5e62faf8' => [
					'trending',
				],
				'51dcb0f1' => [
					'modern',
					'popular',
					'trending',
				],
				'597f2a13' => [
					'modern',
					'popular',
					'trending',
				],
				'43ce72df' => [
					'modern',
					'popular',
				],
				'281e9774' => [
					'popular',
					'trending',
				],
			],
			'8420' => [
				'206b67f9' => [
					'politics',
				],
				'5f18a56'  => [
					'sports',
				],
				'1117147a' => [
					'nature',
					'adventure',
				],
				'6739acee' => [
					'politics',
				],
				'31fa8f8d' => [
					'finance',
				],
				'6535ce99' => [
					'action',
					'design',
					'graphics',
					'politics',
					'music',
					'football',
				],
				'6be0d775' => [
					'medical',
				],
				'1df0de12' => [
					'wedding',
					'adventure',
				],
				'99fbb91'  => [
					'sports',
					'politics',
					'business',
				],
			],
			'8422' => [
				'5aaeba0f' => [
					'politics',
				],
				'3a06144b' => [
					'politics',
				],
				'2408d93a' => [
					'fashion',
				],
				'765c42a7' => [
					'politics',
				],
				'5aa39613' => [
					'politics',
				],
				'142b5fcf' => [
					'politics',
				],
				'31563439' => [
					'technology',
				],
				'266a4d18' => [
					'fashion',
				],
				'616d9780' => [
					'fashion',
				],
				'20f5ee3d' => [
					'sports',
				],
				'22678a81' => [
					'life-style',
				],
				'5ed5c8e'  => [
					'sports',
					'politics',
					'business',
				],
			],
			'8791' => [
				'5eb900a7' => [
					'gadget',
				],
				'2b2d049d' => [
					'gadget',
				],
				'28f68d26' => [
					'gadget',
				],
				'1949b2d7' => [
					'gadget',
				],
				'37d4ba9d' => [
					'gadget',
				],
				'720f85b7' => [
					'action',
				],
				'7047a17b' => [
					'gadget',
				],
				'42b12d32' => [
					'gadget',
				],
			],
			'8793' => [
				'15b6699c' => [
					'automotive',
				],
				'3e89dda'  => [
					'automotive',
				],
				'446ce434' => [
					'automotive',
				],
				'2b75fa2e' => [
					'automotive',
					'service',
					'repair',
					'review',
				],
				'c72e4b9'  => [
					'automotive',
				],
				'77a32dfa' => [
					'automotive',
				],
				'2f6a2f66' => [
					'review',
				],
				'3a7bf8c1' => [
					'review',
				],
				'30f86c2e' => [
					'automotive',
				],
			],
			'9059' => [
				'48b8295a' => [
					'crypto',
				],
				'7043b890' => [
					'crypto',
				],
				'192cde69' => [
					'business',
				],
				'4cb0e229' => [
					'mobiles',
					'tech',
				],
				'69fe6462' => [
					'fashion',
					'canada',
					'business',
					'crypto',
					'world',
					'economy',
				],
				'ec835e4'  => [
					'crypto',
				],
				'3c16a81e' => [
					'crypto',
				],
				'37fb84a9' => [
					'crypto',
				],
				'57504125' => [
					'review',
					'crypto',
				],
			],
			'9180' => [
				'2c36393d' => [
					'obituaries',
				],
				'58f2b740' => [
					'obituaries',
				],
				'4bf61fa4' => [
					'obituaries',
				],
				'68d8458f' => [
					'obituaries',
					'covid-19',
					'army',
					'accident',
				],
				'223fa9b7' => [
					'obituaries',
				],
				'176568bf' => [
					'obituaries',
				],
				'7f664e74' => [
					'obituaries',
				],
				'2b8e4b3c' => [
					'obituaries',
				],
			],
			'9188' => [
				'73188855' => [
					'funny',
				],
				'4225d1f6' => [
					'funny',
				],
				'33500fb8' => [
					'science',
				],
				'448cd804' => [
					'action',
					'racing',
					'funny',
					'animated',
					'science',
					'place',
				],
				'313eade9' => [
					'funny',
				],
				'4f4bbe4a' => [
					'funny',
				],
				'3bd43a54' => [
					'fighter',
					'action',
					'racing',
					'funny',
				],
			],
			'9193' => [
				'5fab8026' => [
					'furniture',
				],
				'd9a0ba2'  => [
					'furniture',
				],
				'1453c499' => [
					'furniture',
				],
				'330fcda0' => [
					'furniture',
				],
				'2db4c23b' => [
					'gadget',
					'science',
					'furniture',
					'decoration',
					'inspiration',
					'design',
				],
				'6d4a17eb' => [
					'furniture',
				],
				'42bfba4f' => [
					'furniture',
				],
				'4d6aa56'  => [
					'furniture',
				],
			],
			'9475' => [
				'39069fd'  => [
					'business',
				],
				'4239a8a8' => [
					'business',
				],
				'6f9a3521' => [
					'business',
				],
				'37101f53' => [
					'business',
				],
				'432efc04' => [
					'business',
				],
				'67d269'   => [
					'business',
					'finance',
					'economy',
					'nature',
					'service',
					'place',
				],
				'62a0687b' => [
					'business',
				],
				'6818c10b' => [
					'finance',
				],
				'95e559a'  => [
					'business',
				],
			],
			'9477' => [
				'33484100' => [
					'podcast',
				],
				'74564576' => [
					'podcast',
				],
				'5b3c8a9f' => [
					'podcast',
				],
				'703ec054' => [
					'podcast',
				],
				'12674a87' => [
					'podcast',
				],
				'9ba2f51'  => [
					'podcast',
				],
				'5685879'  => [
					'podcast',
				],
				'138a578c' => [
					'thriller',
					'horror',
					'life-style',
					'motivation',
					'business',
					'music',
				],
				'19db3a7'  => [
					'podcast',
				],
				'34d74c6b' => [
					'podcast',
				],
			],
			'9479' => [
				'bf914ff'  => [
					'movie',
				],
				'55fcf8dd' => [
					'science',
					'thriller',
					'horror',
				],
				'1727b0b1' => [
					'movie',
				],
				'1df50b2e' => [
					'science',
				],
				'27e76547' => [
					'movie',
				],
				'4b668920' => [
					'science',
					'science-fiction',
					'thriller',
					'horror',
				],
				'1403fdfc' => [
					'movie',
				],
			],
		];

		return $this;
	}

	/**
	 * Sets the list of theme demos.
	 *
	 * @return $this
	 */
	private function demos() {
		$this->data['demo'] = [
			[
				'name'    => __( 'Home 01', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot1.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/',
			],
			[
				'name'    => __( 'Home 02', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot2.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-02/',
			],
			[
				'name'    => __( 'Home 03', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot3.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-03/',
			],
			[
				'name'    => __( 'Home 04', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot4.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-04/',
			],
			[
				'name'    => __( 'Home 05', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot5.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-05/',
			],
			[
				'name'    => __( 'Home 06', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot6.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-06/',
			],
			[
				'name'    => __( 'Home 07', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot7.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-07/',
			],
			[
				'name'    => __( 'Home 08', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot8.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-08/',
			],
			[
				'name'    => __( 'Home 09', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot9.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-09/',
			],
			[
				'name'    => __( 'Home 10', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot10.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-10/',
			],
			[
				'name'    => __( 'Home 11', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot11.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-11/',
			],
			[
				'name'    => __( 'Home 12', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot12.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-12/',
			],
			[
				'name'    => __( 'Home 13', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot13.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-13/',
			],
			[
				'name'    => __( 'Home 14', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot14.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-14/',
			],
			[
				'name'    => __( 'Home 15', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot15.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-15/',
			],
			[
				'name'    => __( 'Home 16', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot16.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-16/',
			],
			[
				'name'    => __( 'Home 17', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot17.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-17/',
			],
			[
				'name'    => __( 'Home 18', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot18.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-18/',
			],
			[
				'name'    => __( 'Home 19', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot19.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-19/',
			],
			[
				'name'    => __( 'Home 20', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot20.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-20/',
			],
			[
				'name'    => __( 'Home 21', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot21.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-21/',
			],
			[
				'name'    => __( 'Home 22', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot22.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-22/',
			],
			[
				'name'    => __( 'Home 23', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot23.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-23/',
			],
			[
				'name'    => __( 'Home 24', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot24.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-24/',
			],
			[
				'name'    => __( 'Home 25', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot25.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-25/',
			],
			[
				'name'    => __( 'Home 26', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot26.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-26/',
			],
			[
				'name'    => __( 'Home 27', 'my-plugin-text-domain' ),
				'preview' => plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/screenshot27.jpg',
				'demo'    => 'https://radiustheme.com/demo/wordpress/themes/neeon/home-27/',
			],
		];

		return $this;
	}

	/**
	 * Sets the list of menus.
	 *
	 * @return $this
	 */
	private function menus() {
		$this->data['menus'] = [
			[
				'menu_location' => 'primary',
				'menu_name'     => 'Primary Menu',
			],
			[
				'menu_location' => 'topright',
				'menu_name'     => 'Primary Menu',
			],
		];

		return $this;
	}

	/**
	 * Sets the list of required plugins.
	 *
	 * @return void
	 */
	private function plugins() {
		$this->data['plugins'] = [
			[
				'name'        => 'RT Framework',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'rt-framework',
				'source'      => get_template_directory_uri() . '/inc/plugins/rt-framework.zip',
				'required'    => true,
			],
			[
				'name'        => 'Breadcrumb NavXT',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'breadcrumb-navxt',
				'required'    => true,
			],
			[
				'name'        => 'Elementor Page Builder',
				'description' => 'This plugin is <b><i>Required</i></b>.',
				'slug'        => 'elementor',
				'required'    => true,
			],
			[
				'name'        => 'Review Schema',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'review-schema',
				'required'    => false,
			],
			[
				'name'        => 'Review Schema Pro',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'review-schema-pro',
				'source'      => get_template_directory_uri() . '/inc/plugins/review-schema-pro.zip',
				'required'    => false,
			],
			[
				'name'        => 'AMP',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'amp',
				'required'    => false,
			],
			[
				'name'        => 'Radius AMP',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'radius-amp',
				'source'      => get_template_directory_uri() . '/inc/plugins/radius-amp.zip',
				'required'    => false,
			],
			[
				'name'        => 'WP Fluent Forms',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'fluentform',
				'required'    => false,
			],
			[
				'name'        => 'AccessPress Social Counter',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'accesspress-social-counter',
				'required'    => false,
			],
			[
				'name'        => 'Woocommerce',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'woocommerce',
				'required'    => false,
			],
			[
				'name'        => 'YITH WooCommerce Quick View',
				'description' => 'This plugin is <b><i>Optional</i></b>.',
				'slug'        => 'yith-woocommerce-quick-view',
				'required'    => false,
			],
		];
	}
}
