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
}
