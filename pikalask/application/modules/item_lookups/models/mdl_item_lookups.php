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

class Mdl_Item_Lookups extends MY_Model {

    public $table       = 'fi_item_lookups';
    public $primary_key = 'fi_item_lookups.item_lookup_id';

    public function default_select()
    {
        $this->db->join('fi_user_item_lookups', 'fi_user_item_lookups.item_lookup_id = fi_item_lookups.item_lookup_id', 'left');
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
        $this->db->where('fi_user_item_lookups.user_id',$_SESSION['user_id']);
    }

    public function default_order_by()
    {
        $this->db->order_by('fi_item_lookups.item_name');
    }

    public function validation_rules()
    {
        return array(
            'item_name'        => array(
                'field' => 'item_name',
                'label' => lang('item_name'),
                'rules' => 'required'
            ),
            'item_description' => array(
                'field' => 'item_description',
                'label' => lang('description')
            ),
            'item_price'       => array(
                'field' => 'item_price',
                'label' => lang('price'),
                'rules' => 'required'
            )
        );
    }

    public function db_array()
    {
        $db_array = parent::db_array();

        $db_array['item_price'] = standardize_amount($db_array['item_price']);

        return $db_array;
    }

    public function prep_form($id = NULL)
    {
        $return = FALSE;

        if ($id)
        {
            $return = parent::prep_form($id);

            $this->set_form_value('item_price', format_amount($this->form_value('item_price')));
        }
        return $return;
    }

}