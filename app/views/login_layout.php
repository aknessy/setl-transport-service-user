<?php
$this->data['app_seo_keywords'] = $this->settings_m->getOne(array('skey' => 'app_seo_keywords'))->value;
$this->data['app_favicon'] = $this->settings_m->getOne(array('skey' => 'app_favicon'))->value;

$this->load->view('layout/auth_header', $this->data);
$this->load->view($subview, $this->data);
$this->load->view("layout/footer-2", $this->data);