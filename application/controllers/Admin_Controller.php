<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->user_name == "")
        {
            redirect('Login');
        }

        //$this->load->model('LoginModel','LoginModel');
        $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->model('Admin_Model','admin_model'); /* LOADING MODEL * Technical_Admin_Model as technical_admin_model */
        $this->load->library('session');
        $this->session->set_flashdata('message');
    }

    //** Admin Dashboard**//
    public function dashboard()
    {
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/dashboard');
        $this->load->view('Admin/footer');
    }

    //** Enter stack with size */
    public function Stock_Entry()
    {
        $data['stock']= $this->admin_model->get_all_item();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Stock_Entry',$data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Save stock */
    public function Save_Stock()
    {
        $data = array( 'Material_Name' => $this->input->post('stock_name'),
                       'Material_Current_Price' => $this->input->post('stock_price'),
                       'Material_Created_By' => $this->session->userdata['userid']);
        $insert = $this->admin_model->insert_item($data);
        if($insert == 1)
        {
            redirect('Admin_Controller/Stock_Entry');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }

    //** Edit Material */
    public function Edit_Material()
    {
        $material_id = $this->input->post('id',true);
        $data = $this->admin_model->get_material($material_id);
        echo  json_encode($data);
    }
    //** Update Material */
    public function Update_Material()
    {
        $material_icode = $this->input->post('material_icode');
        $get = $this->admin_model->get_material($material_icode);
        $update = array('Material_Icode' => $this->input->post('material_icode'),
            'Material_Old_Price' =>$get[0]['Material_Current_Price'],
            'Material_Current_Price   ' =>$this->input->post('material_price'),
            'Material_Price_Revised_Date' => date('Y-m-d H:i:s'),
            'Material_Price_Updated_By' => $this->session->userdata['userid']);
        $insert = $this->admin_model->insert_material_history($update);
        if($insert == 1)
        {
            $data = array(  'Material_Name' => $this->input->post('material_name'),
                'Material_Current_Price' =>$this->input->post('material_price'));
            $this->db->where('material_icode',$material_icode);
            $this->db->update('material_master', $data);
            redirect('Admin_Controller/Stock_Entry');
            $this->session->set_flashdata('message', 'Successs..');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }

    }
    //** Item Charges */
    public function Charges_Entry()
    {
        $data['charges']= $this->admin_model->get_all_charges();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Charges',$data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Insert Charges */
    public function  Save_Charges()
    {
        $data = array( 'charge_name' => $this->input->post('charges_name'),
            'charge_current_price' =>$this->input->post('charges_price'),
            'created_by' => $this->session->userdata['userid']);
        $insert = $this->admin_model->insert_charges($data);
        if($insert == 1)
        {
            redirect('Admin_Controller/Charges_Entry');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }
   //** Edit Charges */
    public function Edit_Charges()
    {
        $charges_id = $this->input->post('id',true);
        $data = $this->admin_model->get_charges($charges_id);
        echo  json_encode($data);
    }
    //**Update Charges **//
    public function Update_Charges()
    {
        $charges_id = $this->input->post('charges_icode');
        $get = $this->admin_model->get_charges($charges_id);
        $update = array('charge_icode' => $this->input->post('charges_icode'),
                        'charge_old_price' =>$get[0]['charge_current_price'],
                        'charge_current_price  ' =>$this->input->post('charges_price'),
                        'charge_revised_by' => $this->session->userdata['userid']);
        $insert = $this->admin_model->insert_charges_history($update);
        if($insert == 1)
        {
            $data = array(  'charge_name' => $this->input->post('charges_name'),
                'charge_current_price' =>$this->input->post('charges_price'),
                'modified_by' => $this->session->userdata['userid'],
                'modified_on' => date('Y-m-d H:i:s'));
            $this->db->where('charge_icode',$charges_id);
            $this->db->update('processing_charges_master', $data);
            redirect('Admin_Controller/Charges_Entry');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }

    //** IINVENTRY */
    public function Inventry()
    {
        $data['inventary']= $this->admin_model->get_all_inventary();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Inventry',$data, FALSE);
        $this->load->view('Admin/footer');
    }
    //** Get Material quantity */
    public function get_quantity()
    {
        $material_id = $this->input->post('id',true);
        $data = $this->admin_model->get_material_quantity($material_id);
        echo  json_encode($data);

    }

    /*save Inventary*/
    public function Save_Inventary(){
        $Materials =  $this->input->post('material_id',true);
        $new_quantity = $this->input->post('new_quantity',true);
        $total_quantity = $this->input->post('total_quantity',true);
        $count = sizeof($Materials);
        for($i=0; $i<$count; $i++)
        {
            if ($Materials[$i] == "") {

            }
            else{
                $data = $this->admin_model->get_material_inventry($Materials[$i]);

                if ($data == 0)
                {
                    $insert = array('Material_Icode' => $Materials[$i],
                        'Material_Current_Quantity' =>$total_quantity[$i],
                        'Material_Stock_Qty_Last_Added  ' =>$new_quantity[$i],
                        'Material_Qty_Last_Added_By' => $this->session->userdata['userid']);
                    $insert_inventary = $this->admin_model->insert_inventary($insert);
                }
                else
                {
                    $insert = array('Material_Icode' => $Materials[$i],
                        'Material_Quantity_Added' =>$new_quantity[$i],
                        'Material_Qty_Last_Added_By' => $this->session->userdata['userid']);
                    $insert_history = $this->admin_model->insert_inventary_history($insert);
                    if($insert_history == 1)
                    {
                        $data = array(  'Material_Current_Quantity' => $total_quantity[$i],
                            'Material_Stock_Qty_Last_Added' =>$new_quantity[$i],
                            'Material_Qty_Last_Added_Date' =>date('Y-m-d H:i:s'));
                        $this->db->where('Material_Icode',$Materials[$i]);
                        $this->db->update('material_inventory', $data);
                    }
                    else{
                       echo 0;
                    }
                }
            }
        }
        echo 1;
    }

    //** Add Customers */
    public function Add_Customers()
    {
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Customers');
        $this->load->view('Admin/footer');

    }

    /*save customer*/
    public function Save_Customer(){
        $data = array( 'Customer_Company_Name' => $this->input->post('company_name'),
            'Customer_GSTIN' =>$this->input->post('gstin_number'),
            'Customer_Address_1' =>$this->input->post('address'),
            'Customer_Address_2' =>$this->input->post('address1'),
            'Customer_Area' =>$this->input->post('area'),
            'Customer_City' =>$this->input->post('city'),
            'Customer_State' =>$this->input->post('state'),
            'Customer_Phone' =>$this->input->post('phone'),
            'Customer_Alternate_Phone' =>$this->input->post('alternate_phone'),
            'Customer_Email_Id_1' =>$this->input->post('email_1'),
            'Customer_Email_Id_2' =>$this->input->post('email_2'),
            'Customer_Created_By' => $this->session->userdata['userid']);
        $insert = $this->admin_model->save_customer($data);
        if($insert == 1)
        {
            redirect('Admin_Controller/Add_Customers');
            $this->session->set_flashdata('message', 'Insert Success..');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }

    /** Add MOre Addresss */
    public function Add_Address()
    {
        $data['customer']= $this->admin_model->get_all_customers();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Add_Address',$data, false);
        $this->load->view('Admin/footer');
    }

    /** Save Address */
    public function Save_Address()
    {
        $data = array( 'Customer_Icode' => $this->input->post('company_name'),
            'Customer_GSTIN' =>$this->input->post('gstin_number'),
            'Customer_Add_Address_1' =>$this->input->post('address'),
            'Customer_Add_Address_2' =>$this->input->post('address1'),
            'Customer_Add_Area' =>$this->input->post('area'),
            'Customer_Add_City' =>$this->input->post('city'),
            'Customer_Add_State' =>$this->input->post('state'),
            'Customer_Add_Phone' =>$this->input->post('phone'),
            'Customer_Add_Alternate_Phone' =>$this->input->post('alternate_phone'),
            'Customer_Add_Email_ID_1' =>$this->input->post('email_1'),
            'Customer_Add_Email_Id_2' =>$this->input->post('email_2'),
            'Customer_Add_Created_By' => $this->session->userdata['userid']);
        $insert = $this->admin_model->save_address($data);
        if($insert == 1)
        {
            redirect('Admin_Controller/Add_Address');
            $this->session->set_flashdata('message', 'Insert Success..');
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }

    /** Our Company details  */
    public function Add_Stornglass()
    {
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Add_Stornglass');
        $this->load->view('Admin/footer');

    }

}