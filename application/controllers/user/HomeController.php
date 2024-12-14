<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends BASE_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $context["page_title"] = $this->lang->line("user_home_page_title");
        $this->load->view("user/home", $context);
    }
}