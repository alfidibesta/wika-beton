<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Base_model', 'base');
    }

    public function index()
    {
        $data = [
            'title'       => 'Hubungi Kami',
            'contact'    => $this->db->get('contact')->result_array(),
            'company' => $this->db->get('company')->result_array(),
        ];
        $this->frontend->load('frontend/template', 'frontend/contact/contact', $data);
    }

    public function add_action()
    {
        $post = $this->input->post(NULL, TRUE);

        $params = [
            'nama_perusahaan' => $post['nama_perusahaan'],
            'nama_proyek'     => $post['nama_proyek'],
            'untuk_perhatian' => $post['untuk_perhatian'],
            'no_hp'           => $post['no_hp'],
            'email_pelanggan' => $post['email'],
            'nama_owner'      => $post['project_owner'],
            'jenis_proyek'    => $post['jenis_proyek'],
            'tanggal_mulai'   => $post['tanggal_mulai'],
            'tanggal_selesai' => $post['tanggal_selesai'],
            'sumber_dana'     => $post['sumber_dana'],
            'sektor'          => $post['sektor'],
            'koordinat'       => $post['koordinat'],
            'batching_jarak'  => $post['jarak'],
            'kebutuhan_produk' => $post['kebutuhan_produk']
        ];

        if ($post['suplai_select'] != 'NULL') {
            $params['suplai_batching'] = $post['suplai_select'];
        } else {
            $params['suplai_batching'] = $post['suplai_text'];
        }

        if ($post['pembayaran_select'] != 'NULL') {
            $params['metode_pembayaran'] = $post['pembayaran_select'];
        } else {
            $params['metode_pembayaran'] = $post['pembayaran_text'];
        }

        
        $rfq_id = $this->base->insert('rfq_request', $params);

        // echo $rfq_id;

        // if ($this->db->affected_rows() > 0) {
        //     $config['upload_path']          = './uploads/';
        //     $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|xlsx|docs';
        //     $config['encrypt_name']         = true;
        //     $this->load->library('upload', $config);
        //     $jumlah_berkas = count($_FILES['file']['name']);

        //     var_dump($jumlah_berkas, $rfq_id);
        //     // for ($i = 0; $i < $jumlah_berkas; $i++) {
        //     //     if (!empty($_FILES['file']['name'][$i])) {

        //     //         $_FILES['file']['name'] = $_FILES['file']['name'][$i];

        //     //         if ($this->upload->do_upload('file')) {
        //     //             $uploadData = $this->upload->data();
        //     //             $data['file'] = $uploadData['file_name'];
        //     //             $data['type'] = 'Header File';
        //     //             $data['rfq_id']     = $rfq_id;
        //     //             $this->base->add('media', $data);
        //     //         }
        //     //     }
        //     // }
        //     // redirect('home');
        // } else {
        //     set_pesan('Terjadi Kelasahan');
        // }

        // $config['upload_path']          = './uploads/';
        // $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 500;
        // $config['max_width']            = 2048;
        // $config['max_height']           = 1000;
        // $config['encrypt_name']         = true;
        // $this->load->library('upload', $config);
        // $keterangan_berkas = $this->input->post('keterangan_berkas');
        // $jumlah_berkas = count($_FILES['file']['name']);

        // var_dump($post);
        // var_dump($jumlah_berkas);
    }
}
