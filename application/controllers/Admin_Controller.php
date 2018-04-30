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

        //bjj$this->load->model('LoginModel','LoginModel');
        $this->load->helper('url');   /***** LOADING HELPER TO AVOID PHP ERROR ****/
        $this->load->model('Admin_Model','admin_model'); /* LOADING MODEL * Technical_Admin_Model as technical_admin_model */
        $this->load->library('session');
        $this->load->library('excel');
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
        $data['stock']= $this->admin_model->get_all_item();
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
    /** Save Stronglass Details */
    public function Save_ST()
    {
        $data = array( 'ST_Name' => $this->input->post('company_name'),
            'ST_GSTIN' =>$this->input->post('gstin_number'),
            'ST_Address_1' =>$this->input->post('address'),
            'ST_Address_2' =>$this->input->post('address1'),
            'ST_Area' =>$this->input->post('area'),
            'ST_City' =>$this->input->post('city'),
            'ST_State' =>$this->input->post('state'),
            'ST_Phone' =>$this->input->post('phone'),
            'ST_Alternate_Phone' =>$this->input->post('alternate_phone'),
            'ST_Email_ID1' =>$this->input->post('email_1'),
            'ST_Email_ID2' =>$this->input->post('email_2'),
            'ST_Bank' =>$this->input->post('bank'),
            'ST_Bank_Account_Number' =>$this->input->post('account'),
            'ST_Bank_Account_Type' =>$this->input->post('account_type'),
            'ST_Bank_Account_IFSC_Code' =>$this->input->post('ifsc'),
            'ST_created_by' => $this->session->userdata['userid']);
        $insert = $this->admin_model->save_stronglass($data);
        if($insert == 1)
        {
            $datas = array('SGST%' =>$this->input->post('sgst'),
                'CGST%' =>$this->input->post('cgst'),
                'Tax_UpdatedBy' => $this->session->userdata['userid']);
            $insert = $this->admin_model->save_tax($datas);
            if($insert == 1)
            {
                redirect('Admin_Controller/Add_Address');
                $this->session->set_flashdata('message', 'Insert Success..');
            }
            else{
                $this->session->set_flashdata('message', 'Insert Failed..');
            }
        }
        else{
            $this->session->set_flashdata('message', 'Insert Failed..');
        }
    }
    /** View Stronglass */
    public function View_Stronglass()
    {
        $data['st']= $this->admin_model->get_ST();
        $data['tax']= $this->admin_model->get_Tax();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/View_Stronglass',$data,false);
        $this->load->view('Admin/footer');
    }

    /** Get PErticular customer details */
    public function get_Customer_Details()
    {
        $customer_id = $this->input->post('id',true);
        $data= $this->admin_model->get_customer_details($customer_id);
        echo  json_encode($data);


    }
    /** Proforma_Invoice */
    public function Proforma_Invoice()
    {
        $this->load->helper('string');
        echo random_string('alnum',5);
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/Invoice');
        $this->load->view('Admin/footer');
    }
    /** Upload excel data to list */
    public function Upload_Invoice()
    {
        $configUpload['upload_path'] = FCPATH.'uploads/excel/';
        $configUpload['allowed_types'] = 'xls|xlsx|csv';
        $configUpload['max_size'] = '5000';
        $this->load->library('upload', $configUpload);
        $this->upload->do_upload('userfile');
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name']; //uploded file name
        $extension=$upload_data['file_ext'];    // uploded file extension

        //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003
        $objReader= PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007
        //Set to read only
        $objReader->setReadDataOnly(true);
        //Load excel file
        $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);
        $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel
        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);
        //loop from first data untill last data
        for($i=2;$i<=$totalrows;$i++)
        {
            $thickness=$objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
            $height=$objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
            $width=$objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
            $pics=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
            $holes=$objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
            $types=$objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
            $charge_height = $height + 30;
            $charge_weigth = $width + 30;
            $area = $charge_height/1000 * $charge_weigth/1000;
            $data_user[]=array(
                'Thickness'=>$thickness,
                'height'=>$height,
                'width'=>$width,
                'pics'=>$pics,
                'holes'=>$holes,
                'type'=>$types,
                'ch_height'=>$charge_height,
                'ch_weight'=>$charge_weigth,
                'area'=>$area );
        }
        $data['invoice'] =  $data_user;
        $data['st']= $this->admin_model->get_ST();
        $data['customer']= $this->admin_model->get_all_customers();
        $data['stock']= $this->admin_model->get_all_item();
        $data['charges']= $this->admin_model->get_all_charges();
        $data['tax']= $this->admin_model->get_Tax();
//        $perfoma = $this->admin_model->get_profoma_number();
        $this->load->view('Admin/header');
        $this->load->view('Admin/top');
        $this->load->view('Admin/left');
        $this->load->view('Admin/View_Invoice',$data,false);
        $this->load->view('Admin/footer');
    }

}
