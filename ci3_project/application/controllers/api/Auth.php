<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        header('Content-Type: application/json');

        // Izinkan request dari React (CORS)
        header('Access-Control-Allow-Origin: http://localhost:3000');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            exit(0);
        }
    }

    /*
    =====================
    REGISTER
    POST /api/auth/register
    form-data: nama, email, password
    =====================
    */
    public function register()
    {
        $nama     = $this->input->post('nama');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($nama) || empty($email) || empty($password)) {
            echo json_encode(['status' => false, 'message' => 'Semua field wajib diisi']);
            return;
        }

        $cek = $this->db->where('email', $email)->get('users')->row();

        if ($cek) {
            echo json_encode(['status' => false, 'message' => 'Email sudah terdaftar']);
            return;
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $this->db->insert('users', [
            'nama'     => $nama,
            'email'    => $email,
            'password' => $hashed,
        ]);

        echo json_encode(['status' => true, 'message' => 'Registrasi berhasil']);
    }

    /*
    =====================
    LOGIN
    POST /api/auth/login
    form-data: email, password
    =====================
    */
    public function login()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        if (empty($email) || empty($password)) {
            echo json_encode(['status' => false, 'message' => 'Email dan password wajib diisi']);
            return;
        }

        $user = $this->db->where('email', $email)->get('users')->row();

        if (!$user) {
            echo json_encode(['status' => false, 'message' => 'Email tidak terdaftar']);
            return;
        }

        if (!password_verify($password, $user->password)) {
            echo json_encode(['status' => false, 'message' => 'Password salah']);
            return;
        }

        echo json_encode([
            'status'  => true,
            'message' => 'Login berhasil',
            'user'    => [
                'id'    => $user->id,
                'nama'  => $user->nama,
                'email' => $user->email,
            ]
        ]);
    }
}
