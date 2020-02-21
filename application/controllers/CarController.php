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
		$data=  $this->CarModel->storeCar();
		echo json_encode($data);
	}

	function updateCar(){
		$data=$this->CarModel->updateCar();
		echo json_encode($data);
	}

	function deleteCar(){
		$data=$this->CarModel->deleteCar();
		echo json_encode($data);
	}

}

