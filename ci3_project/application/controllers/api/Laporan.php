<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Content-Type: application/json');

        $this->load->database();
    }

    /*
    =====================
    GET ALL
    =====================
    */

    public function index()
    {
        $data = $this->db
            ->order_by('id', 'DESC')
            ->get('laporan')
            ->result();

        echo json_encode($data);
    }

    /*
    =====================
    GET DETAIL
    =====================
    */

    public function detail($id)
    {
        $data = $this->db
            ->where('id', $id)
            ->get('laporan')
            ->row();

        echo json_encode($data);
    }

    /*
    =====================
    CREATE
    =====================
    */

    public function create()
    {
        $jumlah = $this->input->post('jumlah_fasilitas_rusak');

        if ($jumlah <= 2) {
            $status = "Ringan";
        } elseif ($jumlah <= 5) {
            $status = "Sedang";
        } else {
            $status = "Berat";
        }

        $foto = '';

        if (!empty($_FILES['foto_bukti']['name'])) {

            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_bukti')) {

                $upload = $this->upload->data();

                $foto = $upload['file_name'];
            }
        }

        $data = [

            'user_id' => $this->input->post('user_id'),

            'lokasi_fasilitas' =>
            $this->input->post('lokasi_fasilitas'),

            'waktu_laporan' =>
            $this->input->post('waktu_laporan'),

            'jumlah_fasilitas_rusak' =>
            $jumlah,

            'status_kerusakan' =>
            $status,

            'deskripsi' =>
            $this->input->post('deskripsi'),

            'foto_bukti' =>
            $foto

        ];

        $this->db->insert('laporan', $data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil ditambah'
        ]);
    }

    /*
    =====================
    UPDATE
    =====================
    */

    public function update($id)
    {
        $jumlah = $this->input->post('jumlah_fasilitas_rusak');

        if ($jumlah <= 2) {
            $status = "Ringan";
        } elseif ($jumlah <= 5) {
            $status = "Sedang";
        } else {
            $status = "Berat";
        }

        $data = [

            'lokasi_fasilitas' =>
            $this->input->post('lokasi_fasilitas'),

            'waktu_laporan' =>
            $this->input->post('waktu_laporan'),

            'jumlah_fasilitas_rusak' =>
            $jumlah,

            'status_kerusakan' =>
            $status,

            'deskripsi' =>
            $this->input->post('deskripsi')

        ];

        if (!empty($_FILES['foto_bukti']['name'])) {

            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_bukti')) {

                $upload = $this->upload->data();

                $data['foto_bukti'] = $upload['file_name'];
            }
        }

        $this->db
            ->where('id', $id)
            ->update('laporan', $data);

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    /*
    =====================
    DELETE
    =====================
    */

    public function delete($id)
    {
        $laporan = $this->db
            ->where('id', $id)
            ->get('laporan')
            ->row();

        if (!$laporan) {

            echo json_encode([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);

            return;
        }

        if (!empty($laporan->foto_bukti)) {

            $file =
                FCPATH .
                'uploads/' .
                $laporan->foto_bukti;

            if (file_exists($file)) {
                unlink($file);
            }
        }

        $this->db
            ->where('id', $id)
            ->delete('laporan');

        echo json_encode([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}