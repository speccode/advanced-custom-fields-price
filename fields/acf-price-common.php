<?php

abstract class acf_price_common extends acf_field
{
    public function __construct()
    {
        $this->name = 'price';
        $this->label = __('Price', 'acf-price');
        $this->category = 'jQuery';
        $this->settings = array(
            'version'   => acf_plugin_price::VERSION,
            'url'       => plugin_dir_url( __FILE__ ),
            'path'      => plugin_dir_path( __FILE__ )
        );
        $this->formats = array(
            '|2/./ |'   => '1 337.55',
            '|2/,/ |'   => '1 337,55',
            '|2/./,|'   => '1,337.55',
            '|2/,/.|'   => '1.337,55',
            '|0//|'     => '1337',
            '|0// |'    => '1 337'
        );
        $this->defaults = array(
            'format'                => '|2/./ |'
        );

        $this->l10n = array(
            //'error'   => __('Error! Please enter a higher value', 'acf-price'),
        );

        parent::__construct();
    }

    public function parse_format( $format )
    {
        $elements = explode('/', str_replace('|', '', $format));
        if (count($elements) !== 3) {
            return $this->parse_format($this->defaults['format']);
        }

        return array(
            'decimals'              => $elements[0],
            'decimal_point'         => $elements[1],
            'thousands_separator'   => $elements[2]
        );
    }
}