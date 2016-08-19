<?php

class Organization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('organization_model');
        $this->load->model('users_model');
        $this->load->library('template');
    }

    function index() {
        $data = array(
            'title' => 'Sign Up',
        );
        $result = $this->organization_model->get_all();

        $data['organization'] = $result;
        $this->template->load('default', 'admin/organiztion/list', $data);
    }

    function add() {
        $this->load->library('form_validation');
        $this->load->library('password');
        $this->load->library('upload');
        $this->form_validation->set_rules('organization_name', 'Organization Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|matches[conf_password]');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required');
        $this->form_validation->set_rules('organization_address', 'Organization Address', 'required');
        $this->form_validation->set_rules('organization_phone', 'Organization Phone', 'required');
        $this->form_validation->set_rules('organization_website', 'Organization Website', 'required');
        if ($this->form_validation->run() === FALSE) {
            //if local chember 

            $data = array(
                'title' => 'Sign Up',
                'o_net_codes' => $this->get_o_net_codes(),
                'local_chamber_city_states' => $this->organization_model->get_city_state_by_org_type('LC'),
                'local_business_city_states' => $this->organization_model->get_city_state_by_org_type('LB'),
                'local_staffing_agency_city_states' => $this->organization_model->get_city_state_by_org_type('LSA'),
                'local_institution_of_higher_learning _city_states' => $this->organization_model->get_city_state_by_org_type('LIHL'),
                'non_chamber_organization' => $this->organization_model->get_non_chamber_organization(),
                'all_staffing_agencies' => $this->organization_model->get_all_staffing_agencies(),
            );

            $this->template->load('default', 'admin/organiztion/signup_form', $data);
        } else {
            $logo_data = '';
            if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0) {
                $logo_data = $this->do_upload();
            }

            $org_data = array(
                'name' => $this->input->post('organization_name'),
                'address' => $this->input->post('organization_address'),
                'phone' => $this->input->post('organization_phone'),
                'website_url' => $this->input->post('organization_website'),
                'created' => date('Y-m-d', time())
            );
            if ($logo_data['upload_data']['file_name'] != '') {
                $data['logo'] = $logo_data['upload_data']['file_name'];
            }
            $org_id = $this->signup_model->save_organization($org_data);
            if ($org_id) {
                $user_data = array(
                    'org_id' => $org_id,
                    'email' => $this->input->post('email'),
                    'password' => $this->password->create_hash($this->input->post('password')),
                    'created' => date('Y-m-d', time())
                );
                if ($this->signup_model->save_user($user_data)) {
                    $this->session->set_flashdata('success_message', 'You have successfully registered.');
                } else {
                    $this->session->set_flashdata('error_message', 'You are unable to register please try agian.');
                }
                redirect(base_url('signup'));
            }
        }
    }

    function add_ajax() {
        $data_result = array(
            'status' => FALSE,
            'message' => ''
        );
        $this->load->library('form_validation');
        $this->load->library('password');
        $this->load->library('upload');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('organization_name', 'Organization Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|matches[conf_password]');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required');
        $this->form_validation->set_rules('organization_city', 'Organization City', 'required');
        $this->form_validation->set_rules('organization_state', 'Organization State', 'required');
        $this->form_validation->set_rules('organization_address', 'Organization Address', 'required');
        $this->form_validation->set_rules('organization_phone', 'Organization Phone', 'required');
        $this->form_validation->set_rules('organization_website', 'Organization Website', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data_result['message'] = validation_errors();
        } else {
            $logo_data = '';
            if (isset($_FILES['userfile']) && $_FILES['userfile']['error'] == 0) {
                $logo_data = $this->do_upload();
            }

            $org_data = array(
                'name' => $this->input->post('organization_name'),
                'address' => $this->input->post('organization_address'),
                'phone' => $this->input->post('organization_phone'),
                'website_url' => $this->input->post('organization_website'),
                'city' => $this->input->post('organization_city'),
                'state' => $this->input->post('organization_state'),
                'org_type' => $this->input->post('organization_type'),
                'is_former_military' => $this->input->post('is_former_military'),
                'is_ex_offenders' => $this->input->post('is_ex_offenders'),
                'is_recovering_addicts' => $this->input->post('is_recovering_addicts'),
                'employee_limit' => $this->input->post('emp_limit'),
                'created_on' => date('Y-m-d', time())
            );
            if (isset($logo_data['upload_data']) && $logo_data['upload_data']['file_name'] != '') {
                $data['logo'] = $logo_data['upload_data']['file_name'];
            }
            $org_id = $this->organization_model->save_organization($org_data);
            if ($org_id) {
                $data_result['status'] = TRUE;
                $user_data = array(
                    'referral_id' => $org_id,
                    'user_name' => $this->input->post('email'),
                    'password' => $this->password->create_hash($this->input->post('password')),
                    'type' => 'Organization',
                    'status' => 'Active'
                );
                if ($this->users_model->save_user($user_data)) {
                    $data_result['status'] = TRUE;
                    $this->session->set_flashdata('success_message', 'You have successfully registered.');
                    $data_result['message'] = 'You have successfully registered.';
                } else {
                    $this->session->set_flashdata('error_message', 'You are unable to register please try agian.');
                    $data_result['message'] = 'You are unable to register please try agian.';
                }

                // redirect(base_url('signup'));
            }
        }
        echo json_encode($data_result);
        exit;
    }

    function do_upload() {
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload()) {
            $data = array(
                'title' => 'Sign Up',
                'logo_error' => $this->upload->display_errors()
            );
            $this->template->load('default', 'signup/index', $data);
        } else {
            $data = array('upload_data' => $this->upload->data());
            return $data;
        }
    }

    function get_o_net_codes() {
        $result = $this->organization_model->get_codes();
        $resuponse = '';
        if ($result) {
            foreach ($result as $row) {
                $resuponse[$row->id] = $row->code . ':' . $row->title;
            }
        }
        return $resuponse;
    }

}
