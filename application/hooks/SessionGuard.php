<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SessionGuard
{
    /**
     * @var MY_Controller $CI
     */
    protected $CI;

    private $uri_string;
    private $route_type;
    private $auth_session_key = "";

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model("admin/AdminsModel");
        $this->uri_string = $this->CI->uri->uri_string();
        $this->route_type = str_contains($this->uri_string, "admin") ? "admin" : "user";
        $this->auth_session_key = $this->CI->config->item("auth_session_key");
    }

    public function initialize($params)
    {
        if ($params["is_admin_guarded"] && $this->route_type === "admin") {
            $this->handle_guard("admin/login", "admin/dashboard", "AdminsModel");
        }
    }

    private function handle_guard($login_route, $authorized_route, $model_name)
    {
        $session_key = $this->auth_session_key;
        $session_data = $this->CI->session->userdata($session_key);

        if (empty($session_data) || empty($session_data["id"])) {
            $this->redirect_to_login($login_route);
            return;
        }

        if (str_contains($this->uri_string, $login_route)) {
            redirect(base_url($authorized_route));
            return;
        }

        $current_profile = $this->CI->{$model_name}->find($session_data["id"]);
        if (!$current_profile["status"]) {
            $this->redirect_disabled_account($login_route);
        }
    }

    private function redirect_to_login($login_route)
    {
        if (!str_contains($this->uri_string, $login_route)) {
            $this->CI->notifier("notifier", "danger", [
                "title" => $this->CI->lang->line("access_denied_alert_title"),
                "description" => $this->CI->lang->line("access_denied_alert_description")
            ]);
            redirect(base_url($login_route));
        }
    }

    private function redirect_disabled_account($login_route)
    {
        $this->CI->session->unset_userdata($this->auth_session_key);
        $this->CI->notifier("notifier", "info", [
            "title" => $this->CI->lang->line("account_disabled_alert_title"),
            "description" => $this->CI->lang->line("account_disabled_alert_description")
        ]);
        redirect(base_url($login_route));
    }
}