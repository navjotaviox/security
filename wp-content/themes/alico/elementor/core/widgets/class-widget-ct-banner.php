<?php

class CT_CtBanner_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_banner';
    protected $title = 'Banner';
    protected $icon = 'eicon-posts-ticker';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"section_content","label":"Content","tab":"content","controls":[{"name":"el_layout","label":"Icon Type","type":"select","options":{"1":"Layout 1","2":"Layout 2"},"default":"1"},{"name":"banner_image","label":"Banner Image","type":"media"},{"name":"layer_image1","label":"Layer Image 1","type":"media","condition":{"el_layout":"2"}},{"name":"layer_image2","label":"Layer Image 2","type":"media","condition":{"el_layout":"2"}},{"name":"banner_title","label":"Banner Title","type":"text","condition":{"el_layout":"1"}},{"name":"banner_number","label":"Banner Number","type":"text","condition":{"el_layout":"1"}},{"name":"ct_icon","label":"Counter Icon","type":"icons","fa4compatibility":"icon","default":{"value":"fas fa-star","library":"fa-solid"}},{"name":"counter_title","label":"Counter Title","type":"text"},{"name":"counter_number","label":"Counter Number","type":"text"},{"name":"counter_number_suffix","label":"Counter Number Suffix","type":"text"},{"name":"counter_bg_color","label":"Counter Box Color","type":"color","selectors":{"{{WRAPPER}} .ct-banner .ct-banner-counter":"background-color: {{VALUE}};"}},{"name":"counter_title_color","label":"Counter Title Color","type":"color","selectors":{"{{WRAPPER}} .ct-banner .ct-banner-counter .item-title":"color: {{VALUE}};"}},{"name":"counter_number_color","label":"Counter Number Color","type":"color","selectors":{"{{WRAPPER}} .ct-banner .ct-banner-counter .ct-counter-number":"color: {{VALUE}};"}}]}]}';
    protected $styles = array(  );
    protected $scripts = array( 'jquery-numerator','ct-counter-widget-js' );
}