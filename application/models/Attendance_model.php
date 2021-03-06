<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Attendance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get attendance by rin
     */
    function get_attendance( $rin )
    {
        $this->db->select('cadetEvent.pt, cadetEvent.llab, cadet.lastName, cadetEvent.name, attendance.excused_absence, attendance.time');
        $this->db->from('attendance');
        $this->db->join('cadet', 'cadet.rin = attendance.rin');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('attendance.rin', $rin);
        
        $query = $this->db->get();
        return $query->result_array();
    }
      
    /*
     * Get attendance by event
     */
    function get_event_attendance( $id )
    {
        $this->db->select('cadetEvent.pt, cadetEvent.llab, cadet.lastName, cadetEvent.name, attendance.excused_absence, attendance.time');
        $this->db->from('attendance');
        $this->db->join('cadet', 'cadet.rin = attendance.rin');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('attendance.eventid', $id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    /*
     * Get all attendance
     */
    function get_all_attendance()
    {
        $this->db->order_by('rin', 'desc');
        return $this->db->get('attendance')->result_array();
    }
        
    /*
     * function to add new attendance
     */
    function add_attendance($params)
    {
        $this->db->insert('attendance',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update attendance
     */
    function update_attendance($rin,$params)
    {
        $this->db->where('rin',$rin);
        return $this->db->update('attendance',$params);
    }
    
    /*
     * function to delete attendance
     */
    function delete_attendance($rin)
    {
        return $this->db->delete('attendance',array('rin'=>$rin));
    }
}
