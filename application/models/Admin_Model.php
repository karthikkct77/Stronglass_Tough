<?php
class Admin_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    //** insert item model */
    public function insert_item($data)
    {
        $this->db->insert('material_master', $data);
        return 1;
    }
    //** get all item */
    public function get_all_item()
    {
        $query = $this->db->query("Select * from material_master ");
        return $query->result_array();
    }

    //** Get perticular material */
    public function get_material($material_icode)
    {
        $query = $this->db->query("Select * from material_master WHERE Material_Icode = '$material_icode' ");
        return $query->result_array();

    }

    //** get all charges */
    public function get_all_charges()
    {
        $query = $this->db->query("Select * from processing_charges_master ");
        return $query->result_array();
    }

    //** Insert Material History */
    public function insert_material_history($data)
    {
        $this->db->insert('material_price_history', $data);
        return 1;
    }
    //** insert charges */
    public function insert_charges($data)
    {
        $this->db->insert('processing_charges_master', $data);
        return 1;

    }
    //** get perticular Cvharges */
    public function get_charges($id)
    {
        $query = $this->db->query("Select * from processing_charges_master WHERE charge_icode = '$id' ");
        return $query->result_array();
    }
    //** nsert charges history */
    public function insert_charges_history($data)
    {
        $this->db->insert('processing_charges_history', $data);
        return 1;
    }
    //** Get material Quantity */
    public function get_material_quantity($material_id)
    {
        $query = $this->db->query("Select * from material_inventory WHERE Material_Icode = '$material_id' ");
        return $query->result_array();
    }

    public function get_material_inventry($material_id)
    {
        $query = $this->db->query("Select * from material_inventory WHERE Material_Icode = '$material_id' ");
        return $query->num_rows();
    }

    /*insert Inventary*/
    public function insert_inventary($data){
        $this->db->insert('material_inventory', $data);
        return 1;
    }
    //* Insert inventry history*/
    public function insert_inventary_history($data)
    {
        $this->db->insert('material_inventory_inward_history', $data);
        return 1;
    }
    //** Get all inventaty */
    public function get_all_inventary()
    {
        $query = $this->db->query("Select * from material_inventory A INNER  JOIN  material_master B on A.Material_Icode = B.Material_Icode ");
        return $query->result_array();

    }

    /*Save Customer*/
    public function save_customer($data){
        $this->db->insert('customer_master', $data);
        return 1;
    }
    /** Gte all Customers */
    public function get_all_customers()
    {
        $query = $this->db->query("Select * from customer_master ");
        return $query->result_array();
    }
    /** Save customers */
    public function save_address($data)
    {
        $this->db->insert('customer_add_address', $data);
        return 1;
    }
    /** Save stronglass details */
    public function save_stronglass($data)
    {
        $this->db->insert('stronglasstough_details', $data);
        return 1;
    }
    /** save tat details */
    public function save_tax($data)
    {
        $this->db->insert('tax_details', $data);
        return 1;
    }
    //** Get Stronglass Details */
    public function get_ST()
    {
        $query = $this->db->query("Select * from stronglasstough_details ");
        return $query->result_array();
    }

    /*Get Tax */
    public function get_Tax(){
        $query = $this->db->query("Select * from tax_details ");
        return $query->result_array();
    }
    /** get customer details */
    public function get_customer_details($id)
    {
        $query = $this->db->query("Select * from customer_master WHERE Customer_Icode ='$id'");
        return $query->result_array();

    }





}