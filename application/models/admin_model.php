<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {	

	public function insert($table_name='',  $data=''){
		$query=$this->db->insert($table_name, $data);
		if($query)
			return  $this->db->insert_id();
		else
			return FALSE;		
	}

	public function get_result($table_name='', $id_array='',$id_array2='',$order="", $limit=""){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		if(!empty($id_array2)):		
			foreach ($id_array2 as $key => $value){
				$this->db->or_where($key, $value);
			}
		endif;

		if(!empty($order)):		
			$this->db->order_by($order['field'], $order['order']);
		endif;


		if(!empty($limit)):		
			$this->db->limit($limit);
		endif;

		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function subscribe($limit='',$offset=''){	
		$this->db->order_by('id','desc');			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$query=$this->db->get('subscribes');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$query=$this->db->get('subscribes');
			return $query->num_rows();
		}
	}
	public function get_row($table_name='', $id_array=''){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	public function update($table_name='', $data='', $id_array=''){
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;		
		return $this->db->update($table_name, $data);
	}

	public function delete($table_name='', $id_array=''){		
		return $this->db->delete($table_name, $id_array);
	}

	public function get_pagination_result($table_name='', $limit='',$offset='', $id_array=''){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		$this->db->order_by('id','desc');			
		if($limit > 0 && $offset>=0){
			$this->db->limit($limit, $offset);
			$query=$this->db->get($table_name);
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$query=$this->db->get($table_name);
			return $query->num_rows();
		}
	}

/*Faraz work */
	public function get_pagination_where($table_name='', $limit='', $offset='', $condition='',$slug="")
 	{ 
		if(!empty($condition)):  
			foreach ($condition as $key => $value)
			{
			 	$this->db->where($key, $value);
			}
			endif;

		if($slug=="asc"){
		$this->db->order_by('id','asc'); 
		}
		else{
		$this->db->order_by('id','desc'); 
		}

		if($limit > 0 && $offset>=0){
		$this->db->limit($limit, $offset);
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
		  return $query->result();
		else
		  return FALSE;
		}
		else{
		   $query=$this->db->get($table_name);
		   return $query->num_rows();
       }
 	}	

/*Faraz work */

	public function get_limited_results($table_name='', $limit=''){		
		$this->db->order_by('id', 'desc');
		$query=$this->db->get($table_name, $limit);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_relatednews($category_id, $id){
		$this->db->where('category_id', $category_id);
		$this->db->where('status', 1);
		$this->db->where('id !=', $id);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('posts',3);
		if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function get_news($category, $limit, $offset,$admin_id)
	{
		$this->db->order_by('id','desc');
		if($category !="ALL"){
		$this->db->where('slug', $category);
		$cat = $this->db->get('categories');		
		$this->db->where('category_id',$cat->row()->id);
		$this->db->where('status', 1);
		$query = $this->db->get('posts', $limit, $offset);
		if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			$this->db->where('status', 1);
			if(!empty($admin_id))
			{
        		$this->db->where('admin_id', $admin_id);
			}
			$query = $this->db->get('posts', $limit, $offset);
			if($query->num_rows()>0)
					return $query->result();
				else
					return FALSE;
		}	
	}

	public function filter_listings($post, $limit, $offset, $id_array=''){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;

		if(!empty($post['srchfield'])){
			$this->db->like('city', $post['srchfield']);
			$this->db->or_like('state',$post['srchfield']);
			$this->db->or_like('zip',$post['srchfield']);
		}

		if(!empty($post['sort'])){
			if($post['sort'] == 'newest'){
				$this->db->order_by('id', 'desc');
			}

			if($post['sort'] == 'oldest'){
				$this->db->order_by('id', 'asc');
			}

			if($post['sort'] == 'h2l'){
				$this->db->order_by('price', 'desc');
			}

			if($post['sort'] == 'l2h'){
				$this->db->order_by('price', 'asc');
			}
		}

		if(!empty($post['cat']) && $post['cat'] !="all"){
			$category_id = $post['cat'];
		}else{
			$category_id="";
		}

		if($post['pricerange'] !=""){
			$val = explode('-', $post['pricerange']);
			$this->db->where("price BETWEEN ".$val[0]." AND ".$val[1]);
		}

		// $this->db->limit($limit, $offset);
		$query = $this->db->get('properties');
			$array = array();
			if($query->num_rows()>0){
				if($category_id !=""){
					foreach ($query->result() as $key){
						if($key->category_id == $category_id){
						$array[] = $key;
						}
					}
				}else{
					$array = $query->result();
				}
				$result['count']    = count($array);
				$result['listings'] = array_slice($array, $offset,$limit);
				return $result;				
			}
				else
					return FALSE;
	}

	// public function get_listing(){
	// 	$query = $this->db->get('posts', $limit, $offset);
	// 		if($query->num_rows()>0)
	// 				return $query->result();
	// 			else
	// 				return FALSE;
	// }


	public function get_neighbour_row($table_name='', $id="",$type=""){
		if($type=="previus"){
			$this->db->where('id <=',$id);
			$this->db->order_by('id','desc');
		}

		if($type=="next"){
			$this->db->where('id >=',$id);
			$this->db->order_by('id','asc');
		}
		
		$this->db->where('id !=',$id);
        $this->db->limit('1');

		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}

	
}	