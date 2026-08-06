<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');
    }

    //***************** The function below redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login')== 1) redirect (base_url(). get_login_redirect_url('admin'));
        if ($this->session->userdata('hrm_login')== 1) redirect (base_url(). 'hrm/dashboard'); 
        if ($this->session->userdata('hostel_login')== 1) redirect (base_url(). 'hostel/dashboard');
        if ($this->session->userdata('accountant_login')== 1) redirect (base_url(). 'accountant/dashboard');
        if ($this->session->userdata('librarian_login')== 1) redirect (base_url(). 'librarian/dashboard'); 
        if ($this->session->userdata('teacher_login')== 1) redirect (base_url(). 'teacher/dashboard');   
        if ($this->session->userdata('parent_login')== 1) redirect (base_url(). 'parent/dashboard'); 
        if ($this->session->userdata('student_login')== 1) redirect (base_url(). 'student/dashboard'); 
        $data['login_lock_remaining'] = max(0, (int)$this->session->userdata('login_lock_until') - time());
        $this->load->view('backend/login', $data);
    }
  //***************** / The function below redirects to logged in user area

  //********************************** the function below validating user login request 
    function validate_login() {
      
        $now = time();
        $failed_attempts = (int)$this->session->userdata('login_failed_attempts');
        $lock_until      = (int)$this->session->userdata('login_lock_until');

        // If currently locked, block login until the lock expires
        if ($lock_until > $now) {
            $remaining = $lock_until - $now;
            $this->session->set_flashdata('error_message', get_phrase('Too many failed login attempts. Please wait ') . $remaining . get_phrase(' seconds before trying again.'));
            redirect(base_url() . 'login', 'refresh');
        }

        // Lock period already over - reset the counters
        if ($failed_attempts >= 3) {
            $this->session->unset_userdata('login_failed_attempts');
            $this->session->unset_userdata('login_lock_until');
            $failed_attempts = 0;
        }

        $login_check_model = $this->login_model->loginFunctionForAllUsers();
        $login_user = $this->session->userdata('login_type');
        if(!$login_check_model){
          // Wrong credentials - increment failed attempts and lock after 3 tries
          $failed_attempts++;
          $this->session->set_userdata('login_failed_attempts', $failed_attempts);
          if ($failed_attempts >= 3) {
              $this->session->set_userdata('login_lock_until', $now + 60);
              $this->session->unset_userdata('login_failed_attempts');
              $this->session->set_flashdata('error_message', get_phrase('Too many failed login attempts. Login disabled for 60 seconds.'));
          } else {
              $attempts_left = 3 - $failed_attempts;
              $this->session->set_flashdata('error_message', get_phrase('Wrong email or password. ') . $attempts_left . get_phrase(' attempt(s) left.'));
          }
          redirect(base_url() . 'login', 'refresh');
        }

        // Successful login - clear failed attempt counters
        $this->session->unset_userdata('login_failed_attempts');
        $this->session->unset_userdata('login_lock_until');
        unset($_SESSION['error_message']);
        if (isset($_SESSION['__ci_vars']['error_message'])) {
            unset($_SESSION['__ci_vars']['error_message']);
        }

        if($login_user == 'admin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . get_login_redirect_url('admin'), 'refresh');
        }

        if($login_user == 'hrm') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'hrm/dashboard', 'refresh');
        }

        if($login_user == 'hostel') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'hostel/dashboard', 'refresh');
        }

        if($login_user == 'accountant') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'accountant/dashboard', 'refresh');
        }
        if($login_user == 'librarian') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'librarian/dashboard', 'refresh');
        }
        if($login_user == 'parent') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'parents/dashboard', 'refresh');
        }
        if($login_user == 'student') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'student/dashboard', 'refresh');
        }
        if($login_user == 'teacher') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'teacher/dashboard', 'refresh');
        }
     }


    function logout(){
      $login_user = $this->session->userdata('login_type');
      if($login_user == 'admin'){
          $this->login_model->logout_model_for_admin();
      }
      if($login_user == 'hrm'){
        $this->login_model->logout_model_for_hrm();
      }
      if($login_user == 'hostel'){
        $this->login_model->logout_model_for_hostel();
      }
      if($login_user == 'accountant'){
        $this->login_model->logout_model_for_accountant();
      }
      if($login_user == 'librarian'){
        $this->login_model->logout_model_for_librarian();
      }
      if($login_user == 'parent'){
        $this->login_model->logout_model_for_parent();
      }
      if($login_user == 'student'){
        $this->login_model->logout_model_for_student();
      }
      if($login_user == 'teacher'){
        $this->login_model->logout_model_for_teacher();
      }
      $this->session->sess_destroy();
      redirect('login', 'refresh');

     }


    
}
