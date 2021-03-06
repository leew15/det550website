<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Cadet extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Cadet_model');
            $data['admin'] = $this->session->userdata('admin');
        }
        else
        {
            redirect('login/view');
        }
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
     * Saves response to security question
     */
    function saveanswer()
    {
        if( $this->input->post('question') !== null && $this->input->post('answer') !== null )
        {
            $params = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer')
            );

            $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
            redirect('cadet/edit');        
        }
        else
        {
            show_error('You must provide a question and answer to set your security question.');
        }
    }
    
    /*
     * Shows the view of setting a cadet's security question.
     */
    function security()
    {
        $data['title'] = 'Security Question';
        $data['cadet'] = $this->Cadet_model->get_cadet($this->input->post('rin'));
        $this->load->view('templates/header', $data);
        $this->load->view('pages/securityquestion.php');
        $this->load->view('templates/footer');     
    }
    
    /*
     * Changes a cadet's password.
     */
    function changepassword()
    {
        $cadet = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        $password = $cadet['password'];
        if(isset($_POST) && $_POST > 0)
        {
            if(password_verify( $this->input->post('oldpass'), $password ))
            {
                if($this->input->post('newpass') === $this->input->post('verpass'))
                {
                    $params = array(
					   'password' => password_hash( $this->input->post('newpass'), PASSWORD_DEFAULT )
                    );

                    $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                    redirect('cadet/edit');
                }
                else
                {
                    show_error('The two passwords you entered do not match.');
                }
            }
            else
            {
                show_error('The password you provided does not match you current password.');
            }
        }
        else
        {
            redirect('cadet/edit');
        }
    }
    
    
    /*
     * Saves a cadet's awards
     */
    function saveawards()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'awards' => $this->input->post('awards')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                redirect('cadet/edit');
            }
            else
            {
                show_error('There was no information given to save in your bio.');
            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        } 
    }
    
    
    /*
     * Saves a cadet's personal goals
     */
    function savepgoals()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'PGoals' => $this->input->post('pgoals')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                redirect('cadet/edit');
            }
            else
            {
                show_error('There was no information given to save in your bio.');
            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        } 
    }
    
    
    /*
     * Saves a cadet's afgoals
     */
    function saveafgoals()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'AFGoals' => $this->input->post('afgoals')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                redirect('cadet/edit');
            }
            else
            {
                show_error('There was no information given to save in your bio.');
            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        } 
    }
    
    /*
     * Saves a cadet's bio
     */
    function savebio()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'bio' => $this->input->post('bio')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                redirect('cadet/edit');
            }
            else
            {
                show_error('There was no information given to save in your bio.');
            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        } 
    }
    
    /*
     * Saves a cadet's profile picture.
     */ 
    function uploadpic()
    {
        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        
        
        // TODO: Account for max file sizes
        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = 100000;
        $config['max_width']        = 20000;
        $config['max_height']       = 20000;
        $config['file_name']        = $data['cadet']['rin'];

        // If old profile picture exists delete it
        if( file_exists("./images/" . $data['cadet']['rin'] . ".png") || file_exists("./images/" . $data['cadet']['rin'] . ".jpg") || file_exists("./images/" . $data['cadet']['rin'] . ".jpeg"))
        {
            unlink("./images/" . $data['cadet']['rin'] . ".png");
        }
        
        // Uploads image
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('profilepicture') ) 
        {
            $error = array('error' => $this->upload->display_errors()); 
            redirect('cadet/edit');
        }
        else 
        { 
            $data = array('upload_data' => $this->upload->data()); 
            redirect('cadet/edit');
        } 
    }
    
    /*
     * Save changes.
     */ 
    function savegeninfo()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'firstName' => $this->input->post('firstName'),
					'primaryEmail' => $this->input->post('pemail'),
					'secondaryEmail' => $this->input->post('semail'),
					'primaryPhone' => $this->input->post('pphone'),
					'secondaryPhone' => $this->input->post('sphone'),
					'position' => $this->input->post('position'),
					'groupMe' => $this->input->post('groupme'),
					'major' => $this->input->post('major')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                redirect('cadet/edit');
            }
            else
            {
                show_error('The cadet you are trying to edit does not exist.');

            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        } 
    }

    /*
     * Editing a cadet
     */
    function edit()
    {   
        $data['title'] = 'Edit Profile';
        $data['cadet'] = $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));

        $this->load->view('templates/header', $data);
        $this->load->view('pages/editProfile.php');
        $this->load->view('templates/footer'); 
    } 
    
    /*
     * Shows cadet's profile.
     */
    function profile()
    {        
        $data['title'] = 'Profile Page';
        $data['admin'] = $this->session->userdata('admin');
        
        // Looks for profile picture
        $files = array_diff(scandir("./images"), array('.', '..'));
        $found = false;
        $data['files'] = $files;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $_SESSION['rin'])
            {
                $data['picture'] = $info['basename']; 
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "/images/default.jpeg";
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
        
        // Allows user to see edit profile button
        $data['myprofile'] = true;
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/profile.php');
        $this->load->view('templates/footer');    
    }
    
    
    /*
     * Shows cadet's home page.
     */
    function home()
    {
        $data['title'] = "Home";
        $this->load->model('cadetevent_model');
        $this->load->model('announcement_model');
        $this->load->model('attendance_model');
        $data['ptperc'] = $this->session->userdata('ptperc');
        $data['llabperc'] = $this->session->userdata('llabperc');
        $data['events'] =  $this->cadetevent_model->get_last_five_events();
        $data['announcements'] =  $this->announcement_model->get_last_five_announcements();
        $data['admin'] = $this->session->userdata('admin');

        // Gets pt and llab attendance percentage 
        $attendance = $this->attendance_model->get_attendance($this->session->userdata('rin'));
        $pt = 0;
        $llab = 0;
        $ptSum = $this->cadetevent_model->get_event_total('pt');
        $llabSum = $this->cadetevent_model->get_event_total('llab');
        foreach( $attendance as $attend )
        {
            if( $attend['pt'] )
            {
                $pt += 1;
            }
            else if( $attend['llab'] )
            {
                $llab += 1;
            }
        }
        $data['ptperc'] = number_format(($pt / $ptSum) * 100, 2);
        $data['llabperc'] = number_format(($llab / $llabSum) * 100, 2);
        
        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('pages/home.php');
        $this->load->view('templates/footer');            
    }
    
    /*
     * Deleting cadet
     */
    function remove()
    {
        if( $this->session->userdata('admin') === true )
        {
            $data['admin'] = $this->session->userdata('admin');
            $this->load->model('Cadet_model');            
            $cadet = $this->Cadet_model->get_cadet($this->input->post('remove'));

            // check if the cadet exists before trying to delete it
            if(isset($cadet['rin']))
            {
                $this->Cadet_model->delete_cadet($this->input->post('remove'));
                redirect('cadet/view');
            }
            else
            {
                show_error('The cadet you are trying to delete does not exist.');
            }
        }
    }
    
    
    /*
     * Saves response to security question
     */
    function modify()
    {
        if( $this->session->userdata('admin') === true )
        {
            if( $this->input->post('admin') !== null && $this->input->post('rank') !== null && $this->input->post('flight') !== null )
            {
                $params = array(
                    'admin' => $this->input->post('admin'),
                    'rank' => $this->input->post('rank'),
                    'flight' => $this->input->post('flight')
                );

                $this->Cadet_model->update_cadet($this->input->post('modify'),$params);            
                redirect('cadet/view');        
            }
            else
            {
                show_error('You must provide a question and answer to set your security question.');
            }
        }
    }
    
    /*
     * Adding a new cadet
     */
    function add()
    {   
        if( $this->session->userdata('admin') === true )
        {
            if(isset($_POST) && count($_POST) > 0)     
            {            
                if( $this->input->post('password') !== $this->input->post('confpassword') )
                {
                   $params = array(
                        'admin' => $this->input->post('admin'),
                        'password' => $this->input->post('password'),
                        'firstName' => $this->input->post('firstName'),
                        'rank' => $this->input->post('rank'),
                        'primaryEmail' => $this->input->post('primaryEmail'),
                        'flight' => $this->input->post('flight'),
                        'lastName' => $this->input->post('lastName'),
                        'rfid' => $this->input->post('rfid'),
                        'question' => $this->input->post('question'),
                        'answer' => $this->input->post('answer')
                    ); 

                    $cadet_id = $this->Cadet_model->add_cadet($params);

                    redirect('cadet/view');
                }
                else
                {
                    show_error('Passwords do not match');
                }
            }
            else
            {            
                show_error('The cadet you are trying to edit does not exist. Or improper information to add cadet was given.');
            }
        }
    }  
    
    /*
     * Shows the admin page.
     */
    function view()
    {
        if( $this->session->userdata('admin') === true )
        {
            $data['title'] = 'Admin Page';
            $this->load->model('Cadetevent_model');
            $this->load->model('Announcement_model');

            $data['cadets'] = $this->Cadet_model->get_all_cadets();
            $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
            $data['announcements'] = $this->Announcement_model->get_all_announcements();
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/admin.php');
            $this->load->view('templates/footer'); 
        }
        else
        {
            redirect('cadet/home');
        }
    }
    
    /*
     * Shows page to connect rfid to a cadet.
     */
    function changerfid()
    {
        $data['title'] = 'Add RFID';
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/rfid.php');
        $this->load->view('templates/footer'); 
    }
    
    /*
     * Saves the rfid to a given cadet based off of a rin.
     */
    function saverfid()
    {
        if( $this->input->post('rin') !== null && $this->input->post('rfid') !== null )
        {
            $cadetrin = trim($this->input->post('rin'));
            $cadetrfid = trim($this->input->post('rfid'));

            $params = array(
                'rfid' => $cadetrfid
            );

            $this->Cadet_model->update_cadet($cadetrin, $params);
            
            redirect('cadet/view');
        }
        else
        {
            show_error("You must enter both a valid RIN and scan the ID card.");
        }
    }
    
    /*
     * Unlocks a users account
     */
    function unlock()
    {
        if( $this->input->post('cadet') !== null && $this->session->userdata('admin') === true )
        {
            $params = array(
                'loginattempt' => 0
            );

            $this->Cadet_model->update_cadet($this->input->post('cadet'), $params);
            
            redirect('cadet/view');
        }
        else
        {
            show_error("The cadet whose account you are trying to unlock does not exist.");
        }
    }
}
