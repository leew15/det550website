<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Attendance extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Attendance_model');
    } 

    /*
     * Listing of attendance
     */
    function index()
    {
        $data['attendance'] = $this->Attendance_model->get_all_attendance();
        
        $data['_view'] = 'attendance/index';
        $this->load->view('layouts/main',$data);
    }
    
    /*
     * Loads a view for the event page.
     */
    function view()
    {
        $data['title'] = 'Cadet Events';
        $this->load->model('cadetevent_model');
        $data['events'] =  $this->cadetevent_model->get_all_cadetevents();
        
        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('pages/attendance.php');
        $this->load->view('templates/footer');   
    }

    /*
     * Adding a new attendance
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'excused_absence' => $this->input->post('excused_absence'),
				'time' => $this->input->post('time'),
            );
            
            $attendance_id = $this->Attendance_model->add_attendance($params);
            redirect('attendance/index');
        }
        else
        {            
            $data['_view'] = 'attendance/add';
            $this->load->view('layouts/main',$data);
        }
    }  
    
    /*
     *
     */
    function attendees()
    {
        if( $this->input->post('event') !== null )
        {
            $data['title'] = 'Cadet Attendance';
            $this->load->model('attendance_model');
            $this->load->model('cadetevent_model');

            $data['attendees'] =  $this->attendance_model->get_attendance( $this->input->post('event') );
            $data['event'] =  $this->cadetevent_model->get_cadetevent( $this->input->post('event') );

            // Loads the home page 
            $this->load->view('templates/header', $data);
            $this->load->view('pages/viewattendees.php');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('You must select an event to view the attendees of that event.');
        }
    }

    /*
     * Editing a attendance
     */
    function edit($rin)
    {   
        // check if the attendance exists before trying to edit it
        $data['attendance'] = $this->Attendance_model->get_attendance($rin);
        
        if(isset($data['attendance']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'excused_absence' => $this->input->post('excused_absence'),
					'time' => $this->input->post('time'),
                );

                $this->Attendance_model->update_attendance($rin,$params);            
                redirect('attendance/index');
            }
            else
            {
                $data['_view'] = 'attendance/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The attendance you are trying to edit does not exist.');
    } 

    /*
     * Deleting attendance
     */
    function remove($rin)
    {
        $attendance = $this->Attendance_model->get_attendance($rin);

        // check if the attendance exists before trying to delete it
        if(isset($attendance['rin']))
        {
            $this->Attendance_model->delete_attendance($rin);
            redirect('attendance/index');
        }
        else
            show_error('The attendance you are trying to delete does not exist.');
    }
    
}
