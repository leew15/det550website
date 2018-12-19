<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Cadet extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cadet_model');
    } 

    /*
     * Listing of cadet
     */
//    function index()
//    {
//        $data['cadet'] = $this->Cadet_model->get_all_cadet();
//        
//        $data['_view'] = 'cadet/index';
//        $this->load->view('layouts/main',$data);
//    }

    /*
     * Adding a new cadet
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'admin' => $this->input->post('admin'),
				'password' => $this->input->post('password'),
				'firstName' => $this->input->post('firstName'),
				'rank' => $this->input->post('rank'),
				'primaryEmail' => $this->input->post('primaryEmail'),
				'secondaryEmail' => $this->input->post('secondaryEmail'),
				'primaryPhone' => $this->input->post('primaryPhone'),
				'secondaryPhone' => $this->input->post('secondaryPhone'),
				'flight' => $this->input->post('flight'),
				'position' => $this->input->post('position'),
				'groupMe' => $this->input->post('groupMe'),
				'middleName' => $this->input->post('middleName'),
				'lastName' => $this->input->post('lastName'),
				'rfid' => $this->input->post('rfid'),
				'major' => $this->input->post('major'),
				'bio' => $this->input->post('bio'),
				'AFGoals' => $this->input->post('AFGoals'),
				'awards' => $this->input->post('awards'),
				'PGoals' => $this->input->post('PGoals'),
            );
            
            $cadet_id = $this->Cadet_model->add_cadet($params);
            redirect('cadet/index');
        }
        else
        {            
            $data['_view'] = 'cadet/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a cadet
     */
    function edit($rin)
    {   
        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($rin);
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'admin' => $this->input->post('admin'),
					'password' => $this->input->post('password'),
					'firstName' => $this->input->post('firstName'),
					'rank' => $this->input->post('rank'),
					'primaryEmail' => $this->input->post('primaryEmail'),
					'secondaryEmail' => $this->input->post('secondaryEmail'),
					'primaryPhone' => $this->input->post('primaryPhone'),
					'secondaryPhone' => $this->input->post('secondaryPhone'),
					'flight' => $this->input->post('flight'),
					'position' => $this->input->post('position'),
					'groupMe' => $this->input->post('groupMe'),
					'middleName' => $this->input->post('middleName'),
					'lastName' => $this->input->post('lastName'),
					'rfid' => $this->input->post('rfid'),
					'major' => $this->input->post('major'),
					'bio' => $this->input->post('bio'),
					'AFGoals' => $this->input->post('AFGoals'),
					'awards' => $this->input->post('awards'),
					'PGoals' => $this->input->post('PGoals'),
                );

                $this->Cadet_model->update_cadet($rin,$params);            
                redirect('cadet/index');
            }
            else
            {
                $data['_view'] = 'cadet/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The cadet you are trying to edit does not exist.');
    } 

    /*
     * Deleting cadet
     */
//    function remove($rin)
//    {
//        $cadet = $this->Cadet_model->get_cadet($rin);
//
//        // check if the cadet exists before trying to delete it
//        if(isset($cadet['rin']))
//        {
//            $this->Cadet_model->delete_cadet($rin);
//            redirect('cadet/index');
//        }
//        else
//            show_error('The cadet you are trying to delete does not exist.');
//    }
    
    /*
     * Shows cadet's profile.
     */
    function profile()
    {
        $this->load->library('session');
        
        $data['title'] = 'Profile Page';
        
        // Looks for profile picture
        $files = glob("../../../images/*.{jpg,png,jpeg}", GLOB_BRACE);
        $found = false;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $_SESSION['rin'])
            {
                $data['picture'] = $file; 
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "../../../images/default.jpeg";
        }
        
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(strpos($data['cadet']['rank'], "AS") !== false || strpos($data['cadet']['rank'], "None") !== false)
        {
            $data['heading'] = "Cadet " . $data['cadet']['lastName'];
        }
        else
        {
            $data['heading'] = $data['cadet']['rank'] . " " . $data['cadet']['lastName'];
        } 
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/myprofile.php');
        $this->load->view('templates/footer');    
    }
    
    /*
     * Makes sure cadet is authroized to login.
     */
    function login()
    {
        $cadet = $this->Cadet_model->get_cadet($this->input->post('rin'));
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Login Page';

        if($this->input->post('psw') !== null && password_verify($this->input->post('psw'), $cadet['password']))
        {
            $this->load->library('session');
            $this->load->model('cadetevent_model');
            $this->load->model('announcement_model');
            $this->load->model('attendance_model');
            
            // Sets session variable and loads closest 5 events
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('rin', $this->input->post('rin'));

            $data['events'] =  $this->cadetevent_model->get_last_five_events();
            $data['announcements'] =  $this->announcement_model->get_last_five_announcements();
            
            // Gets pt and llab attendance percentage 
            $attendance = $this->attendance_model->get_attendance($this->session->userdata('rin'));
            $pt = 0;
            $llab = 0;
            $ptSum = $this->cadetevent_model->get_event_total('pt');
            $llabSum = $this->cadetevent_model->get_event_total('llab');
            foreach( $attendance as $attend )
            {
                $temp = $this->cadetevent_model->get_cadetevent($attend['eventid']);
                if( $temp['pt'] === '1' )
                {
                    $pt += 1;
                }
                else if( $temp['llab'] === '1' )
                {
                    $llab += 1;
                }
            }
            $data['ptperc'] = number_format(($pt / $ptSum) * 100, 2);
            $data['llabperc'] =  number_format(($llab / $llabSum) * 100, 2);
            $this->session->set_userdata('ptperc', $data['ptperc']);
            $this->session->set_userdata('llabperc', $data['llabperc']);

            redirect('cadet/home');
        }
        else
        {
            $this->load->view('pages/login.php');
            $this->load->view('templates/footer');
        }   
    }
    
    /*
     * Shows cadet's home page.
     */
    function home()
    {
        $data['title'] = "Home";
        $this->load->library('session');
        $this->load->model('cadetevent_model');
        $this->load->model('announcement_model');
        $data['ptperc'] = $this->session->userdata('ptperc');
        $data['llabperc'] = $this->session->userdata('llabperc');
        $data['events'] =  $this->cadetevent_model->get_last_five_events();
        $data['announcements'] =  $this->announcement_model->get_last_five_announcements();
        
        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('pages/home.php');
        $this->load->view('templates/footer');            
    }
    
    /*
     * Logs user out of website.
     */
    function logout()
    {
        $this->load->library('session');
        $data['title'] = 'Login Page';
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('rin');
        $this->session->unset_userdata('ptperc');
        $this->session->unset_userdata('llabperc');
        $this->load->view('pages/login.php');
        $this->load->view('templates/footer');
    }
    
}
