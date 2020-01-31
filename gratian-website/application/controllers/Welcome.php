<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	public function contact()
	{
		$this->load->view('header');
		$this->load->view('contact');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function about()
	{
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function history()
	{
		$this->load->view('header');
		$this->load->view('history');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function itservice()
	{
		$this->load->view('header');
		$this->load->view('itservice');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function itconsult()
	{
		$this->load->view('header');
		$this->load->view('itconsult');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function portfolio()
	{
		$this->load->view('header');
		$this->load->view('portfolio');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function team()
	{
		$this->load->view('header');
		$this->load->view('team');
		$this->load->view('footer1');
		$this->load->view('footer');
	}
	public function faq()
	{
		$this->load->view('header');
		$this->load->view('faq');
		$this->load->view('footer1');
		$this->load->view('footer');
	}

	public function contactsubmit()
	{//email sending code starts from here
		if(isset($_POST)){
				$from=$this->input->post('email');
				$name=$this->input->post('firstname');
				$message=$this->input->post('message');
				$mobileno=$this->input->post('mobileno');
				$this->load->library('email');
				$this->email->from($from, $name);
				$this->email->to('info@gratian.tech');
				$this->email->subject('Email From Website');
				$this->email->message('Testing the email class.');
				$this->email->send();
				if ( ! $this->email->send())
				{
						echo"failure";
				}
				else{
					echo "success";
				}
		}

	}

}
