<?php
/*
 * Exit if accessed directly
 */
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Fires when create product variation
 *
 * @param int $variation_id
 */
if (!function_exists('ualWCCreateProductVariation')) {

    function ualWCCreateProductVariation($variation_id) {
        $variation = wc_get_product($variation_id);
        $variationName = $variation->get_formatted_name();
        $vt = explode(" ",$variationName);
        $variation_title = $vt[5].' '.$vt[6];
        $action = "product variation created";
        $obj_type = "Woocommerce";
        $post_id = $variation->id;
        $post_title = 'product variation created '.get_the_title($post_id);
        ual_get_activity_function($action, $obj_type, $post_id, $post_title);
        
    }

}
add_action('woocommerce_create_product_variation', 'ualWCCreateProductVariation', 15, 1);

/**
 * Fires when delete product variation
 */
if (!function_exists('ualDeleteProductVariation')) {

    function ualDeleteProductVariation() {
        $variation_ids = isset($_POST['variation_ids']) ? intval($_POST['variation_ids']) : '';
        foreach ($variation_ids as $variation_id){
            $variation = wc_get_product($variation_id);
            $variationName = $variation->get_formatted_name();
            $product = new WC_Product($variation->id);
            $variation_data = $variation->variation_data;
            $rprice = get_post_meta($variation_id, '_regular_price', true);
            $sprice = get_post_meta($variation_id, '_sale_price', true);
            $variation_detail_ary = array();
            $variation_detail_ary['ual_product_name'] = get_the_title($variation->id);
            $variation_detail_ary['ual_variation_data'] = serialize($variation_data);
            $action = "product variation deleted";
            $obj_type = "Woocommerce";
            $post_id = $variation->id;
            $post_title = 'Product variation deleted '. get_the_title($post_id);
            ual_get_activity_function($action, $obj_type, $post_id, $post_title);
        }
    }

}
add_action('wp_ajax_woocommerce_remove_variations','ualDeleteProductVariation');

/**
 * Fires when save product variation
 *
 * @param int $variation_id, int $i
 */
if (!function_exists('ualWCSaveProductVariation')) {

    function ualWCSaveProductVariation($variation_id, $i) {
        $variation = $variation_data = $rprice = $sprice = $SKU = $virtual = $downloadable = $weight = $length = $manage_stock = $backorders = $tax_class = $download_limit = $download_expiry = $downloadable_files = $variation_description = $default_attributes = '';

        $variation = wc_get_product($variation_id);
        $variation_data = $variation->variation_data;

        $rprice = get_post_meta($variation_id, '_regular_price', true);
        $sprice = get_post_meta($variation_id, '_sale_price', true);

        $SKU = get_post_meta( $variation_id, '_sku' );
        if(isset($SKU) && !empty($SKU)){
            $SKU = $SKU[0];
        }
        $virtual = get_post_meta( $variation_id, '_virtual' );
        if(isset($virtual) && !empty($virtual)){
            $virtual = $virtual[0];
        }
        $downloadable = get_post_meta( $variation_id, '_downloadable' );
        if(isset($downloadable) && !empty($downloadable)){
            $downloadable = $downloadable[0];
        }
        $weight = get_post_meta( $variation_id, '_weight' );
        if(isset($weight) && !empty($weight)){
            $weight = $weight[0];
        }
        $length = get_post_meta( $variation_id, '_length' );
        if(isset($length) && !empty($length)){
            $length = $length[0];
        }
        $manage_stock = get_post_meta( $variation_id, '_manage_stock' );
        if(isset($manage_stock) && !empty($manage_stock)){
            $manage_stock = $manage_stock[0];
        }
        $backorders = get_post_meta( $variation_id, '_backorders' );
        if(isset($backorders) && !empty($backorders)){
            $backorders = $backorders[0];
        }
        $tax_class = get_post_meta( $variation_id, '_tax_class' );
        if(isset($tax_class) && !empty($tax_class)){
            $tax_class = $tax_class[0];
        }
        $download_limit = get_post_meta( $variation_id, '_download_limit' );
        if(isset($download_limit) && !empty($download_limit)){
            $download_limit = $download_limit[0];
        }
        $download_expiry = get_post_meta( $variation_id, '_download_expiry' );
        if(isset($download_expiry) && !empty($download_expiry)){
            $download_expiry = $download_expiry[0];
        }
        $variation_description = get_post_meta( $variation_id, '_variation_description' );
        if(isset($variation_description) && !empty($variation_description)){
            $variation_description = $variation_description[0];
        }
        $variation_detail_ary = array();
        $variation_detail_ary['ual_variation_sku'] = $SKU;
        $variation_detail_ary['ual_product_name'] = get_the_title($variation->id);
        $variation_detail_ary['ual_variation_regular_price'] = $rprice;
        $variation_detail_ary['ual_variation_sale_price'] = $sprice;
        $variation_detail_ary['ual_virtual'] = $virtual;
        $variation_detail_ary['ual_downloadable'] = $downloadable;
        $variation_detail_ary['ual_weight'] = $weight;
        $variation_detail_ary['ual_length'] = $length;
        $variation_detail_ary['ual_manage_stock'] = $manage_stock;
        $variation_detail_ary['ual_backorders'] = $backorders;
        $variation_detail_ary['ual_tax_class'] = $tax_class;
        $variation_detail_ary['ual_download_limit'] = $download_limit;
        $variation_detail_ary['ual_download_expiry'] = $download_expiry;
//            $variation_detail_ary['ual_downloadable_file'] = $downloadable_files;
        $variation_detail_ary['ual_variation_description'] = $variation_description;
        $variation_detail_ary['ual_variation_data'] = serialize($variation_data);
        $action = "product variation saved";
        $obj_type = "Woocommerce";
        $post_id = $variation->id;
        $post_title = 'Product variation saved '.get_the_title($post_id);
        ual_get_activity_function($action, $obj_type, $post_id, $post_title);
    }
}
add_action('woocommerce_save_product_variation', 'ualWCSaveProductVariation', 15, 2);

/**
 *
 * Fires when update woocommerce options
 *
 * @param string $options
 * @param string $oldvalue
 * @param string $newvalue
 */
if(!function_exists('ualWoocomerceUpdatedOption')){

    function ualWoocomerceUpdatedOption($option, $oldvalue, $_newvalue) {
        global $current_tab;
        if(isset($current_tab) && $current_tab != '') {
            $whitelist_options = ualGetWCOptions();
            $transient_name = 'sp_'.$current_tab;
            if(in_array($option, $whitelist_options)) {
                $settings_page_wc = get_transient($transient_name);
                $settings_page_wc[$option] = array('old_v' => $oldvalue, 'new_v' => $_newvalue);
                set_transient($transient_name, $settings_page_wc);
            }
        }
    }
}
add_action('updated_option', 'ualWoocomerceUpdatedOption', 15, 3);

/*
 * fires after all woocommerce options updated
 */
if(!function_exists('ualWoocomerceUpdateOptions')) {
    function ualWoocomerceUpdateOptions() {
        global $current_tab;
        if(isset($current_tab) && $current_tab != '') {
            $transient_name = 'sp_'.$current_tab;
            $settings_page_wc = get_transient($transient_name);
            if($settings_page_wc != '') {
                $action = "updated";
                $obj_type = "Settings";
                $post_id = "";
                $post_title = $current_tab .' Settings updated';
                ual_get_activity_function($action, $obj_type, $post_id, $post_title);
            }
            delete_transient($transient_name);
        }
    }
}
add_action('woocommerce_update_options','ualWoocomerceUpdateOptions',10);

if(!function_exists('ualGetWCOptions')) {
    function ualGetWCOptions() {
        $whitelist_options = apply_filters('ualGetWCOptions', array(
//            'woocommerce_permalinks',
            'woocommerce_default_country',
            'woocommerce_allowed_countries',
            'woocommerce_all_except_countries',
            'woocommerce_specific_allowed_countries',
            'woocommerce_ship_to_countries',
            'woocommerce_specific_ship_to_countries',
            'woocommerce_default_customer_address',
            'woocommerce_calc_taxes',
            'woocommerce_demo_store',
            'woocommerce_demo_store_notice',
            'woocommerce_currency',
            'woocommerce_currency_pos',
            'woocommerce_price_thousand_sep',
            'woocommerce_price_decimal_sep',
            'woocommerce_price_num_decimals',

            'woocommerce_weight_unit',
            'woocommerce_dimension_unit',
            'woocommerce_enable_review_rating',
            'woocommerce_review_rating_required',
            'woocommerce_review_rating_verification_label',
            'woocommerce_review_rating_verification_required',

            'woocommerce_shop_page_id',
            'woocommerce_shop_page_display',
            'woocommerce_category_archive_display',
            'woocommerce_default_catalog_orderby',
            'woocommerce_cart_redirect_after_add',
            'woocommerce_enable_ajax_add_to_cart',

            'shop_catalog_image_size',
            'shop_single_image_size',
            'shop_thumbnail_image_size',
            'woocommerce_enable_lightbox',

            'woocommerce_manage_stock',
            'woocommerce_hold_stock_minutes',
            'woocommerce_notify_low_stock',
            'woocommerce_notify_no_stock',
            'woocommerce_stock_email_recipient',
            'woocommerce_notify_low_stock_amount',
            'woocommerce_notify_no_stock_amount',
            'woocommerce_hide_out_of_stock_items',
            'woocommerce_stock_format',

            'woocommerce_file_download_method',
            'woocommerce_downloads_require_login',
            'woocommerce_downloads_grant_access_after_payment',

            'woocommerce_prices_include_tax',
            'woocommerce_tax_based_on',
            'woocommerce_shipping_tax_class',
            'woocommerce_tax_round_at_subtotal',
            'woocommerce_tax_classes',
            'woocommerce_tax_display_shop',
            'woocommerce_tax_display_cart',
            'woocommerce_price_display_suffix',
            'woocommerce_tax_total_display',

            //shipping zones
            'woocommerce_enable_shipping_calc',
            'woocommerce_shipping_cost_requires_address',
            'woocommerce_ship_to_destination',

            //checkout options
            'woocommerce_enable_coupons',
            'woocommerce_calc_discounts_sequentially',
            'woocommerce_enable_guest_checkout',
            'woocommerce_force_ssl_checkout',
            'woocommerce_cart_page_id',
            'woocommerce_checkout_page_id',
            'woocommerce_terms_page_id',
            'woocommerce_checkout_pay_endpoint',
            'woocommerce_checkout_order_received_endpoint',
            'woocommerce_myaccount_add_payment_method_endpoint',
            'woocommerce_myaccount_delete_payment_method_endpoint',
            'woocommerce_myaccount_set_default_payment_method_endpoint',
            'woocommerce_gateway_order',

            //account
            'woocommerce_myaccount_page_id',
            'woocommerce_enable_signup_and_login_from_checkout',
            'woocommerce_enable_myaccount_registration',
            'woocommerce_enable_checkout_login_reminder',
            'woocommerce_registration_generate_username',
            'woocommerce_registration_generate_password',
            'woocommerce_myaccount_orders_endpoint',
            'woocommerce_myaccount_view_order_endpoint',
            'woocommerce_myaccount_downloads_endpoint',
            'woocommerce_myaccount_edit_account_endpoint',
            'woocommerce_myaccount_edit_address_endpoint',
            'woocommerce_myaccount_payment_methods_endpoint',
            'woocommerce_myaccount_lost_password_endpoint',
            'woocommerce_logout_endpoint',

            //email sender
            'woocommerce_email_from_name',
            'woocommerce_email_from_address',
            'woocommerce_email_header_image',
            'woocommerce_email_footer_text',
            'woocommerce_email_base_color',
            'woocommerce_email_background_color',
            'woocommerce_email_body_background_color',
            'woocommerce_email_text_color',

            //api
            'woocommerce_api_enabled',

            'woocommerce_bacs_settings',
            'woocommerce_bacs_accounts',
            'woocommerce_cheque_settings',
            'woocommerce_cod_settings',
            'woocommerce_paypal_settings'
        ));
        return $whitelist_options;
    }
}

class UAL_Integration_WooCommerce {

    private $_wc_options = array();

    public function init() {
        if (!class_exists('Woocommerce'))
            return;

        add_filter('ualWhitelistOptions', array(&$this, 'ualWcWhitelistOptions'));
        add_filter('woocommerce_get_settings_pages', array(&$this, 'ualWcGetSettingsPages'), 9999);
    }

    /**
     * @param WC_Settings_Page[] $settings
     *
     * @return WC_Settings_Page[]
     */
    public function ualWcGetSettingsPages($settings) {

        if (empty($this->_wc_options)) {
            $wc_exclude_types = array(
                'title',
                'sectionend',
            );
            $this->_wc_options = array();

            foreach ($settings as $setting) {
                foreach ($setting->get_settings() as $option) {
                    if (isset($option['id']) && (!isset($option['type']) || !in_array($option['type'], $wc_exclude_types) ))
                        $this->_wc_options[] = $option['id'];
                }
            }
        }
        return $settings;
    }

    public function ualWcWhitelistOptions($ualWcWhitelistOptions) {

        if (!empty($this->_wc_options)) {
            $ualWcWhitelistOptions = array_unique(array_merge($ualWcWhitelistOptions, $this->_wc_options));
        }
        return $ualWcWhitelistOptions;
    }

    public function __construct() {
        add_action('init', array(&$this, 'init'));
    }

}

new UAL_Integration_WooCommerce();