<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*========== MY_Controller - Controller extending CI_Controller for common purposes ==========*/
/**
 * @property CI_Benchmark $benchmark
 * @property CI_Cache $cache
 * @property CI_Calendar $calendar
 * @property CI_Config $config
 * @property CI_Controller $controller
 * @property CI_DB $db
 * @property CI_Driver $driver
 * @property CI_Email $email
 * @property CI_Encrypt $encrypt
 * @property CI_Encryption $encryption
 * @property CI_Exceptions $exceptions
 * @property CI_Form_validation $form_validation
 * @property CI_FTP $ftp
 * @property CI_Hooks $hooks
 * @property CI_Image_lib $image_lib
 * @property CI_Input $input
 * @property CI_Jquery $jquery
 * @property CI_Lang $lang
 * @property CI_Loader $loader
 * @property CI_Log $log
 * @property CI_Migration $migration
 * @property CI_Model $model
 * @property CI_Output $output
 * @property CI_Pagination $pagination
 * @property CI_Parser $parser
 * @property CI_Unit_test $unit_test
 * @property CI_Profiler $profiler
 * @property CI_Router $router
 * @property CI_Security $security
 * @property CI_Session $session
 * @property CI_Table $table
 * @property CI_Trackback $trackback
 * @property CI_Typography $typography
 * @property CI_Upload $upload
 * @property CI_URI $uri
 * @property CI_User_agent $user_agent
 * @property CI_Utf8 $utf8
 * @property CI_Xmlrpc $xmlrpc
 * @property CI_Xmlrpcs $xmlrpcs
 * @property CI_Zip $zip
 * @property Roles_manager $roles_manager
 * @property ProfilesModel $ProfilesModel
 * @property AdvertisingModel $AdvertisingModel
 * @property CategoriesModel $CategoriesModel
 * @property NewsModel $NewsModel
 * @property SettingsModel $SettingsModel
 */
class MY_Controller extends CI_Controller
{
    private $_admin_language = "";
    private $_user_language = "";

    public function get_admin_language()
    {
        return $this->_admin_language;
    }

    public function get_user_language()
    {
        return $this->_user_language;
    }

    public function __construct()
    {
        parent::__construct();
        $language_session_key = $this->config->item("language_session_key");
        $default_language = $this->config->item("default_language");
        $roles_hierarchy = $this->config->item("roles");
        $this->_admin_language = $this->session->userdata($language_session_key["admin"]) ?? $default_language["admin"];
        $this->_user_language = $this->session->userdata($language_session_key["user"]) ?? $default_language["user"];

        if (is_array($roles_hierarchy)) {
            $roles = array_keys($roles_hierarchy);
            $roles_access = [];
            foreach ($roles as $role) {
                $roles_access["{$role}_access"] = $this->roles_manager->has_access($role);
            }
            $this->load->vars($roles_access);
        }
    }

    public function alert_flashdata($alert_name, $alert_type, $alert_message)
    {
        if (empty($alert_name) || empty($alert_type) || !is_array($alert_message)) {
            throw new InvalidArgumentException("Invalid arguments provided.");
        }

        $alert_types = [
            "info" => ["class" => "alert-info", "icon" => "alert-circle"],
            "success" => ["class" => "alert-success", "icon" => "check-circle"],
            "warning" => ["class" => "alert-warning", "icon" => "alert-octagon"],
            "danger" => ["class" => "alert-danger", "icon" => "alert-triangle"]
        ];

        $alert_type = strtolower($alert_type);
        if (!array_key_exists($alert_type, $alert_types)) {
            $alert_type = "info";
        }

        $alert_message = [
            "title" => $alert_message["title"] ?? "No title provided.",
            "description" => $alert_message["description"] ?? "No description provided."
        ];

        $this->session->set_flashdata($alert_name, [
            "alert_class" => $alert_types[$alert_type]["class"],
            "alert_icon" => $alert_types[$alert_type]["icon"],
            "alert_message" => $alert_message
        ]);
    }
}

/*========== BASE_Controller - Abstract template for creating controllers based on MY_Controller ==========*/
abstract class BASE_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    abstract public function index();
}

/*========== ERROR_Controller - Abstract base controller for handling error-specific functionality ==========*/
abstract class ERROR_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    abstract public function index();
}

/*========== CRUD_Controller - Abstract controller for implementing CRUD operations ==========*/
abstract class CRUD_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    abstract public function index();
    abstract public function show($id);
    abstract public function create();
    abstract public function store();
    abstract public function edit($id);
    abstract public function update($id);
    abstract public function destroy($id);
}