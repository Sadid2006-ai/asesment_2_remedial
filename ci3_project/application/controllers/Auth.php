<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
    }

    /*
    ====================
    REGISTER
    ====================
    */

    public function register()
    {
        if($this->input->post())
        {
            $nama = trim($this->input->post('nama'));
            $email = trim($this->input->post('email'));
            $password = trim($this->input->post('password'));

            if(strlen($password) < 6)
            {
                $this->session->set_flashdata(
                    'error',
                    'Password minimal 6 karakter'
                );

                redirect('register');
            }

            $cek = $this->User_model
                        ->getUserByEmail($email);

            if($cek)
            {
                $this->session->set_flashdata(
                    'error',
                    'Email sudah digunakan'
                );

                redirect('register');
            }

            $data = [
                'nama' => $nama,
                'email' => $email,
                'password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                )
            ];

            $this->User_model->register($data);

            $this->session->set_flashdata(
                'success',
                'Registrasi berhasil'
            );

            redirect('login');
        }

        $this->load->view('auth/register');
    }

    /*
    ====================
    LOGIN
    ====================
    */

    public function login()
    {
        if($this->input->post())
        {
            $email = trim(
                $this->input->post('email')
            );

            $password = trim(
                $this->input->post('password')
            );

            $user = $this->User_model
                         ->getUserByEmail($email);

            if(
                $user &&
                password_verify(
                    $password,
                    $user->password
                )
            )
            {
                $session = [

                    'user_id' => $user->id,
                    'nama'    => $user->nama,
                    'login'   => true

                ];

                $this->session
                     ->set_userdata($session);

                redirect('dashboard');
            }

            $this->session->set_flashdata(
                'error',
                'Email atau password salah'
            );
        }

        $this->load->view('auth/login');
    }

    /*
    ====================
    LOGOUT
    ====================
    */

    public function logout()
    {
        $this->session->sess_destroy();

        redirect('login');
    }

}