<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('login'))
        {
            redirect('login');
        }

        $this->load->model('Laporan_model');
    }

    public function index()
    {
        $user_id =
        $this->session->userdata('user_id');

        $data['laporan'] =
        $this->Laporan_model
        ->getAll($user_id);

        $this->load->view(
            'laporan/index',
            $data
        );
    }

    public function tambah()
    {
        if($this->input->post())
        {
            $jumlah =
            $this->input->post(
                'jumlah_fasilitas_rusak'
            );

            if($jumlah <= 2)
            {
                $status = "Ringan";
            }
            elseif($jumlah <= 5)
            {
                $status = "Sedang";
            }
            else
            {
                $status = "Berat";
            }

            $config['upload_path'] =
            './uploads/';

            $config['allowed_types'] =
            'jpg|jpeg|png';

            $config['encrypt_name'] = TRUE;

            $this->load->library(
                'upload',
                $config
            );

            if(!$this->upload->do_upload('foto_bukti'))
            {
                echo $this->upload->display_errors();
                return;
            }

            $upload =
            $this->upload->data();

            $data = [

                'user_id' =>
                $this->session->userdata('user_id'),

                'lokasi_fasilitas' =>
                $this->input->post('lokasi'),

                'waktu_laporan' =>
                $this->input->post('waktu'),

                'jumlah_fasilitas_rusak' =>
                $jumlah,

                'status_kerusakan' =>
                $status,

                'deskripsi' =>
                $this->input->post('deskripsi'),

                'foto_bukti' =>
                $upload['file_name']

            ];

            $this->Laporan_model
                 ->insert($data);

            redirect('laporan');
        }

        $this->load->view(
            'laporan/tambah'
        );
    }

    public function edit($id)
{
    $laporan =
    $this->Laporan_model
         ->getById($id);

    if(!$laporan)
    {
        redirect('laporan');
    }

    if($this->input->post())
    {
        $jumlah =
        $this->input->post(
            'jumlah_fasilitas_rusak'
        );

        if($jumlah <= 2)
        {
            $status = "Ringan";
        }
        elseif($jumlah <= 5)
        {
            $status = "Sedang";
        }
        else
        {
            $status = "Berat";
        }

        $foto = $laporan->foto_bukti;

        if(
            !empty($_FILES['foto_bukti']['name'])
        )
        {
            $config['upload_path']
            = './uploads/';

            $config['allowed_types']
            = 'jpg|jpeg|png';

            $config['encrypt_name']
            = TRUE;

            $this->load->library(
                'upload',
                $config
            );

            if(
                $this->upload
                ->do_upload('foto_bukti')
            )
            {
                if(
                    file_exists(
                        './uploads/' .
                        $laporan->foto_bukti
                    )
                )
                {
                    unlink(
                        './uploads/' .
                        $laporan->foto_bukti
                    );
                }

                $upload =
                $this->upload->data();

                $foto =
                $upload['file_name'];
            }
        }

        $data = [

            'lokasi_fasilitas' =>
            $this->input->post('lokasi'),

            'waktu_laporan' =>
            $this->input->post('waktu'),

            'jumlah_fasilitas_rusak' =>
            $jumlah,

            'status_kerusakan' =>
            $status,

            'deskripsi' =>
            $this->input->post('deskripsi'),

            'foto_bukti' =>
            $foto
        ];

        $this->Laporan_model
             ->update(
                 $id,
                 $data
             );

        redirect('laporan');
    }

    $data['laporan'] = $laporan;

    $this->load->view(
        'laporan/edit',
        $data
    );
}

        public function hapus($id)
{
    $laporan =
    $this->Laporan_model
         ->getById($id);

    if($laporan)
    {
        if(
            file_exists(
                './uploads/' .
                $laporan->foto_bukti
            )
        )
        {
            unlink(
                './uploads/' .
                $laporan->foto_bukti
            );
        }

        $this->Laporan_model
             ->delete($id);
    }

    redirect('laporan');
}
}