<?php

// $this->data['app_name'] = $this->settings_m->getOne(array('skey' => 'app_name'))->value;
// $this->data['app_favicon'] = $this->settings_m->getOne(array('skey' => 'app_favicon'))->value;
// $this->data['app_logo'] = $this->settings_m->getOne(array('skey' => 'app_logo'))->value;
// $this->data['app_logo_white'] = $this->settings_m->getOne(array('skey' => 'app_logo_white'))->value;
// $this->data['app_seo_keywords'] = $this->settings_m->getOne(array('skey' => 'app_seo_keywords'))->value;
// $this->data['app_description'] = $this->settings_m->getOne(array('skey' => 'app_description'))->value;
// $this->data['app_powered_by'] = $this->settings_m->getOne(array('skey' => 'app_powered_by'))->value;
// $this->data['app_powered_by_url'] = $this->settings_m->getOne(array('skey' => 'app_powered_by_url'))->value;
// $this->data['app_login_banner'] = $this->settings_m->getOne(array('skey' => 'app_login_banner'))->value;
// $this->data['aws_base_url'] = $this->settings_m->getOne(array('skey' => 'aws_base_url'))->value;
// $this->data['crs_coa'] = $this->settings_m->getOne(array('skey' => 'crs_coa'))->value;
// $this->data['app_address'] = $this->settings_m->getOne(array('skey' => 'app_address'))->value;
// $this->data['signature'] = $this->settings_m->getOne(array('skey' => 'signature'))->value;
// $this->data['chairman_name'] = $this->settings_m->getOne(array('skey' => 'chairman_name'))->value;
$this->load->view('layout/header', $this->data);
$this->load->view('layout/top_menu', $this->data);
$this->load->view($subview, $this->data);
$this->load->view("layout/footer-2", $this->data);
 