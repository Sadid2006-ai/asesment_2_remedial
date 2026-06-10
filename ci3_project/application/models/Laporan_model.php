<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function getAll($user_id)
    {
        return $this->db
            ->where('user_id',$user_id)
            ->order_by('id','DESC')
            ->get('laporan')
            ->result();
    }

    public function getById($id)
    {
        return $this->db
            ->where('id',$id)
            ->get('laporan')
            ->row();
    }

    public function insert($data)
    {
        return $this->db
            ->insert('laporan',$data);
    }

    public function update($id,$data)
    {
        return $this->db
            ->where('id',$id)
            ->update('laporan',$data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id',$id)
            ->delete('laporan');
    }
}