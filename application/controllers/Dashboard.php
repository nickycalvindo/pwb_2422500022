<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('produk_model');
        $this->load->model('produk_kategori_model');
        $this->load->model('produk_gambar_model');
    }

    public function index()
    {
        $data['title'] = 'Toko Online - PWB 2422500022';
        $data['gambar_model'] = $this->produk_gambar_model;
        $data['list_produk'] = $this->produk_model->get_all();
        $data['list_kategori'] = $this->produk_kategori_model->get_all();

        // Filter pencarian produk untuk form search pada navbar (parameter ?q=).
        $keyword = $this->input->get('q');
        if (!empty($keyword)) {
            $hasil = array();
            foreach ($data['list_produk'] as $produk) {
                if (stripos($produk['pd_nama'], $keyword) !== FALSE) {
                    $hasil[] = $produk;
                }
            }
            $data['list_produk'] = $hasil;
        }

        $this->load->view('ecom/template/header', $data);
        $this->load->view('ecom/template/carausel');
        $this->load->view('ecom/home', $data);
        $this->load->view('ecom/template/footer');
    }
}
