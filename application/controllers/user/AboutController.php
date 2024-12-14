<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AboutController extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $context["page_title"] = $this->lang->line("user_about_page_title");
        $this->load->view("user/about", $context);
    }
}