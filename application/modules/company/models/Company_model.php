<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*| --------------------------------------------------------------------------*/
/*| dev : royyan  */
/*| version : V.0.0.2 */
/*| facebook :  */
/*| fanspage :  */
/*| instagram :  */
/*| youtube :  */
/*| --------------------------------------------------------------------------*/
/*| Generate By M-CRUD Generator 25/10/2023 23:31*/
/*| Please DO NOT modify this information*/


class Company_model extends MY_Model{

  private $table        = "company";
  private $primary_key  = "id";
  private $column_order = array('name_company', 'visi', 'misi');
  private $order        = array('company.id'=>"DESC");
  private $select       = "company.id,company.name_company,company.visi,company.misi";

public function __construct()
	{
		$config = array(
      'table' 	      => $this->table,
			'primary_key' 	=> $this->primary_key,
		 	'select' 	      => $this->select,
      'column_order' 	=> $this->column_order,
      'order' 	      => $this->order,
		 );

		parent::__construct($config);
	}

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from($this->table);

    if($this->input->post("name_company"))
        {
          $this->db->like("company.name_company", $this->input->post("name_company"));
        }

    if($this->input->post("visi"))
        {
          $this->db->like("company.visi", $this->input->post("visi"));
        }

    if($this->input->post("misi"))
        {
          $this->db->like("company.misi", $this->input->post("misi"));
        }

      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
      $this->db->select($this->select);
      $this->db->from("$this->table");
      return $this->db->count_all_results();
    }



}

/* End of file Company_model.php */
/* Location: ./application/modules/company/models/Company_model.php */
