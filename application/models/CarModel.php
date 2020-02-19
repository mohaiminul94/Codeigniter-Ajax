<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarModel extends CI_model {

	function allCars(){
		$allCars=$this->db->get('car_models');
		return $allCars->result();
	}

	function storeCar() {
		$data = array(				
				'name' 			=> $this->input->post('name'), 
				'price' 			=> $this->input->post('price'), 
				'transmission' 	=> $this->input->post('transmission'), 
				'color' 		=> $this->input->post('color')
			);
		$result=$this->db->insert('car_models',$data);
		return $result;
	}

	function updateCar(){
		$id= $this->input->post('id');
		$name= $this->input->post('name');
		$price= $this->input->post('price'); 
		$transmission= $this->input->post('transmission');
		$color= $this->input->post('color');
		$this->db->set('name', $name);
		$this->db->set('price', $price);
		$this->db->set('transmission', $transmission);
		$this->db->set('color', $color);
		$this->db->where('id', $id);
		$result=$this->db->update('car_models');
		return $result;
	}

	function deleteCar(){
		$id=$this->input->post('id');
		$this->db->where('id', $id);
		$result=$this->db->delete('car_models');
		return $result;
	}

}

