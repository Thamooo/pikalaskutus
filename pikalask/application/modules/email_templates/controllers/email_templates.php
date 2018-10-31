<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 * 
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 * 
 */

class Email_Templates extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_email_templates');
    }

    public function index($page = 0)
    {
        $this->mdl_email_templates->paginate(site_url('email_templates/index'), $page);
        $email_templates = $this->mdl_email_templates->result();

        $this->layout->set('email_templates', $email_templates);
        $this->layout->buffer('content', 'email_templates/index');
        $this->layout->render();
    }

    public function form($id = NULL)
    {
        if ($this->input->post('btn_cancel'))
        {
            redirect('email_templates');
        }

        if ($this->mdl_email_templates->run_validation())
        {
            $this->mdl_email_templates->save($id);
            $query=$this->db->query("SELECT MAX(email_template_id) FROM fi_email_templates");
            $row=$query->result_array();
            $cfi=$row[0]['MAX(email_template_id)'];
            $user_email_tempArr=array(
            'id'=>NULL,
            'user_id'=>$_SESSION['user_id'],
            'email_template_id'=>$cfi
            );
            
            $this->db->insert('fi_user_email_templates',$user_email_tempArr);
            redirect('email_templates');
        }

        if ($id and !$this->input->post('btn_submit'))
        {
            if (!$this->mdl_email_templates->prep_form($id))
            {
                show_404();
            }
        }

        $this->load->model('custom_fields/mdl_custom_fields');

        foreach (array_keys($this->mdl_custom_fields->custom_tables()) as $table)
        {
            $custom_fields[$table] = $this->mdl_custom_fields->by_table($table)->get()->result();
        }
        
        $this->layout->set('custom_fields', $custom_fields);
        $this->layout->buffer('content', 'email_templates/form');
        $this->layout->render();
    }

    public function delete($id)
    {
        $this->mdl_email_templates->delete($id);
        $this->db->query('DELETE FROM fi_user_email_templates WHERE email_template_id='.$id.'');
        redirect('email_templates');
    }

}

?>