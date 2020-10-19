<?php

class CT_CtMailchimpForm_Widget extends Case_Theme_Core_Widget_Base{
    protected $name = 'ct_mailchimp_form';
    protected $title = 'Mailchimp Sign-Up Form';
    protected $icon = 'eicon-email-field';
    protected $categories = array( 'case-theme-core' );
    protected $params = '{"sections":[{"name":"source_section","label":"Color Settings","tab":"style","controls":[{"name":"style","label":"Style","type":"select","options":{"style1":"Style 1","style2":"Style 2"},"default":"style1"},{"name":"icon_color","label":"Icon Color","type":"color","selectors":{"{{WRAPPER}} .ct-mailchimp1 .mc4wp-form .mc4wp-form-fields:after":"color: {{VALUE}};"}},{"name":"button_bg_color","label":"Button Background Color","type":"color","selectors":{"{{WRAPPER}} .ct-mailchimp1 .mc4wp-form .mc4wp-form-fields:before":"background-color: {{VALUE}} !important;","{{WRAPPER}} .ct-mailchimp1.style2 .mc4wp-form .mc4wp-form-fields input[type=\"submit\"]":"background-color: {{VALUE}} !important;"}},{"name":"button_bg_color2","label":"Button Background Color 2","type":"color"}]}]}';
    protected $styles = array(  );
    protected $scripts = array(  );
}