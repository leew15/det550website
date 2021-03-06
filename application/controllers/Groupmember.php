<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Groupmember extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Groupmember_model');
        }
        else
        {
            redirect('login/view');
        }
    } 

    /*
     * Listing of groupmember
     */
    function index()
    {
        $data['groupmember'] = $this->Groupmember_model->get_all_groupmember();
        
        $data['_view'] = 'groupmember/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new groupmember
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'groupID' => $this->input->post('groupID'),
				'rin' => $this->input->post('rin'),
            );
            
            $groupmember_id = $this->Groupmember_model->add_groupmember($params);
            redirect('groupmember/index');
        }
        else
        {            
            $data['_view'] = 'groupmember/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a groupmember
     */
    function edit($)
    {   
        // check if the groupmember exists before trying to edit it
        $data['groupmember'] = $this->Groupmember_model->get_groupmember($);
        
        if(isset($data['groupmember']['']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'groupID' => $this->input->post('groupID'),
					'rin' => $this->input->post('rin'),
                );

                $this->Groupmember_model->update_groupmember($,$params);            
                redirect('groupmember/index');
            }
            else
            {
                $data['_view'] = 'groupmember/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The groupmember you are trying to edit does not exist.');
    } 

    /*
     * Deleting groupmember
     */
    function remove($)
    {
        $groupmember = $this->Groupmember_model->get_groupmember($);

        // check if the groupmember exists before trying to delete it
        if(isset($groupmember['']))
        {
            $this->Groupmember_model->delete_groupmember($);
            redirect('groupmember/index');
        }
        else
            show_error('The groupmember you are trying to delete does not exist.');
    }
    
}
