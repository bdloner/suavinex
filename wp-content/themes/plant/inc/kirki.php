<?php
/**
 * Kirki Config
 */
Kirki::add_config( 'plant', [
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
] );
Kirki::add_section( 'header', [
	'title'          => __( 'Header' , 'plant'),
	'panel'          => '',
	'priority'       => 82,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
] );
Kirki::add_section( 'body', [
	'title'          => __( 'Body' , 'plant'),
	'description'    => '',
	'panel'          => '',
	'priority'       => 83,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
] );
if ( class_exists( 'WooCommerce' ) ) {
	Kirki::add_section( 'shop', [
		'title'          => __( 'More Settings' , 'plant'),
		'description'    => '',
		'panel'          => 'woocommerce',
		'priority'       => 83,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
	] );
}
Kirki::add_section( 'footer', [
	'title'          => __( 'Footer' , 'plant'),
	'panel'          => '',
	'priority'       => 90,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
] );
Kirki::add_section( 'chat_buttons', [
	'title'          => __( 'Chat Buttons' , 'plant'),
	'panel'          => '',
	'priority'       => 91,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
] );
Kirki::add_section( 'general', [
	'title'          => __( 'Other' , 'plant'),
	'description'    => __( 'Other settings', 'plant' ),
	'panel'          => '',
	'priority'       => 99,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
] );

/* COLOR */
Kirki::add_field( 'plant', [
	'type'        => 'multicolor',
	'settings'    => 'color_accent',
	'label'       => __( 'Accent Color', 'plant' ),
	'description' => __( 'Highlight color such as links.', 'plant' ),
	'section'     => 'title_tagline',
	'choices'     => [
        'link'    	=> esc_html__( 'Accent', 'plant' ),
        'hover'   	=> esc_html__( 'Accent: Hover', 'plant' ),
    ],
    'default'     	=> [
        'link'    	=> '#0f6b4e',
        'hover'   	=> '#03a572',
	],
	'output' => [
		[
			'choice'   => 'link',
			'element'  => ':root',
            'property' => '--s-accent',
		],
		[
			'choice'   => 'hover',
			'element'  => ':root',
            'property' => '--s-accent-hover',
        ],
	],
	'transport'       => 'auto',
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_style',
	'label'       => '',
	'section'     => 'title_tagline',
	'default'     => '<style type="text/css">._h{background-color: rgba(0,0,0,0.4);padding: 3px 12px;margin:6px -12px 0;color:#fff;font-weight: normal;font-size:12px}</style>',
] );

/* HEADER */
Kirki::add_field( 'plant', [
	'settings'    => 'header_style_d',
    'label'       => __( 'Header Style', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'autoshow',
	'priority'    => 10,
	'choices'     => [
        'autoshow' => esc_html__( 'Auto Show', 'plant' ),
        'fixed'     => esc_html__( 'Fixed', 'plant' ),
        'standard'  => esc_html__( 'Standard', 'plant' ),      
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'header_layout',
	'label'       => __( 'Logo Position', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'left-logo',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'left-logo'		=> esc_attr__( 'Left Logo', 'plant' ),
		'top-logo'  	=> esc_attr__( 'Top Logo', 'plant' ),
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'header_center_menu',
	'label'       => __( 'Center Menu?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_height_d',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Header Height', 'plant' ),
	'section'     => 'header',
	'default'     => '70px',
	'output' => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'   	=> ':root',
            'property'  	=> '--s-header-height',
		],
	],
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_logo_height_d',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Logo Height', 'plant' ),
	'section'     => 'header',
	'default'     => '50px',
	'output' => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'   	=> '.site-branding img',
            'property'  	=> 'max-height',
		],
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'   	=> '.site-branding img',
            'property'  	=> 'height',
        ],
    ],
] );

Kirki::add_field( 'plant', [
	'type'        => 'dimension',
	'settings'    => 'head_logo_padding_top',
	'label'       => esc_html__( 'Logo Top Space', 'plant' ),
	'section'     => 'header',
	'default'     => '20px',
    'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
        ]
	],
	'output' => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'  		=> '.site-header.-top-logo .site-branding',
			'property' 		=> 'padding-top',
		],
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'dimension',
	'settings'    => 'head_nav_height',
	'label'       => esc_html__( 'Menu Height', 'plant' ),
	'section'     => 'header',
	'default'     => '60px',
    'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
        ]
	],
	'output' => [
		[
			'element'  => '.site-header.-top-logo .site-nav-d, .site-header.-top-logo .site-action',
			'property' => 'height',
		],
	],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'hide_title',
	'label'       => __( 'Hide Site Title?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'head_shadow',
	'label'       => __( 'Has Shadow?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'color',
	'settings'    => 'head_shadow_color',
	'label'       => __( 'Shadow Color', 'plant' ),
	'section'     => 'header',
	'default'     => 'rgba(0,0,0,0.1)',
	'choices'     => [
		'alpha' => true,
    ],
    'active_callback' => [
	    [
		'setting'  => 'head_shadow',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'slider',
	'settings'    => 'head_shadow_blur',
	'label'       => esc_html__( 'Shadow Blur', 'plant' ),
	'section'     => 'header',
	'default'     => 5,
	'choices'     => [
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
    ],
    'active_callback' => [
	    [
		'setting'  => 'head_shadow',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'hide_arrowdown_desktop',
	'label'       => __( 'Hide arrow down icon on menu?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
	'output'	  => [
		[
		'element'       => '.si-down',
		'property'      => 'display',
		'value_pattern' => 'none',
		'media_query'   => '@media all and (min-width: 992px)',
		'exclude'       => [ false, 0, '0', 'false' ]
		]
	],
] );
if ( class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' )) {
	Kirki::add_field( 'plant', [
		'settings'    => 'header_action',
		'label'       => __( 'Action Icon', 'plant' ),
		'section'     => 'header',
		'type'        => 'multicheck',
		'default'     => array('search'),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => [
			'search'  	=> esc_attr__( 'Search', 'plant' ),
			'cart'      => esc_attr__( 'Cart', 'plant' ),
			'my-account'=> esc_attr__( 'My Account', 'plant' ),
			'custom'	=> esc_attr__( 'Custom', 'plant' ),
		],
	] );
} else {
	Kirki::add_field( 'plant', [
		'settings'    => 'header_action',
		'label'       => __( 'Action Icon', 'plant' ),
		'section'     => 'header',
		'type'        => 'multicheck',
		'default'     => array('search'),
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => [
			'search'  	=> esc_attr__( 'Search', 'plant' ),
			'custom'	=> esc_attr__( 'Custom', 'plant' ),
		],
	] );
}
Kirki::add_field( 'plant', [
	'type'     => 'code',
	'settings' => 'header_action_custom',
	'label'    => esc_html__( 'Custom HTML and Shortcode', 'plant' ),
	'section'  => 'header',
    'priority' => 10,
    'choices'     => [
		'language' => 'html',
	],
    'active_callback' => [
	    [
		'setting'  => 'header_action',
		'operator' => 'in',
		'value'    => array('custom'),
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'cart_icon',
	'label'       => __( 'Cart Icon', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'shopping-cart',
	'priority'    => 10,
	'choices'     => [
        'shopping-cart'		=> '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
        'shopping-bag'    	=> '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>',
    ],
    'active_callback' => [
	    [ 
		    'setting'  => 'header_action',
		    'operator' => 'in',
		    'value'    => array('cart'),
	    ]
    ],
] );

Kirki::add_field( 'plant', [
	'settings'    => 'header_effect',
    'label'       => __( 'Header Effect on Homepage', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'none',
	'priority'    => 10,
	'choices'     => [
        'none' 		=> esc_html__( 'None', 'plant' ),
        'slide-in'  => esc_attr__( 'Slide In', 'plant' ),
        'overlay'  	=> esc_attr__( 'Overlay', 'plant' ),
    ],
] );


Kirki::add_field( 'plant', [
    'settings'    => 'header_scroll',
    'type'        => 'number',
	'label'       => esc_html__( 'Scroll before fade in', 'plant' ),
	'section'     => 'header',
	'default'     => '300',
	'choices'     => [
		'min'  => 1,
		'max'  => 900,
		'step' => 1,
	],
	'active_callback' => [
	    [
		'setting'  => 'header_effect',
		'operator' => '==',
		'value'    => 'slide-in',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'head_adjust_more',
	'label'       => __( 'Adjust Size and Dimension?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_font_size',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Font Size', 'plant' ),
	'description' => esc_html__( 'Such as 16px, 1.125em (18px).' , 'plant' ),
	'section'     => 'header',
	'default'     => '1em',
	'output' => [
		[
			'element'   	=> '.site-header',
            'property'  	=> 'font-size',
		],
    ],
	'active_callback' => [
	    [
		'setting'  => 'head_adjust_more',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_max_width',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Max Header Width', 'plant' ),
	'description' => esc_html__( 'Such as 1170px, 100%.' , 'plant' ),
	'section'     => 'header',
	'default'     => '1170px',
	'output' => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'   	=> '.site-header > .s-container',
            'property'  	=> 'max-width',
		],
    ],
	'active_callback' => [
	    [
		'setting'  => 'head_adjust_more',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_submenu_width',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Sub Menu Width', 'plant' ),
	'section'     => 'header',
	'default'     => '180px',
	'output' => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element'   	=> '.site-nav-d ul.sub-menu',
            'property'  	=> 'min-width',
		],
    ],
	'active_callback' => [
	    [
		'setting'  => 'head_adjust_more',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_header_color',
	'label'       => '',
	'section'     => 'header',
	'default'     => '<div class="_h">Colors</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'color_header',
	'label'       => __( 'Adjust header colors?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'background',
	'settings'    => 'header_bg',
	'label'       => __( 'Background for whole header', 'plant' ),
	'section'     => 'header',
	'default'     => [
		'background-color'      => '#ffffff',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => 'header.site-header, .site-nav-d ul.sub-menu',
        ],
	],
	'active_callback' => [
	    [
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'hr_header_bg',
	'label'       => '',
	'section'     => 'header',
	'default'     => '<hr>',
	'priority'    => 10,
	'active_callback' => [
	    [
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'background',
	'settings'    => 'header_logo_bg',
	'label'       => __( 'Background for Logo section', 'plant' ),
	'section'     => 'header',
	'default'     => [
		'background-color'      => 'rgba(255,255,255,0)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
		],
		[
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
	],
	'output'      => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element' => '.site-header.-top-logo .site-branding ',
		],
		[
			'media_query'	=> '@media(max-width: 991px)',
			'element' => '.site-header.-top-logo',
        ],
    ],
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'hr_header_logo_bg',
	'label'       => '',
	'section'     => 'header',
	'default'     => '<hr>',
	'priority'    => 10,
	'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
		],
		[
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );

Kirki::add_field( 'plant', [
	'type'        => 'background',
	'settings'    => 'header_nav_bg',
	'label'       => __( 'Background for Menu section', 'plant' ),
	'section'     => 'header',
	'default'     => [
		'background-color'      => 'rgba(255,255,255,0)',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
		],
		[
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
	],
	'output'      => [
		[
			'media_query'	=> '@media(min-width: 992px)',
			'element' => '.site-header.-top-logo .site-navbar, .site-nav-d ul.sub-menu',
		],
    ],
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'hr_header_nav_bg',
	'label'       => '',
	'section'     => 'header',
	'default'     => '<hr>',
	'priority'    => 10,
	'active_callback' => [
	    [
		'setting'  => 'header_layout',
		'operator' => '==',
		'value'    => 'top-logo',
		],
		[
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );


Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'head_colors',
    'label'       => esc_html__( 'Link Colors', 'plant' ),
    'section'     => 'header',
    'priority'    => 10,
    'choices'     => [
        'link'    	=> esc_html__( 'Link', 'plant' ),
        'hover'   	=> esc_html__( 'Link: Hover', 'plant' ),
		'active'  	=> esc_html__( 'Link: Active', 'plant' ),
		'active_bg' => esc_html__( 'Link: Active Background', 'plant' ),
		'sub_border'=> esc_html__( 'Sub Menu Border', 'plant' ),
    ],
    'default'     	=> [
		'link'    	=> '#222',
        'hover'   	=> '#0f6b4e',
		'active'  	=> '#878f9d',
		'active_bg' => 'rgba(255,255,255,0)',
		'sub_border'=> 'rgba(0,0,0,0.15)',
	],
	'output' => [
        [
			'choice'   => 'link',
			'element'  => 'header.site-header, header.site-header li a, header.site-header .si-down',
			'property' => '--s-text',
		],
		[
			'choice'   => 'hover',
			'element'  => 'header.site-header li a:hover, header.site-header li:hover a, header.site-header li:hover .si-down, header.site-header a:not(.s-button):hover',
			'property' => '--s-accent-hover',
			'media_query'	=> '@media(min-width: 992px)',
        ],
		[
			'choice'   => 'active',
			'element'  => '.site-header li a:active, .site-nav-d li.current-menu-item > a, .site-nav-d li.current-menu-ancestor > a, .site-nav-d li.current_page_item > a',
			'property' => 'color',
		],
		[
			'choice'   => 'active_bg',
			'element'  => '.site-header li:active, .site-nav-d li.current-menu-item, .site-nav-d li.current-menu-ancestor, .site-nav-d li.current_page_item',
			'property' => 'background-color',
		],
		[
			'choice'   => 'sub_border',
			'element'  => 'nav.site-nav-d .sub-menu li a',
			'property' => '--s-line',
        ],
	],
	'transport'       => 'auto',
	'active_callback' => [
	    [
		'setting'  => 'color_header',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_mobile',
	'label'       => '',
	'section'     => 'header',
	'default'     => '<div class="_h">For Mobile</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_mobile_desc',
	'label'       => '',
	'description' => __( 'Click on mobile icon at the bottom right of this sidebar.', 'plant' ),
	'section'     => 'header',
	'default'     => '',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'header_style_m',
    'label'       => __( 'Header Style', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'autoshow',
	'priority'    => 10,
	'choices'     => [
        'autoshow' => esc_html__( 'Auto Show', 'plant' ),
        'fixed'     => esc_attr__( 'Fixed', 'plant' ),
        'standard'  => esc_attr__( 'Standard', 'plant' ),
    ],
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_height_m',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Header Height', 'plant' ),
	'section'     => 'header',
	'default'     => '50px',
	'output' => [
		[
			'media_query'	=> '@media(max-width: 991px)',
			'element'   	=> ':root',
            'property'  	=> '--s-header-height',
		],
	],
] );
Kirki::add_field( 'plant', [
    'settings'    => 'head_logo_height_m',
    'type'        => 'dimension',
	'label'       => esc_html__( 'Logo Height', 'plant' ),
	'section'     => 'header',
	'default'     => '30px',
	'output' => [
		[
			'media_query'	=> '@media(max-width: 991px)',
			'element'   	=> '.site-branding img',
            'property'  	=> 'max-height',
		],
		[
			'media_query'	=> '@media(max-width: 991px)',
			'element'   	=> '.site-branding img',
            'property'  	=> 'height',
        ],
    ],
] );

Kirki::add_field( 'plant', [
	'type'        => 'image',
	'settings'    => 'head_logo_img_m',
	'label'       => esc_html__( 'Logo Image', 'plant' ),
	'section'     => 'header',
	'default'     => '',
	'choices'     => [
		'save_as' => 'id',
	],
] );

Kirki::add_field( 'plant', [
	'settings'    => 'hide_title_m',
	'label'       => __( 'Hide Site Title?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );

Kirki::add_field( 'plant', [
	'settings'    => 'header_layout_m',
    'label'       => __( 'Logo Layout', 'plant' ),
	'section'     => 'header',
	'type'        => 'radio-buttonset',
	'default'     => 'center-logo',
	'priority'    => 10,
	'choices'     => [
        'left-logo' 	=> esc_html__( 'Left', 'plant' ),
        'center-logo'   => esc_attr__( 'Center', 'plant' ),
        'right-logo'  	=> esc_attr__( 'Right', 'plant' ),
    ],
] );

Kirki::add_field( 'plant', [
	'settings'    => 'left_area',
	'label'       => __( 'Left Area', 'plant' ),
	'section'     => 'header',
	'type'        => 'select',
	'default'     => 'menu',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'menu' 	  	=> esc_attr__( 'Menu Icon', 'plant' ),
		'menu_text' => esc_attr__( 'Menu Text', 'plant' ),
        'search'  	=> esc_attr__( 'Search', 'plant' ),
        'phone'    	=> esc_attr__( 'Phone', 'plant' ),
        'custom'  	=> esc_attr__( 'Custom', 'plant' ),
	],
	'active_callback' => [
	    [
		'setting'  => 'header_layout_m',
		'operator' => '!=',
		'value'    => 'left-logo',
        ]
	],
] );
Kirki::add_field( 'plant', [
	'type'     => 'text',
	'settings' => 'left_area_phone',
	'label'    => esc_html__( 'Phone No.', 'plant' ),
	'section'  => 'header',
    'priority' => 10,
    'active_callback' => [
	    [
		'setting'  => 'left_area',
		'operator' => '==',
		'value'    => 'phone',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'     => 'text',
	'settings' => 'left_area_menu_text',
	'label'    => esc_html__( 'Text in Menu', 'plant' ),
	'section'  => 'header',
	'priority' => 10,
	'default'     => 'MENU',
    'active_callback' => [
	    [
		'setting'  => 'left_area',
		'operator' => '==',
		'value'    => 'menu_text',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'     => 'code',
	'settings' => 'left_area_custom',
	'label'    => esc_html__( 'Custom HTML', 'plant' ),
	'section'  => 'header',
    'priority' => 10,
    'choices'     => [
		'language' => 'html',
	],
    'active_callback' => [
	    [
		'setting'  => 'left_area',
		'operator' => '==',
		'value'    => 'custom',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'right_area',
	'label'       => __( 'Right Area', 'plant' ),
	'section'     => 'header',
	'type'        => 'select',
	'default'     => 'search',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'menu' 	  => esc_attr__( 'Menu', 'plant' ),
		'menu_text' => esc_attr__( 'Menu Text', 'plant' ),
        'search'  => esc_attr__( 'Search', 'plant' ),
		'phone'   => esc_attr__( 'Phone', 'plant' ),
		'member'  => esc_attr__( 'Member', 'plant' ),
		'cart'  	=> esc_attr__( 'Cart', 'plant' ),
        'custom'  => esc_attr__( 'Custom', 'plant' ),
	],
	'active_callback' => [
	    [
		'setting'  => 'header_layout_m',
		'operator' => '!=',
		'value'    => 'right-logo',
        ]
	],
] );
Kirki::add_field( 'plant', [
	'type'     => 'text',
	'settings' => 'right_area_phone',
	'label'    => esc_html__( 'Phone No.', 'plant' ),
	'section'  => 'header',
    'priority' => 10,
    'active_callback' => [
	    [
		'setting'  => 'right_area',
		'operator' => '==',
		'value'    => 'phone',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'     => 'text',
	'settings' => 'right_area_menu_text',
	'label'    => esc_html__( 'Text in Menu', 'plant' ),
	'section'  => 'header',
	'priority' => 10,
	'default'     => 'MENU',
    'active_callback' => [
	    [
		'setting'  => 'right_area',
		'operator' => '==',
		'value'    => 'menu_text',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'     => 'code',
	'settings' => 'right_area_custom',
	'label'    => esc_html__( 'Custom HTML', 'plant' ),
	'section'  => 'header',
    'priority' => 10,
    'choices'     => [
		'language' => 'html',
	],
    'active_callback' => [
	    [
		'setting'  => 'right_area',
		'operator' => '==',
		'value'    => 'custom',
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'color_header_m',
	'label'       => __( 'Adjust Mobile colors?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'menu_colors',
	'label'       => esc_html__( 'Mobile Menu Colors', 'plant' ),
	'description' => 'Click mobile menu (three-line) to show.',
    'section'     => 'header',
    'priority'    => 10,
    'choices'     => [
		'text'	  => esc_html__( 'Text and Icon', 'plant' ),
        'bg'      => esc_html__( 'Background', 'plant' ),
        'link'    => esc_html__( 'Link', 'plant' ),
		'border'  => esc_html__( 'Border', 'plant' ),
    ],
    'default'     => [
		'text'    => '#222',
        'bg'      => '#222',
        'link'    => 'rgba(255,255,255,0.9)',
		'border'  => 'rgba(255,255,255,0.15)',
	],
	'output' => [
		[
			'choice'   => 'text',
			'media_query'	=> '@media(max-width: 991px)',
			'element'  => 'header.site-header, header.site-header a',
			'property' => '--s-text',
        ],
		[
			'choice'   => 'bg',
			'element'  => '.site-nav-m',
			'property' => '--s-bg',
        ],
        [
			'choice'   => 'link',
			'element'  => 'header.site-header .site-nav-m a',
			'property' => '--s-text',
		],
		[
			'choice'   => 'border',
			'element'  => '.site-nav-m',
			'property' => '--s-line',
        ],
	],
	'transport'       => 'auto',
	'active_callback' => [
	    [
		'setting'  => 'color_header_m',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'hide_arrowdown_mobile',
	'label'       => __( 'Hide arrow down icon on menu?', 'plant' ),
	'section'     => 'header',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
	'output'	  => [
		[
		'element'       => '.si-down',
		'property'      => 'display',
		'value_pattern' => 'none',
		'media_query'   => '@media all and (max-width: 991px)',
		'exclude'       => [ false, 0, '0', 'false' ]
		]
	],
] );


/* BODY */
Kirki::add_field( 'plant', [
	'settings'    => 'color_body',
	'label'       => __( 'Adjust body colors?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'body_bg',
    'label'       => esc_html__( 'Background Color', 'plant' ),
    'section'     => 'body',
    'priority'    => 10,
    'choices'     => [
		'home'    		=> esc_html__( 'Homepage', 'plant' ),
		'single_post'   => esc_html__( 'Single Post', 'plant' ),
		'archive'   => esc_html__( 'Archive', 'plant' ),
		'other'   		=> esc_html__( 'Other Pages', 'plant' ),
    ],
    'default'     => [
		'home'    		=> '#f5f5f7',
		'single_post'   => '#ffffff',
		'archive'   	=> '#f5f5f7',
		'other'   		=> '#ffffff',
	],
	'output' => [
		[
			'choice'   => 'home',
			'element'  => 'body.home',
			'property' => 'background-color',
		],
		[
			'choice'   => 'single_post',
			'element'  => 'body.single-post',
			'property' => 'background-color',
		],
		[
			'choice'   => 'archive',
			'element'  => 'body.archive',
			'property' => 'background-color',
		],
		[
			'choice'   => 'other',
			'element'  => 'html body',
			'property' => 'background-color',
		],
	],
	'active_callback' => [
	    [
		'setting'  => 'color_body',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_banner',
	'label'       => '',
	'section'     => 'body',
	'default'     => '<div class="_h">Default Title &amp; Banner</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'body_title_style',
	'label'       => __( 'Title Style', 'plant' ),
	'section'     => 'body',
	'type'        => 'select',
	'default'     => 'banner',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'banner'  => esc_attr__( 'Banner', 'plant' ),
		'minimal' => esc_attr__( 'Minimal', 'plant' ),
    ],
] );
Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'body_title_color_minimal',
    'label'       => esc_html__( 'Title Colors', 'plant' ),
    'section'     => 'body',
    'priority'    => 10,
    'choices'     => [
		'color'   => esc_html__( 'Text Color', 'plant' ),
		'hover'   => esc_html__( 'Text Hover', 'plant' ),
    ],
    'default'     => [
		'color'   => '#111111',
		'hover'   => '#0f6b4e',
	],
	'output' => [
		[
			'choice'   => 'color',
			'element'  => '.main-header a',
			'property' => 'color',
		],
		[
			'choice'   => 'hover',
			'element'  => '.main-header a:hover',
			'property' => 'color',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'body_title_style',
			'operator' => '==',
			'value'    => 'minimal',
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'image',
	'settings'    => 'body_title_banner',
	'label'       => esc_html__( 'Banner Image', 'plant' ),
	'section'     => 'body',
	'default'     => '',
	'active_callback' => [
		[
			'setting'  => 'body_title_style',
			'operator' => '==',
			'value'    => 'banner',
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'slider',
	'settings'    => 'body_title_banner_blur',
	'label'       => esc_html__( 'Banner Blur', 'plant' ),
	'section'     => 'body',
	'default'     => 20,
	'choices'     => [
		'min'  => 0,
		'max'  => 40,
		'step' => 5,
	],
	'active_callback' => [
		[
			'setting'  => 'body_title_style',
			'operator' => '==',
			'value'    => 'banner',
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'slider',
	'settings'    => 'body_title_banner_opacity',
	'label'       => esc_html__( 'Banner Opacity', 'plant' ),
	'section'     => 'body',
	'default'     => 0.7,
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.05,
	],
	'active_callback' => [
		[
			'setting'  => 'body_title_style',
			'operator' => '==',
			'value'    => 'banner',
		]
	],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'body_title_hidden',
	'label'       => __( 'Hide Title on all Pages?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );


Kirki::add_field( 'plant', [
	'settings'    => 'body_title_single',
	'label'       => __( 'Banner setting for Post?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'body_title_style',
			'operator' => '==',
			'value'    => 'banner',
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'slider',
	'settings'    => 'body_title_single_banner_blur',
	'label'       => esc_html__( 'Banner Blur for Post', 'plant' ),
	'section'     => 'body',
	'default'     => 20,
	'choices'     => [
		'min'  => 0,
		'max'  => 40,
		'step' => 5,
	],
	'active_callback' => [
		[
			'setting'  => 'body_title_single',
			'operator' => '==',
			'value'    => '1',
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'slider',
	'settings'    => 'body_title_single_banner_opacity',
	'label'       => esc_html__( 'Banner Opacity for Post', 'plant' ),
	'section'     => 'body',
	'default'     => 0.7,
	'choices'     => [
		'min'  => 0,
		'max'  => 1,
		'step' => 0.05,
	],
	'active_callback' => [
		[
			'setting'  => 'body_title_single',
			'operator' => '==',
			'value'    => '1',
		]
	],
] );


Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_blog',
	'label'       => '',
	'section'     => 'body',
	'default'     => '<div class="_h">For Single Post</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_profile',
	'label'       => __( 'Show Author Profile?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => '1',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_comments',
	'label'       => __( 'Enable WP Comments?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_related',
	'label'       => __( 'Enable Related Posts?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_related_title',
	'label'       => __( 'Title', 'plant' ),
	'section'     => 'body',
	'type'        => 'text',
	'default'  	  => 'Related Posts',
	'active_callback' => [
		[
			'setting'  => 'blog_related',
			'operator' => '==',
			'value'    => 1,
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_related_num',
	'label'       => __( 'Number of Related Posts', 'plant' ),
	'section'     => 'body',
	'default'     => '3',
	'choices'     => [
		'3'	=> '3',
		'6'	=> '6',
    ],
	'active_callback' => [
		[
			'setting'  => 'blog_related',
			'operator' => '==',
			'value'    => 1,
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'multicolor',
	'settings'    => 'blog_related_colors',
	'label'       => __( 'Colors', 'plant' ),
	'section'     => 'body',
	'choices'     => [
		'related-bg'    	=> esc_html__( 'Background', 'plant' ),
		'related-text'   	=> esc_html__( 'Title', 'plant' ),
	],
	'default'     	=> [
		'related-bg'    	=> '#f1f1f3',
		'related-text'   	=> '#222',
	],
	'output' => [
		[
			'choice'   => 'related-bg',
			'element'  => '.single-related',
			'property' => '--s-light',
		],
		[
			'choice'   => 'related-text',
			'element'  => '.single-related .s-title',
			'property' => '--s-text',
		],
	],
	'transport'       => 'auto',
	'active_callback' => [
		[
			'setting'  => 'blog_related',
			'operator' => '==',
			'value'    => 1,
		]
	],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_layout_single',
	'label'       => __( 'Sidebar', 'plant' ),
	'section'     => 'body',
	'type'        => 'select',
	'default'     => 'full-width',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'full-width' => esc_attr__( 'No Sidebar', 'plant' ),
		'rightbar'   => esc_attr__( 'Right Sidebar', 'plant' ),
		'leftbar'    => esc_attr__( 'Left Sidebar', 'plant' ),
    ],
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_card',
	'label'       => '',
	'section'     => 'body',
	'default'     => '<div class="_h">For Archive</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_columns_d',
	'label'       => __( 'Columns on Desktop', 'plant' ),
	'section'     => 'body',
	'default'     => '3',
	'choices'     => [
		'1'	=> '1',
		'2'	=> '2',
		'3'	=> '3',
		'4'	=> '4',
		'5'	=> '5',
		'6'	=> '6',
    ],
] );
Kirki::add_field( 'plant', [
	'type'        => 'radio-buttonset',
	'settings'    => 'blog_columns_m',
	'label'       => __( 'Columns on Mobile', 'plant' ),
	'section'     => 'body',
	'default'     => '1',
	'choices'     => [
		'1'	=> '1',
		'2'	=> '2',
		'3'	=> '3',
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_archive_profile',
	'label'       => __( 'Show Author Name?', 'plant' ),
	'section'     => 'body',
	'type'        => 'toggle',
	'default'     => false,
    'priority'    => 10
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_template',
	'label'       => __( 'Template', 'plant' ),
	'section'     => 'body',
	'type'        => 'select',
	'default'     => 'card',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'card' 		=> esc_attr__( 'Card', 'plant' ),
		'list' 		=> esc_attr__( 'List', 'plant' ),
		'hero' 		=> esc_attr__( 'Hero', 'plant' ),
		'caption' 	=> esc_attr__( 'Caption', 'plant' ),
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'blog_layout',
	'label'       => __( 'Sidebar', 'plant' ),
	'section'     => 'body',
	'type'        => 'select',
	'default'     => 'standard',
	'priority'    => 10,
	'multiple'    => 1,
	'choices'     => [
		'full-width' => esc_attr__( 'No Sidebar', 'plant' ),
		'rightbar' => esc_attr__( 'Right Sidebar', 'plant' ),
		'leftbar'   => esc_attr__( 'Left Sidebar', 'plant' ),
    ],
] );

/* WOOCOMMERCE */

if ( class_exists( 'WooCommerce' ) ) {

	if (get_locale() == 'th') {
		Kirki::add_field( 'plant', [
			'settings'    => 'shop_th_style',
			'label'       => __( 'Use Thai Style?', 'plant' ),
			'description' => __( 'Use only Shipping Address, Require Address 2 (แขวง/ตำบล), Thai Baht, etc. Save and refresh to see.', 'plant' ),
			'section'     => 'shop',
			'type'        => 'toggle',
			'default'     => '1',
			'priority'    => 10,
		] );
	}
	
	Kirki::add_field( 'plant', [
		'settings'    => 'shop_layout',
		'label'       => __( 'Shop Layout', 'plant' ),
		'section'     => 'shop',
		'type'        => 'select',
		'default'     => 'full-width',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => [
			'full-width' => esc_attr__( 'No Shop Sidebar', 'plant' ),
			'rightbar' => esc_attr__( 'Right Shop Sidebar', 'plant' ),
			'leftbar'   => esc_attr__( 'Left Shop Sidebar', 'plant' ),
        ],
	] );


	Kirki::add_field( 'plant', [
		'settings'    => 'shop_style',
		'label'       => __( 'Shop Style', 'plant' ),
		'section'     => 'shop',
		'type'        => 'select',
		'default'     => 'product-grid',
		'priority'    => 10,
		'multiple'    => 1,
		'choices'     => [
			'product-grid' => esc_attr__( 'Product card with shadow', 'plant' ),
			'product-space' => esc_attr__( 'Plain with space', 'plant' ),
        ],
	] );
	
	Kirki::add_field( 'plant', [
		'type'        => 'multicolor',
		'settings'    => 'shop_bg_colors',
		'label'       => __( 'Shop Background Colors', 'plant' ),
		'section'     => 'shop',
		'choices'     => [
			'woo-bg'    	=> esc_html__( 'Page Background', 'plant' ),
			'woo-card'   	=> esc_html__( 'Product Card Background', 'plant' ),
		],
		'default'     	=> [
			'woo-bg'    	=> '#f5f5f7',
			'woo-card'   	=> '#fff',
		],
		'output' => [
			[
				'choice'   => 'woo-bg',
				'element'  => ':root',
				'property' => '--s-woo-bg',
			],
			[
				'choice'   => 'woo-card',
				'element'  => ':root',
				'property' => '--s-woo-card',
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'shop_style',
				'operator' => '==',
				'value'    => 'product-grid',
			]
		],
	] );

	Kirki::add_field( 'plant', [
		'type'        => 'dimension',
		'settings'    => 'shop_card_padding',
		'label'       => esc_html__( 'Product Card Padding', 'plant' ),
		'section'     => 'shop',
		'default'     => '10px 10px 15px',
		'output' => [
			[
				'element'  => '.products .product, .wc-block-grid__product-image',
				'property' => 'padding',
			],
		],
		'active_callback' => [
			[
				'setting'  => 'shop_style',
				'operator' => '==',
				'value'    => 'product-grid',
			]
		],
	] );

	Kirki::add_field( 'plant', [
		'settings' => 'shop_badge_color',
		'label'    => __( 'Sale Badge Color', 'plant' ),
		'description' => __( 'Show on Product Archive and Detail', 'plant' ),
		'section'  => 'shop',
		'type'     => 'color',
		'priority' => 10,
		'default'  => '#c30',
		'choices'     => [
			'alpha' => true,
        ],
		'output' => [
			[
				'element'  => '#page .onsale',
				'property' => 'background-color',
            ],
		],
	] );
	Kirki::add_field( 'plant', [
		'settings' => 'shop_price_color',
		'label'    => __( 'Price Color', 'plant' ),
		'description' => __( 'Show on Product Archive and Detail', 'plant' ),
		'section'  => 'shop',
		'type'     => 'color',
		'priority' => 10,
		'default'  => '#222',
		'choices'     => [
			'alpha' => true,
        ],
		'output' => [
			[
				'element'  => '#main .price',
				'property' => 'color',
            ],
        ],
	] );

	Kirki::add_field( 'plant', [
		'settings'    => 'shop_pagebuilder',
		'label'       => __( 'Page Builder on Shop Page?', 'plant' ),
		'description' => __( 'Show only content, not products list on Shop page.', 'plant' ),
		'section'     => 'shop',
		'type'        => 'toggle',
		'default'     => false,
		'priority'    => 10,
	] );
	Kirki::add_field( 'plant', [
		'settings'    => 'shop_hide_addtocart',
		'label'       => __( 'Hide Add to Cart Button?', 'plant' ),
		'description' => __( 'On Product Archive page.', 'plant' ),
		'section'     => 'shop',
		'type'        => 'toggle',
		'default'     => '1',
		'priority'    => 10,
	] );
	Kirki::add_field( 'plant', [
		'settings'    => 'shop_hide_related',
		'label'       => __( 'Hide Related Products?', 'plant' ),
		'description' => __( 'On Product Detail page.', 'plant' ),
		'section'     => 'shop',
		'type'        => 'toggle',
		'default'     => false,
		'priority'    => 10,
	] );

	Kirki::add_field( 'plant', [
		'type'        => 'number',
		'settings'    => 'shop_products',
		'label'       => __( 'Products Per Page', 'plant' ),
		'description' => __( 'Save and refresh to see the result.', 'plant' ),
		'section'     => 'shop',
		'default'     => 12,
		'choices'     => [
			'min'  => '1',
			'max'  => '99',
			'step' => '1',
        ],
	] );

	Kirki::add_field( 'plant', [
		'settings'    => 'shop_buttons_colors',
		'label'       => __( 'Change Button Colors?', 'plant' ),
		'description' => __( 'WooCommerce Buttons', 'plant' ),
		'section'     => 'shop',
		'type'        => 'toggle',
		'default'     => false,
		'priority'    => 10,
	] );


	Kirki::add_field( 'plant', [
		'type'        => 'custom',
		'settings'    => 'h_button_alt',
		'label'       => '',
		'section'     => 'shop',
		'default'     => '<div class="_h">Main Button</div>',
		'priority'    => 10,
		'active_callback' => [
			[
				'setting'  => 'shop_buttons_colors',
				'operator' => '==',
				'value'    => 1,
			]
		],
	] );
	Kirki::add_field( 'plant', [
		'type'        => 'multicolor',
		'settings'    => 'button_alt_colors',
		'label'       => esc_html__( 'Main Button Colors', 'plant' ),
		'section'     => 'shop',
		'priority'    => 10,
		'choices'     => [
			'bg'      	=> esc_html__( 'Background', 'plant' ),
			'bg_hover'  => esc_html__( 'Background: Hover', 'plant' ),
			'link'   	=> esc_html__( 'Text', 'plant' ),
			'link_hover'=> esc_html__( 'Text: Hover', 'plant' ),
		],
		'default'     => [
			'bg'      	=> '#0f6b4e',
			'bg_hover'  => '#60c760',
			'link'   	=> '#ffffff',
			'link_hover'=> '#ffffff',
		],
		'output' => [
			[
				'choice'   => 'bg',
				'element'  => ['.woocommerce .button.alt', '.products .product .add_to_cart_button'],
				'property' => 'background-color',
			],
			[
				'choice'   => 'bg',
				'element'  => ['.woocommerce .button.alt', '.products .product .add_to_cart_button'],
				'property' => 'border-color',
			],
			[
				'choice'   => 'bg_hover',
				'element'  => ['.woocommerce .button.alt:hover', '.products .product .add_to_cart_button:hover'],
				'property' => 'background-color',
			],
			[
				'choice'   => 'bg_hover',
				'element'  => ['.woocommerce .button.alt:hover', '.products .product .add_to_cart_button:hover'],
				'property' => 'border-color',
			],
			[
				'choice'   => 'link',
				'element'  => '.woocommerce .button.alt',
				'property' => 'color',
			],
			[
				'choice'   => 'link_hover',
				'element'  => '.woocommerce .button.alt:hover',
				'property' => 'color',
			],
	
		],
		'active_callback' => [
			[
				'setting'  => 'shop_buttons_colors',
				'operator' => '==',
				'value'    => 1,
			]
		],
	] );
	Kirki::add_field( 'plant', [
		'type'        => 'dimension',
		'settings'    => 'button_alt_border_radius',
		'label'       => esc_html__( 'Border Radius', 'plant' ),
		'section'     => 'shop',
		'default'     => '3px',
		'output' => [
			[
				'element'  => '.button, .products .product .add_to_cart_button, input.input-text, body .select2-container .select2-selection--single',
				'property' => 'border-radius',
			],
		],
		'active_callback' => [
			[
				'setting'  => 'shop_buttons_colors',
				'operator' => '==',
				'value'    => 1,
			]
		],
	] );
	Kirki::add_field( 'plant', [
		'type'        => 'custom',
		'settings'    => 'h_button',
		'label'       => '',
		'section'     => 'shop',
		'default'     => '<div class="_h">Plain Button</div>',
		'priority'    => 10,
		'active_callback' => [
			[
				'setting'  => 'shop_buttons_colors',
				'operator' => '==',
				'value'    => 1,
			]
		],
	] );
	Kirki::add_field( 'plant', [
		'type'        => 'multicolor',
		'settings'    => 'button_colors',
		'label'       => esc_html__( 'Plain Button Colors', 'plant' ),
		'section'     => 'shop',
		'priority'    => 10,
		'choices'     => [
			'bg'      	=> esc_html__( 'Background', 'plant' ),
			'bg_hover'  => esc_html__( 'Background: Hover', 'plant' ),
			'link'   	=> esc_html__( 'Text', 'plant' ),
			'link_hover'=> esc_html__( 'Text: Hover', 'plant' ),
		],
		'default'     => [
			'bg'      	=> '#878f9d',
			'bg_hover'  => '#575f6d',
			'link'   	=> '#ffffff',
			'link_hover'=> '#ffffff',
		],
		'output' => [
			[
				'choice'   => 'bg',
				'element'  => '.woocommerce .button',
				'property' => 'background-color',
			],
			[
				'choice'   => 'bg',
				'element'  => '.woocommerce .button',
				'property' => 'border-color',
			],
			[
				'choice'   => 'bg_hover',
				'element'  => '.woocommerce .button:hover',
				'property' => 'background-color',
			],
			[
				'choice'   => 'bg_hover',
				'element'  => '.woocommerce .button:hover',
				'property' => 'border-color',
			],
			[
				'choice'   => 'link',
				'element'  => '.woocommerce .button',
				'property' => 'color',
			],
			[
				'choice'   => 'link_hover',
				'element'  => '.woocommerce .button:hover',
				'property' => 'color',
			],
	
		],
		'active_callback' => [
			[
				'setting'  => 'shop_buttons_colors',
				'operator' => '==',
				'value'    => 1,
			]
		],
	] );
}

/* FOOTER */

Kirki::add_field( 'plant', [
	'settings'    => 'is_footer_blocks',
	'label'       => __( 'Enable Footer Blocks Widgets?', 'plant' ),
	'section'     => 'footer',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );

Kirki::add_field( 'plant', [
	'settings'    => 'is_footer_column',
	'label'       => __( 'Enable Footer Columns?', 'plant' ),
	'section'     => 'footer',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'is_footer_bar',
	'label'       => __( 'Enable Footer Bar?', 'plant' ),
	'section'     => 'footer',
	'type'        => 'toggle',
    'default'     => '1',
	'priority'    => 10,
] );

Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_footer_column',
	'label'       => '',
	'section'     => 'footer',
	'default'     => '<div class="_h">Footer Columns</div>',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'is_footer_column',
			'operator' => '==',
			'value'    => true,
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'repeater',
	'label'       => esc_html__( 'Widget Area', 'plant' ),
	'description' => __( 'Save and go to Appearance → Widgets then add widget to Footer Column 1, Footer Column 2.', 'plant' ),
	'section'     => 'footer',
	'priority'    => 10,
	'row_label' => [
		'type'  => 'text',
		'value' => esc_html__( 'Footer Column', 'plant' ),
	],
	'button_label' => esc_html__('Add New Column', 'plant' ),
	'settings'     => 'footer_columns',
	'default'      => [
		[
			'width'		=> 25,
			'display' 	=> 'all',
			'align'	  	=> 'default'
		],
		[
			'width'		=> 25,
			'display' 	=> 'all',
			'align'	  	=> 'default'
		],
		[
			'width'		=> 25,
			'display' 	=> 'all',
			'align'	  	=> 'default'
		],
		[
			'width'		=> 25,
			'display' 	=> 'all',
			'align'	  	=> 'default'
		],
	],
	'fields' => [
		'width' => [
			'type'        => 'number',
			'label'       => esc_html__( 'Column width on desktop (%)', 'plant' ),
			'default'     => 25,
			'choices'     => [
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
			],
		],
		'display'  => [
			'type'        => 'select',
			'label'       => esc_html__( 'Screen to display', 'plant' ),
			'default'     => 'all',
			'choices'     => [
				'all'   	=> esc_html__( 'All', 'plant' ),
				'mobile' 	=> esc_html__( 'Mobile Only', 'plant' ),
				'desktop'   => esc_html__( 'Desktop Only', 'plant' ),
			],
		],
		'align'  => [
			'type'        => 'select',
			'label'       => esc_html__( 'Text Align', 'plant' ),
			'default'     => 'all',
			'choices'     => [
				'default'   => esc_html__( 'Default', 'plant' ),
				'left' 		=> esc_html__( 'Left', 'plant' ),
				'right'   	=> esc_html__( 'Right', 'plant' ),
				'center'  	=> esc_html__( 'Center', 'plant' ),
				'center -toleft'  	=> esc_html__( 'Center (Mobile) → Left (Desktop)', 'plant' ),
				'center -toright'  	=> esc_html__( 'Center (Mobile) → Right (Desktop)', 'plant' ),
			],
		],
	],
	'active_callback' => [
	    [
		'setting'  => 'is_footer_column',
		'operator' => '==',
		'value'    => true,
        ]
    ]
] );
Kirki::add_field( 'plant', [
	'settings'    => 'is_color_footer',
	'label'       => __( 'Adjust Colors?', 'plant' ),
	'section'     => 'footer',
	'type'        => 'toggle',
    'default'     => false,
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'is_footer_column',
			'operator' => '==',
			'value'    => true,
		]
	],
] );
Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'footer_colors',
    'label'       => esc_html__( 'Text Colors', 'plant' ),
    'section'     => 'footer',
    'priority'    => 10,
    'choices'     => [
		'title'    => esc_html__( 'Title', 'plant' ),
        'link'    => esc_html__( 'Text and Link', 'plant' ),
        'hover'   => esc_html__( 'Link: Hover', 'plant' ),
    ],
    'default'     => [
		'title'    => '#ffffff',
        'link'    => '#bbc0c4',
        'hover'   => '#ffffff',
	],
	'transport'    => 'auto',
	'output' => [
		[
			'choice'   => 'title',
			'element'  => '.site-footer h2',
			'property' => 'color',
		],
		[
			'choice'   => 'link',
			'element'  => '.site-footer',
			'property' => '--s-text',
		],
		[
			'choice'   => 'hover',
			'element'  => '.site-footer',
			'property' => '--s-accent-hover',
		],
	],
	'active_callback' => [
	    [
			'setting'  => 'is_color_footer',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'is_footer_column',
			'operator' => '==',
			'value'    => true,
		]
    ]
] );
Kirki::add_field( 'plant', [
	'type'        => 'background',
	'settings'    => 'footer_bg',
	'section'     => 'footer',
	'default'     => [
		'background-color'      => '#242729',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.site-footer',
        ],
	],
	'active_callback' => [
	    [
			'setting'  => 'is_color_footer',
			'operator' => '==',
			'value'    => true,
		],
		[
			'setting'  => 'is_footer_column',
			'operator' => '==',
			'value'    => true,
		]
    ]
] );

Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_footer_bar',
	'label'       => '',
	'section'     => 'footer',
	'default'     => '<div class="_h">Footer Bar</div>',
	'priority'    => 10,
	'active_callback' => [
		[
			'setting'  => 'is_footer_bar',
			'operator' => '==',
			'value'    => true,
		]
	],
] );
Kirki::add_field( 'plant', [
	'type'     => 'code',
	'settings' => 'footer_text',
	'label'    => __( 'Text or HTML', 'plant' ),
	'section'  => 'footer',
	'default'  => esc_attr__( '©' .  date("Y") . ' ' . $_SERVER['HTTP_HOST'] . '. All rights reserved.', 'plant' ),
	'priority' => 10,
	'choices'     => [
		'language' => 'html',
	],
	'active_callback' => [
		[
			'setting'  => 'is_footer_bar',
			'operator' => '==',
			'value'    => true,
		]
	],
] );
Kirki::add_field( 'plant', [
    'type'        => 'multicolor',
    'settings'    => 'footer_bar_colors',
    'label'       => esc_html__( 'Text Colors', 'plant' ),
    'section'     => 'footer',
    'priority'    => 10,
    'choices'     => [
        'link'    => esc_html__( 'Text and Link', 'plant' ),
        'hover'   => esc_html__( 'Link: Hover', 'plant' ),
    ],
    'default'     => [
        'link'    => '#bbc0c4',
        'hover'   => '#ffffff',
	],
	'transport'    => 'auto',
	'output' => [
		[
			'choice'   => 'link',
			'element'  => '.footer-bar',
			'property' => '--s-text',
		],
		[
			'choice'   => 'hover',
			'element'  => '.footer-bar',
			'property' => '--s-accent-hover',
		],
	],
	'active_callback' => [
		[
			'setting'  => 'is_footer_bar',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

Kirki::add_field( 'plant', [
	'type'        => 'background',
	'settings'    => 'footer_bar_bg',
	'section'     => 'footer',
	'default'     => [
		'background-color'      => '#0a0b0c',
		'background-image'      => '',
		'background-repeat'     => 'repeat',
		'background-position'   => 'center center',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.footer-bar',
        ],
	],
	'active_callback' => [
		[
			'setting'  => 'is_footer_bar',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

/* Chat Buttons */

Kirki::add_field( 'plant', [
	'settings'    => 'buttons_enable',
	'label'       => __( 'Enable Chat Buttons?', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_icon',
	'label'       => __( 'Chat Icon', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'radio-buttonset',
	'default'     => 'chat',
	'priority'    => 10,
	'choices'     => [
		'chat' => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m17.3333 4c-8.09998 0-14.66664 5.96933-14.66664 13.3333 0 3.7822 1.74417 7.1837 4.52864 9.6068-.39939 1.308-1.23251 2.6088-2.76302 3.7682-.00086.0009-.00173.0018-.0026.0026-.12624.048-.23492.1333-.31165.2444s-.11789.243-.11804.378c0 .1768.07024.3464.19526.4714.12503.1251.2946.1953.47141.1953.04555-.0006.09093-.0058.13541-.0156 2.58676-.0076 4.79384-1.1125 6.54953-2.4974.8331.3389 1.7027.6182 2.6093.8125-.4053-1.1467-.6276-2.3675-.6276-3.6328 0-6.6174 5.9814-12 13.3334-12 1.8426 0 3.5992.3385 5.1979.9505-.928-6.55201-7.0726-11.6172-14.5313-11.6172zm9.3334 13.3333c-2.829 0-5.5421.9834-7.5425 2.7337s-3.1242 4.1243-3.1242 6.5997c0 2.4753 1.1238 4.8493 3.1242 6.5996 2.0004 1.7504 4.7135 2.7337 7.5425 2.7337 1.3638-.0019 2.7146-.2326 3.9791-.6797 1.6352 1.1423 3.614 1.9895 5.8802 1.9974.0462.0102.0934.0154.1407.0156.1768 0 .3463-.0702.4714-.1952.125-.1251.1952-.2946.1952-.4714-.0002-.1365-.0423-.2695-.1205-.3813s-.1889-.1968-.317-.2437c-1.2202-.9265-2.0023-1.9462-2.4713-2.9844 1.8641-1.7285 2.9044-4.0141 2.9088-6.3906 0-2.4754-1.1238-4.8494-3.1242-6.5997s-4.7135-2.7337-7.5424-2.7337z" fill="currentColor"/></svg>',

		'question'    	=> '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m8.33334 11.7949c0-1.5319.47793-3.08583 1.42316-4.66183.9452-1.57599 2.3365-2.87646 4.1526-3.91243s3.9403-1.55395 6.3724-1.55395c2.2515 0 4.2482.42981 5.9687 1.30047 1.7311.85963 3.0587 2.03887 4.0039 3.5267.9453 1.48783 1.4126 3.09688 1.4126 4.83824 0 1.3776-.2655 2.5789-.8072 3.6038-.5416 1.036-1.1789 1.9287-1.9117 2.6781-.7434.7494-2.0604 2.0168-3.9827 3.7912-.531.4959-.9558.9368-1.2744 1.3225-.3187.3747-.5523.7274-.7116 1.036-.1593.3196-.2762.6282-.3611.9478-.085.3196-.2124.8706-.3824 1.6641-.2973 1.6752-1.2213 2.5238-2.7719 2.5238-.8072 0-1.4869-.2755-2.0392-.8265-.5522-.5511-.8284-1.3666-.8284-2.4467 0-1.3556.2018-2.5348.6054-3.5267s.9452-1.8625 1.6143-2.612c.6691-.7494 1.5719-1.6421 2.7083-2.678.9983-.9038 1.7099-1.5871 2.1559-2.0499.4461-.4629.8178-.9699 1.1152-1.543.308-.562.4567-1.1792.4567-1.8405 0-1.2894-.4673-2.38049-1.3913-3.27318-.924-.8927-2.1241-1.33354-3.5791-1.33354-1.71 0-2.9738.45186-3.781 1.34456-.8071.89269-1.4975 2.21516-2.0497 3.95656-.5311 1.8294-1.5294 2.7331-3.0056 2.7331-.8709 0-1.60374-.3196-2.20911-.9588-.59475-.6171-.90275-1.3004-.90275-2.0499zm11.39586 26.5385c-.9452 0-1.7736-.3197-2.4852-.9589s-1.0621-1.5319-1.0621-2.6781c0-1.0139.3399-1.8735 1.0302-2.5678.6797-.6944 1.5294-1.036 2.5171-1.036.9771 0 1.8055.3527 2.4746 1.036.6691.6943.9983 1.5539.9983 2.5678 0 1.1352-.3505 2.0169-1.0514 2.6671-.701.6502-1.5081.9699-2.4215.9699z" fill="currentColor"/></svg>',
    
		'comment'		=> '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m8.75001 5.83331c-2.97661 0-5.41667 2.44005-5.41667 5.41669v14.1666c0 2.9767 2.44006 5.4167 5.41667 5.4167h1.24999v4.5833c0 1.6384 2.0228 2.6492 3.3333 1.6667l8.3334-6.25h9.5833c2.9766 0 5.4167-2.44 5.4167-5.4167v-14.1666c0-2.97664-2.4401-5.41669-5.4167-5.41669zm0 2.5h22.49999c1.6251 0 2.9167 1.29162 2.9167 2.91669v14.1666c0 1.6251-1.2916 2.9167-2.9167 2.9167h-10c-.2706.0001-.5339.0881-.7503.2507l-7.9997 5.9993v-5c0-.3315-.1317-.6494-.3661-.8838-.2345-.2344-.5524-.3662-.8839-.3662h-2.49999c-1.62505 0-2.91667-1.2916-2.91667-2.9167v-14.1666c0-1.62507 1.29162-2.91669 2.91667-2.91669zm4.16669 5.83169c-.1657-.0023-.3301.0283-.4838.09-.1537.0618-.2936.1535-.4116.2698s-.2116.2549-.2756.4077c-.0639.1529-.0968.3169-.0968.4825 0 .1657.0329.3297.0968.4825.064.1528.1576.2914.2756.4077s.2579.208.4116.2698.3181.0924.4838.09h14.1666c.1657.0024.3301-.0282.4839-.09.1537-.0618.2936-.1535.4115-.2698.118-.1163.2117-.2549.2756-.4077s.0968-.3168.0968-.4825c0-.1656-.0329-.3296-.0968-.4825-.0639-.1528-.1576-.2914-.2756-.4077-.1179-.1163-.2578-.208-.4115-.2698-.1538-.0617-.3182-.0923-.4839-.09zm0 5.8334c-.1657-.0024-.3301.0282-.4838.09-.1537.0617-.2936.1534-.4116.2698-.118.1163-.2116.2548-.2756.4077-.0639.1528-.0968.3168-.0968.4825 0 .1656.0329.3296.0968.4824.064.1529.1576.2914.2756.4078.118.1163.2579.208.4116.2697.1537.0618.3181.0924.4838.0901h10.8333c.1657.0023.3301-.0283.4838-.0901.1537-.0617.2936-.1534.4116-.2697.118-.1164.2116-.2549.2756-.4078.0639-.1528.0968-.3168.0968-.4824 0-.1657-.0329-.3297-.0968-.4825-.064-.1529-.1576-.2914-.2756-.4077-.118-.1164-.2579-.2081-.4116-.2698-.1537-.0618-.3181-.0924-.4838-.09z" fill="currentColor"/></svg>',

		'talk' => '<svg fill="none" height="24" viewBox="0 0 40 40" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m6.66668 5c-1.83334 0-3.33334 1.5-3.33334 3.33333v17.98827c0 .7417.89753 1.1142 1.42253.5892l3.57747-3.5775h14.99996c1.8334 0 3.3334-1.5 3.3334-3.3333v-11.66667c0-1.83333-1.5-3.33333-3.3334-3.33333zm23.33332 8.3333v6.6667c0 3.6817-2.985 6.6667-6.6667 6.6667h-10v1.6666c0 1.8334 1.5 3.3334 3.3334 3.3334h15l3.5775 3.5774c.525.525 1.4225.1525 1.4225-.5892v-17.9882c0-1.8334-1.5-3.3334-3.3334-3.3334z" fill="currentColor"/></svg>'
	], 
    'active_callback' => [
	    [ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings' => 'buttons_icon_color',
	'label'    => __( 'Chat Icon Background', 'plant' ),
	'section'  => 'chat_buttons',
	'type'     => 'color',
	'priority' => 10,
	'default'  => '#0A7CFF',
	'transport'=> 'auto',
	'output' => [
		[
			'element'  => '#s-chat',
			'property' => '--s-accent',
		],
	],
	'active_callback' => [
	    [ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_icon_message',
	'label'       => __( 'Chat Message', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'  => 'Message us',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'type'        => 'sortable',
	'settings'    => 'buttons_channels',
	'label'       => __( 'Channels', 'plant' ),
	'section'     => 'chat_buttons',
	'default'     => [
		'messenger',
		'line',
		'mobile'
	],
	'choices'     => [
		'messenger'      	=> esc_attr__( 'Facebook Messenger', 'plant' ),
		'facebook'  		=> esc_attr__( 'Facebook Page', 'plant' ),
		'twitter'			=> esc_attr__( 'Twitter', 'plant' ),
		'line'				=> esc_attr__( 'Line', 'plant' ),
		'phone'				=> esc_attr__( 'Phone', 'plant' ),
		'mobile'			=> esc_attr__( 'Mobile', 'plant' ),
		'email'				=> esc_attr__( 'Email', 'plant' ),
	],
	'active_callback' => [
	    [ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_use_chat_plugin',
	'label'       => __( 'Messenger - Use Chat Plugin?', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'toggle',
	'default'     => false,
	'active_callback' => [
	    [ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['messenger'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_messenger_url',
	'label'       => __( 'Messenger URL', 'plant' ),
	'description' => __( 'Example: https://m.me/seedwebs', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['messenger'],
		],
	    [ 
		    'setting'  => 'buttons_use_chat_plugin',
		    'operator' => '==',
		    'value'    => false,
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_messenger_tooltip',
	'label'       => __( 'Messenger Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Messenger',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['messenger'],
		],
	    [ 
		    'setting'  => 'buttons_use_chat_plugin',
		    'operator' => '==',
		    'value'    => false,
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_messenger_id',
	'label'       => __( 'Messenger: Facebook Page ID', 'plant' ),
	'description' => __( 'Please read https://docs.seedwebs.com/article/51-chat-buttons-plant.', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['messenger'],
		],
	    [ 
		    'setting'  => 'buttons_use_chat_plugin',
		    'operator' => '==',
		    'value'    => '1',
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_line_url',
	'label'       => __( 'Line URL', 'plant' ),
	'description' => __( 'Example: https://line.me/R/ti/p/@seedwebs', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['line'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_line_tooltip',
	'label'       => __( 'Line Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Line',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['line'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_facebook_url',
	'label'       => __( 'Facebook Page URL', 'plant' ),
	'description' => __( 'Example: https://fb.com/seedwebs', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['facebook'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_facebook_tooltip',
	'label'       => __( 'Facebook Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Facebook',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['facebook'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_mobile_url',
	'label'       => __( 'Mobile No.', 'plant' ),
	'description' => __( 'Example: 081-234-5678', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['mobile'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_mobile_tooltip',
	'label'       => __( 'Mobile Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Mobile',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['mobile'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_phone_url',
	'label'       => __( 'Phone No.', 'plant' ),
	'description' => __( 'Example: 02-123-4567', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['phone'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_phone_tooltip',
	'label'       => __( 'Phone Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Phone',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['phone'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_twitter_url',
	'label'       => __( 'Twitter URL', 'plant' ),
	'description' => __( 'Example: https://twitter.com/seedwebs', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['twitter'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_twitter_tooltip',
	'label'       => __( 'Twitter Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Twitter',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['twitter'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_email_url',
	'label'       => __( 'Email', 'plant' ),
	'description' => __( 'Example: support@seedwebs.com', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['email'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );
Kirki::add_field( 'plant', [
	'settings'    => 'buttons_email_tooltip',
	'label'       => __( 'Email Tooltip', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'text',
	'default'	  => 'Email',
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_channels',
		    'operator' => 'in',
		    'value'    => ['email'],
		],
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );

Kirki::add_field( 'plant', [
	'settings'    => 'buttons_on_landing_page',
	'label'       => __( 'Show on Landing Page?', 'plant' ),
	'description'    => __( 'For Page Template: Landing', 'plant' ),
	'section'     => 'chat_buttons',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => [
		[ 
		    'setting'  => 'buttons_enable',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );


/* Other */

Kirki::add_field( 'plant', [
	'settings'    => 'scroll_fx',
	'label'       => __( 'Enable Scroll Effect?', 'plant' ),
	'description'    => __( 'Animated on Scroll', 'plant' ),
	'section'     => 'general',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'scroll_fx_option',
	'label'       => __( 'Elements?', 'plant' ),
	'section'     => 'general',
	'type'        => 'multicheck',
	'default'     => ['auto'],
	'priority'    => 10,
	'choices'     => [
		'auto' => esc_html__( 'Auto Select', 'plant' ),
		'class' => esc_html__( 'Class: s-fx', 'plant' ),
	],
	'active_callback' => [
		[ 
		    'setting'  => 'scroll_fx',
		    'operator' => '==',
		    'value'    => '1',
	    ]
    ],
] );

Kirki::add_field( 'plant', [
	'settings'    => 'fontawesome',
	'label'       => __( 'Load Font Awesome 5?', 'plant' ),
	'description'    => __( 'Save and refresh to see.', 'plant' ),
	'section'     => 'general',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'settings'    => 'show_admin_bar',
	'label'       => __( 'Show Admin Bar?', 'plant' ),
	'description'    => __( 'Save and refresh to see.', 'plant' ),
	'section'     => 'general',
	'type'        => 'toggle',
	'default'     => false,
	'priority'    => 10,
] );

if (get_template_directory() != get_stylesheet_directory()) {
	Kirki::add_field( 'plant', [
		'settings'    => 'hide_plant_theme',
		'label'       => __( 'Hide Plant Theme?', 'plant' ),
		'description'    => __( 'From Appearance → Theme', 'plant' ),
		'section'     => 'general',
		'type'        => 'toggle',
		'default'     => false,
		'priority'    => 10,
	] );
}

Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_thumbsize',
	'label'       => '',
	'section'     => 'general',
	'default'     => '<div class="_h">Thumbnail Size</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_thumbsize_desc',
	'label'       => '',
	'section'     => 'general',
	'default'     => '<small><i>Save and use <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerate Thumbnails</a> plugin</i></small>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'toggle',
	'settings'    => 'thumbsize_crop',
	'label'       => __( 'Crop Thumbnail?', 'plant' ),
	'section'     => 'general',
	'default'     => '1',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'dimensions',
	'settings'    => 'thumbsize',
	'label'       => __( '', 'plant' ),
	'section'     => 'general',
	'default'     => [
		'width'  => '350',
		'height' => '184',
	],
] );

Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_code_fe',
	'label'       => '',
	'section'     => 'general',
	'default'     => '<div class="_h">Frontend Scripts</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'code',
	'settings'    => 'fe_code_header',
	'label'       => esc_html__( 'Header Script', 'plant' ),
	'description' => esc_html__( 'Output this HTML code before </head>', 'plant' ),
	'section'     => 'general',
	'choices'     => [
		'language' => 'html',
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'code',
	'settings'    => 'fe_code_css',
	'label'       => esc_html__( 'Frontend CSS', 'plant' ),
	'section'     => 'general',
	'choices'     => [
		'language' => 'css',
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'code',
	'settings'    => 'fe_code_footer',
	'label'       => esc_html__( 'Footer Script', 'plant' ),
	'description' => esc_html__( 'Output this HTML code before </body>', 'plant' ),
	'section'     => 'general',
	'choices'     => [
		'language' => 'html',
	],
] );

Kirki::add_field( 'plant', [
	'type'        => 'custom',
	'settings'    => 'h_code_be',
	'label'       => '',
	'section'     => 'general',
	'default'     => '<div class="_h">Backend Scripts (wp-admin)</div>',
	'priority'    => 10,
] );
Kirki::add_field( 'plant', [
	'type'        => 'code',
	'settings'    => 'be_code_css',
	'label'       => esc_html__( 'Backend CSS', 'plant' ),
	'section'     => 'general',
	'choices'     => [
		'language' => 'css',
	],
] );
Kirki::add_field( 'plant', [
	'type'        => 'code',
	'settings'    => 'be_code_js',
	'label'       => esc_html__( 'Backend JS', 'plant' ),
	'section'     => 'general',
	'choices'     => [
		'language' => 'js',
	],
] );









/*
 * Convert Color Funtion
 */
function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color)) return $default; 
	if ($color[0] == '#' ) { $color = substr( $color, 1 );}
	if (strlen($color) == 6) {$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );} 
	elseif ( strlen( $color ) == 3 ) {$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );} 
	else {return $default;}
	$rgb =  array_map('hexdec', $hex);
	if($opacity){ if(abs($opacity) > 1) $opacity = 1.0; $output = 'rgba('.implode(",",$rgb).','.$opacity.')';} 
	else { $output = 'rgb('.implode(",",$rgb).')';}
	return $output;
}

/*
 * Hide Admin Bar
 */
$show_admin_bar  = get_theme_mod( 'show_admin_bar', false );
if ($show_admin_bar) { 
	$GLOBALS['s_admin_bar']  = 'show';
} else {
	$GLOBALS['s_admin_bar']  = 'hide';
}

/*
 * Hide Plant Theme
 */
if (get_theme_mod( 'hide_plant_theme', false )) { 
	$GLOBALS['s_hide_plant']  = 'enable';
} 

/*
 * Load Font Awesome
 */
if (get_theme_mod( 'fontawesome', false )) {
	$GLOBALS['s_fontawesome'] = 'enable';
}


/*
 * WooCommerce
 */

/* Thai Style */
if (get_theme_mod( 'shop_th_style', '1' )) {
	$GLOBALS['s_woo_th'] = 'enable';
} else {
	$GLOBALS['s_woo_th'] = 'disable';
}


/* Display x products per page */
if ( class_exists( 'WooCommerce' ) ) {
	$GLOBALS['shop_products'] = get_theme_mod( 'shop_products', '12' );
	add_filter( 'loop_shop_per_page', 'seed_loop_shop_per_page', 20 );
	function seed_loop_shop_per_page( $cols ) {
		$cols = $GLOBALS['shop_products'];
		return $cols;
	}
}

/* Footer */
$footer_default = [
	['width' => 25,'display' => 'all', 'align' => 'default'],
	['width' => 25,'display' => 'all', 'align' => 'default'],
	['width' => 25,'display' => 'all', 'align' => 'default'],
	['width' => 25,'display' => 'all', 'align' => 'default'],
];
$footers = get_theme_mod( 'footer_columns', $footer_default );
$GLOBALS['s_footer_columns']  = count($footers);


/*
 * Assign $GLOBALS
 */
if ( ! function_exists( 'plant_var' ) ) {
	function plant_var() {
        $GLOBALS['s_header_style_m']        = get_theme_mod( 'header_style_m', 'autoshow' );
		$GLOBALS['s_header_style_d']        = get_theme_mod( 'header_style_d', 'autoshow' );
        $GLOBALS['s_header_layout']			= get_theme_mod( 'header_layout','left-logo');
        $GLOBALS['s_header_action']			= get_theme_mod( 'header_action', array('search'));
        $GLOBALS['s_cart_icon']			    = get_theme_mod( 'cart_icon', 'shopping-cart');
        $GLOBALS['s_left_area']             = get_theme_mod( 'left_area', 'menu' );
        $GLOBALS['s_left_area_phone']       = get_theme_mod( 'left_area_phone', '' );
        $GLOBALS['s_left_area_custom']      = get_theme_mod( 'left_area_custom', '' );
        $GLOBALS['s_right_area']            = get_theme_mod( 'right_area', 'search' );
        $GLOBALS['s_right_area_phone']      = get_theme_mod( 'right_area_phone', '' );
        $GLOBALS['s_right_area_custom']     = get_theme_mod( 'right_area_custom', '' );
		$GLOBALS['s_blog_columns_m']        = get_theme_mod( 'blog_columns_m', '1' );
		$GLOBALS['s_blog_columns_d']        = get_theme_mod( 'blog_columns_d', '3' );
		$GLOBALS['s_header_effect']			= get_theme_mod( 'header_effect','none');
        $GLOBALS['s_header_scroll']    		= get_theme_mod( 'header_scroll', '300' );
        $GLOBALS['s_blog_layout_single']    = get_theme_mod( 'blog_layout_single', 'full-width' );
        $GLOBALS['s_blog_layout']           = get_theme_mod( 'blog_layout', 'full-width' );
		$GLOBALS['s_blog_profile']      	= (get_theme_mod( 'blog_profile', '1' ))? 'enable' : 'disable';
		$GLOBALS['s_blog_archive_profile']  = (get_theme_mod( 'blog_archive_profile', false ))? 'enable' : 'disable';
		$GLOBALS['s_wp_comments']  			= (get_theme_mod( 'blog_comments', false ))? 'enable' : 'disable';
		$GLOBALS['s_blog_template']    		= get_theme_mod( 'blog_template', 'card' );
        $GLOBALS['s_shop_pagebuilder']      = get_theme_mod( 'shop_pagebuilder', false );
        $GLOBALS['s_shop_layout']           = get_theme_mod( 'shop_layout', 'full-width' );
        $GLOBALS['s_logo_overlay ']         = get_theme_mod('logo_overlay' , '');
        $thumbsize                          = get_theme_mod( 'thumbsize', array('width'   => '360','height'  => '189'));
        $GLOBALS['s_thumb_width']           = $thumbsize['width'];
        $GLOBALS['s_thumb_height']          = $thumbsize['height'];
        $GLOBALS['s_thumb_crop']            = get_theme_mod( 'thumbsize_crop', '1' );
    }
}
plant_var();

/*
 * Assign CSS in header.php.
 */
if ( ! function_exists( 'plant_css' ) ) {
	function plant_css() {
        $header_style_m         = get_theme_mod( 'header_style_m','autoshow');
		$header_style_d         = get_theme_mod( 'header_style_d','autoshow');
		$header_layout			= get_theme_mod( 'header_layout','left-logo');
		$header_center_menu		= get_theme_mod( 'header_center_menu', false);
		$header_bg 				= get_theme_mod( 'header_bg',array('background-color'   => '#ffffff'));
		$header_logo_bg			= get_theme_mod( 'header_logo_bg',array('background-color'   => 'rgba(255,255,255,0)'));
		$header_nav_bg 			= get_theme_mod( 'header_nav_bg',array('background-color'   => 'rgba(255,255,255,0)'));
		$header_effect			= get_theme_mod( 'header_effect','none');
        $head_height_m          = get_theme_mod( 'head_height_m','50px');
		$head_height_d          = get_theme_mod( 'head_height_d','70px');
		$head_nav_height		= get_theme_mod( 'head_nav_height','60px');
        $head_shadow 			= get_theme_mod( 'head_shadow',false);
        $head_shadow_color  	= get_theme_mod( 'head_shadow_color','rgba(0,0,0,0.1)');
		$head_shadow_blur       = get_theme_mod( 'head_shadow_blur','5');
		$hide_title 			= get_theme_mod( 'hide_title',false);
		$hide_title_m 			= get_theme_mod( 'hide_title_m',false);
		$body_title_hidden		= get_theme_mod( 'body_title_hidden',false);
		$blog_archive_profile   = get_theme_mod( 'blog_archive_profile',false);
		$shop_style			 	= get_theme_mod( 'shop_style' , 'product-grid');
		$shop_hide_addtocart 	= get_theme_mod( 'shop_hide_addtocart' , '1');
		$shop_hide_related 		= get_theme_mod( 'shop_hide_related' , false);

		echo '<style id="kirki_css" type="text/css">';

        if ($header_style_m == 'standard') {
			echo '.site-header{position:absolute;}';
        } else {
            echo '.site-header{position:fixed;}';
		}
		
		if ($shop_style == 'product-space') {
			echo ':root{--s-woo-form-padding:16px;--s-woo-shadow:none;--s-woo-bg:#fff;--s-woo-border-radius:0;}.cart_item{--s-bg:#dcdfe5}';
			echo '.products .product{padding: calc(var(--s-space) / 2) calc(var(--s-space) / 2) var(--s-space);background:none;}.flex-control-nav li{padding: 10px 5px;}';
			echo '.woocommerce-cart-form__contents thead{border-bottom: 1px solid #dcdfe5;}';
			echo '.woocommerce-message,.woocommerce-form-coupon-toggle, .woocommerce-form-coupon {background:#f5f5f7}';
		}

        // MOBILE ONLY
        echo '@media(max-width:991px){';
        echo '.s-autoshow-m.-hide{transform: translateY(-' . $head_height_m . ')}';
		echo '.s-autoshow-m.-show{transform: translateY(0)}';
		if ( ($header_logo_bg['background-color'] == 'rgba(255,255,255,0)') ) {
			echo 'header.site-header.-top-logo{background-color:' . $header_bg['background-color'] . '}';
		}
		if ($hide_title_m) {
			echo '.site-title{display:none}';
		}
        echo '}';
        
        // DESKTOP
		echo '@media(min-width:992px){';
        if ($header_style_d == 'standard') {
			echo '.site-header{position: absolute;}';
        } else {
            echo '.site-header{position: fixed;}';
        }
        echo '.s-autoshow-d.-hide{transform: translateY(-' . $head_height_d . ')}';
		echo '.s-autoshow-d.-show{transform: translateY(0)}';
		if($header_layout == 'top-logo') {
			echo '.site-branding{flex: 0 0 100%;justify-content: center;height:calc(' .$head_height_d . ' - '. $head_nav_height . ')}';
			if($header_center_menu) {
				echo '.site-action{margin-right:auto}';
			} else {
				echo 'nav.site-nav-d{margin-right:auto;margin-left:-15px}';
			}
		} else {
			// Left Logo
			if($header_center_menu) {
				echo '.site-nav-d{margin-right:auto}';
			}
		}
		
		if ( ($header_nav_bg['background-color'] == 'rgba(255,255,255,0)') && ($header_nav_bg['background-image'] == '') ) {
			echo 'nav.site-nav-d ul.sub-menu{background-color:' . $header_bg['background-color'] . '}';
			echo 'nav.site-nav-d ul.sub-menu::before{border-bottom-color:' . $header_bg['background-color'] . '}';
		} else {
			echo 'nav.site-nav-d ul.sub-menu::before{border-bottom-color:' . $header_nav_bg['background-color'] . '}';
		}
		
		if ($shop_style == 'product-space') {
			echo ':root{--s-woo-form-padding:0;}';
			echo '.products,.related.products .products{margin: 0 calc(var(--s-space) / -2) var(--s-space);width: calc(100% + var(--s-space))}.products .product{padding: calc(var(--s-space) / 2) calc(var(--s-space) / 2) 40px;}';
			echo '.onsale{left: calc(var(--s-space) / 2);top: calc(var(--s-space) / 2)}';
		}
		echo '}';
		
		// ALL
		if ($hide_title) {
			echo '.site-title{display:none}';
		}
		if ($body_title_hidden) {
			echo 'body.page .main-header{display:none}';
		}
		if (!$head_shadow) {
			echo '.site-header{box-shadow:none;}'; 
		} else {
			echo '.site-header{box-shadow: 0 0 ' . $head_shadow_blur . 'px ' . $head_shadow_color .  '}'; 
		}
		switch ($header_effect) {
			case 'slide-in':
				echo 'body.home .site-header-space{display:none}body.home .site-header{opacity:0;}body.home .site-header.-active{opacity:1;transform: translateY(0)}body.home .site-header.-not-active{opacity:0;transform:translateY(-' . $head_height_d . ')}';
				break;
			case 'overlay':
				echo 'body.home .site-header-space{display:none}body.home .site-header:not(.-active){background:none;}';
				break;
			default:
				break;
		}
        if (!$blog_archive_profile) {
            echo '.content-item .byline,.content-item a.author{display:none}.content-item.-card{padding-bottom:15px}';
		}
		
		
		if ($shop_hide_addtocart) {
			echo '#main .add_to_cart_button {display:none;}';
		}
		if ($shop_hide_related) {
			echo '#main .related.products{display:none;}';
		}
		echo '</style>';

	}
}

/* REMOVE RELATED POST IN WP-ADMIN */
function plant_remove_related_box() {
	remove_meta_box( 'acf-group_603b51790f064', 'post', 'normal' );
}
if(!get_theme_mod('blog_related', 0)) {
	add_action( 'add_meta_boxes' , 'plant_remove_related_box' , 20);
}