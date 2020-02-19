<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CarController extends CI_controller {

	function index() {
		$data['body']= $this->load->view('home','',true);
		$this->load->view('layouts',$data);
	}

	function allCars() {
		$data=$this->CarModel->allCars();
		echo json_encode($data);
	}

	function storeCar() {
		$notification=  $this->CarModel->storeCar();
		
		if($notification)
		{
			$this->session->set_flashdata('success', "SUCCESS_MESSAGE_HERE"); 
		}else{
			$this->session->set_flashdata('error', "ERROR_MESSAGE_HERE");
		}
		// return redirect("CarController/index");
		echo "data store";
	}

	function updateCar(){
		$data=$this->CarModel->updateCar();
		echo json_encode($data);
	}

	// function deleteCar(){
	// 	$data=$this->EmpModel->deleteEmp();
	// 	echo json_encode($data);
	// }

}

