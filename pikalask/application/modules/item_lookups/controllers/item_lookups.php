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

class Item_Lookups extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('mdl_item_lookups');
	}
	
	public function index($page = 0)
	{
        $this->mdl_item_lookups->paginate(site_url('item_lookups/index'), $page);
        $item_lookups = $this->mdl_item_lookups->result();
        
		$this->layout->set('item_lookups', $item_lookups);
		$this->layout->buffer('content', 'item_lookups/index');
		$this->layout->render();
	}
	
	public function form($id = NULL)
	{
		if ($this->input->post('btn_cancel'))
		{
			redirect('item_lookups');
		}
		
		if ($this->mdl_item_lookups->run_validation())
		{
			$this->mdl_item_lookups->save($id);
            $query=$this->db->query("SELECT MAX(item_lookup_id) FROM fi_item_lookups");
            $row=$query->result_array();
            $cfi=$row[0]['MAX(item_lookup_id)'];
            $user_itemlookup_Arr=array(
            'id'=>NULL,
            'user_id'=>$_SESSION['user_id'],
            'item_lookup_id'=>$cfi
            );
            
            $this->db->insert('fi_user_item_lookups',$user_itemlookup_Arr);
			redirect('item_lookups');
		}
		
		if ($id and !$this->input->post('btn_submit'))
		{
			if (!$this->mdl_item_lookups->prep_form($id))
            {
                show_404();
            }
		}
		
		$this->layout->buffer('content', 'item_lookups/form');
		$this->layout->render();
	}
	
	public function delete($id)
	{
		$this->mdl_item_lookups->delete($id);
        $this->db->query('DELETE FROM fi_user_item_lookups WHERE item_lookup_id='.$id.'');
		redirect('item_lookups');
	}

}

?>