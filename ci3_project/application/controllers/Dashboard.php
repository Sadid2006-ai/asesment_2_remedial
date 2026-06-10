<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(
            !$this->session
            ->userdata('login')
        )
        {
            redirect('login');
        }
    }

    public function index()
{
    $user_id =
    $this->session->userdata('user_id');

    $data['total'] =
    $this->db
    ->where('user_id',$user_id)
    ->count_all_results('laporan');

    $data['ringan'] =
    $this->db
    ->where('user_id',$user_id)
    ->where('status_kerusakan','Ringan')
    ->count_all_results('laporan');

    $data['sedang'] =
    $this->db
    ->where('user_id',$user_id)
    ->where('status_kerusakan','Sedang')
    ->count_all_results('laporan');

    $data['berat'] =
    $this->db
    ->where('user_id',$user_id)
    ->where('status_kerusakan','Berat')
    ->count_all_results('laporan');

    $this->load->view(
        'dashboard/index',
        $data
    );
}
}