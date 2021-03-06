<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Acknowledge_post extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Acknowledge_post_model');
        }
        else
        {
            redirect('login/view');
        }
    } 

    function view()
    {
        if(isset($_POST) && count($_POST) > 0)     
        {
            $data['title'] = "Acknowledgements"; 
            $this->load->model('Announcement_model');
            $this->load->model('Cadet_model');
            $data['announcement'] = $this->Announcement_model->get_announcement($this->input->post('event'));
            $data['acknowledgements'] = $this->Acknowledge_post_model->get_event_acknowledge_posts($this->input->post('event'));
            $cadets = array();
            
            foreach( $data['acknowledgements'] as $ack )
            {
                $cadets[] = $this->Cadet_model->get_cadet($ack['rin']);
            }
            
            $data['cadets'] = $cadets;
            
            $this->load->view('templates/header', $data);
            $this->load->view('pages/acknowledged.php');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('The announcemen you are trying to view acknoledgements for does not exist.');
        }
    }

    /*
     * Listing of acknowledge_posts
     */
    function index()
    {
        $data['acknowledge_posts'] = $this->Acknowledge_post_model->get_all_acknowledge_posts();
        
        $data['_view'] = 'acknowledge_post/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new acknowledge_post
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $this->load->library('session');
                        
            // Ignores duplicate entries
            if( $this->Acknowledge_post_model->acknowledge_post_exists( $this->session->userdata('rin'), $this->input->post('announcementid') ) <= 0 )
            {
                $params = array(
                    'rin' =>  $this->session->userdata('rin'),
                    'announcement_id' => $this->input->post('announcementid')
                );
                
                $this->Acknowledge_post_model->add_acknowledge_post($params);
            }
            
            redirect('announcement/view');
        }
        else
        {            
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a acknowledge_post
     */
    function edit($rin)
    {   
        // check if the acknowledge_post exists before trying to edit it
        $data['acknowledge_post'] = $this->Acknowledge_post_model->get_acknowledge_post($rin);
        
        if(isset($data['acknowledge_post']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                );

                $this->Acknowledge_post_model->update_acknowledge_post($rin,$params);            
                redirect('acknowledge_post/index');
            }
            else
            {
                $data['_view'] = 'acknowledge_post/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The acknowledge_post you are trying to edit does not exist.');
    } 
    
    /*
     * Returns the number of posts with a given uid
     */
    function get_acknowledge_count($announcement_id)
    {
        return $this->Acknowledge_post_model->get_acknowledge_post_count($announcement_id);
    }

    /*
     * Deleting acknowledge_post
     */
    function remove($rin)
    {
        $acknowledge_post = $this->Acknowledge_post_model->get_acknowledge_post($rin);

        // check if the acknowledge_post exists before trying to delete it
        if(isset($acknowledge_post['rin']))
        {
            $this->Acknowledge_post_model->delete_acknowledge_post($rin);
            redirect('acknowledge_post/index');
        }
        else
            show_error('The acknowledge_post you are trying to delete does not exist.');
    }
    
}
