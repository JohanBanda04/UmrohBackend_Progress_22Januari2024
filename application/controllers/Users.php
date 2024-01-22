<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function index()
    {
        // echo "wkwkwk" ; die;
        //echo $this->session->userdata('id_user'); die;
        $ceks = $this->session->userdata('username');
        //echo $ceks; die;
        $id_user = $this->session->userdata('id_user');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $tbl_zona = $this->db->get_where('tbl_zona', array('id_zona' => $_SESSION['id_zona']));
            $tbl_user = $this->db->get_where('tbl_user', array('id_zona' => $_SESSION['id_zona']));

            $array_level = array();
            $array_level_id = array();
            $id_presdirs = array();
            $id_direkturs = array();
            $id_manajers = array();
            $id_baitullahs = array();
            $total_jm_presdir = 0;
            $total_jm_direktur = 0;

            $total_jm_manajer = 0;
            $total_jm_manajer_lunas = 0;
            $total_jm_manajer_belum_lunas = 0;

            $total_jm_baitullah = 0;
            $total_jm_baitullah_lunas = 0;
            $total_jm_baitullah_belum_lunas = 0;

            $total_jamaah_semua_agen = 0;
            $counter = 0;


            $data['total_jamaah'] = $this->db->get("tbl_jamaah");

            /*administrator chart data*/
            /*checking*/
            $zona_level_agen_bk = $this->db->get_where("tbl_role_agen", array(
                "nama_role_agen !=" => 'administrator',
            ))->result();

            $zona_level_agen = $this->db->query("select * from tbl_role_agen where 
nama_role_agen not in('administrator', 'presiden_direktur')")->result();

            $zona_level_agen_new = $this->db->query("select * from tbl_role_agen where 
nama_role_agen not in('administrator', 'presiden_direktur')")->result();

           //echo "<pre>"; print_r($zona_level_agen);
            //die;

            $get_id_role_agen = $this->db->get_where("tbl_agen", array(
                "role_agen_id !=" => '1',

            ))->result();

            foreach ($get_id_role_agen as $index => $dt) {
                $get_data_role_agen = $this->db->get_where('tbl_role_agen', array('id_role_agen' => $dt->role_agen_id))->row();
                $get_role_agen_id = $get_data_role_agen->id_role_agen;
                $get_role_agen_name = $get_data_role_agen->nama_role_agen;

                //echo $get_role_agen_id."<br>";
                //echo $get_role_agen_name."<br>";
                if ($get_role_agen_name == "presiden_direktur") {
                    array_push($id_presdirs, (object)[
                        "id_agen" => $dt->id_agen,

                    ]);

                } else if ($get_role_agen_name == "direktur_mujahid") {
                    array_push($id_direkturs, (object)[
                        "id_agen" => $dt->id_agen,

                    ]);
                } else if ($get_role_agen_name == "manajer_mujahid") {
                    array_push($id_manajers, (object)[
                        "id_agen" => $dt->id_agen,

                    ]);
                } else if ($get_role_agen_name == "baitullah_mujahid") {
                    array_push($id_baitullahs, (object)[
                        "id_agen" => $dt->id_agen,

                    ]);
                }


            }

            /*utk ambil data jenis-jenis level agen*/
            $counting = 0;
            foreach ($zona_level_agen as $level) {
                //echo $level->nama_role_agen."<br>";
                array_push($array_level, (object)[
                    "id_role_agen" => $level->id_role_agen,
                    "nama_role_agen" => $level->nama_role_agen,
                    "nama_role_agen_lengkap" => $level->nama_role_agen_lengkap,
                ]);

                $array_level_id[$counting] = $level->id_role_agen;
                $counting++;
            }


            /*AKTIFKAN DARI SINI JIKA INGIN MEMASUKKAN DATA JAMAAH PRESDIR JG DI DASHBOARD DAN COUNT UTK PRESDIR DIMULAI DARI 0 (NOL)*/
//            $count = 0;
//            $jml_jamaah_presdir_lunas = 0;
//            $jml_jamaah_presdir_belum_lunas = 0;
//            foreach ($id_presdirs as $presdir) {
//                $get_jamaah_presdir = $this->db->get_where("tbl_jamaah", array("agen_pemilik_id" => $presdir->id_agen));
//                $total_jm_presdir = +$total_jm_presdir + $get_jamaah_presdir->num_rows();
//                $realisasi_jamaah_total[$count] = $total_jm_presdir;
//                $total_jamaah_semua_agen = $total_jamaah_semua_agen + $get_jamaah_presdir->num_rows();
//
//                $bayar_dp_umroh = "bayar_dp_umroh";
//                $bayar_lunas_umroh = "bayar_lunas_umroh";
//                $tbl_presdir_jamaah_lunas = $this->db->query("select * from tbl_jamaah where
//status_pembayaran='$bayar_lunas_umroh'
//and agen_pemilik_id='$presdir->id_agen'");
//                $jml_jamaah_presdir_lunas += $tbl_presdir_jamaah_lunas->num_rows();
//
//                $tbl_presdir_jamaah_belum_lunas = $this->db->query("select * from tbl_jamaah where
//status_pembayaran='$bayar_dp_umroh'
//and agen_pemilik_id='$presdir->id_agen'");
//                $jml_jamaah_presdir_belum_lunas += $tbl_presdir_jamaah_belum_lunas->num_rows();
//            }
//            $lunas_only[$count] = $jml_jamaah_presdir_lunas;
//            $belum_lunas_only[$count] = $jml_jamaah_presdir_belum_lunas;
//            echo "jml jamaah presdir lunas: ".$lunas_only[$count]."<br>";
//            echo "jml jamaah presdir belum lunas: ".$belum_lunas_only[$count]."<br>";
            //die;
            /*AKTIFKAN SAMPAI SINI JIKA INGIN MEMASUKKAN DATA JAMAAH PRESDIR JG DI DASHBOARD*/

            //$count = 1;
            $count = 0;
            $jml_jamaah_direktur_lunas = 0;
            $jml_jamaah_direktur_belum_lunas = 0;
            foreach ($id_direkturs as $direktur) {
                $get_jamaah_direktur = $this->db->get_where("tbl_jamaah", array("agen_pemilik_id" => $direktur->id_agen));
                $total_jm_direktur = $total_jm_direktur + $get_jamaah_direktur->num_rows();
                $realisasi_jamaah_total[$count] = $total_jm_direktur;
                $total_jamaah_semua_agen = $total_jamaah_semua_agen + $get_jamaah_direktur->num_rows();


                $bayar_dp_umroh = "bayar_dp_umroh";
                $bayar_lunas_umroh = "bayar_lunas_umroh";
                $tbl_direktur_jamaah_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_lunas_umroh' 
and agen_pemilik_id='$direktur->id_agen'");
                $jml_jamaah_direktur_lunas += $tbl_direktur_jamaah_lunas->num_rows();

                $tbl_direktur_jamaah_belum_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_dp_umroh' 
and agen_pemilik_id='$direktur->id_agen'");
                $jml_jamaah_direktur_belum_lunas += $tbl_direktur_jamaah_belum_lunas->num_rows();
            }
            $lunas_only[$count] = $jml_jamaah_direktur_lunas;
            $belum_lunas_only[$count] = $jml_jamaah_direktur_belum_lunas;
            //echo "jml jamaah direktur lunas: ".$lunas_only[$count]."<br>";
            //echo "jml jamaah direktur belum lunas: ".$belum_lunas_only[$count]."<br>";
            //die;

            //$count = 2;
            $count = 1;
            $jml_jamaah_manajer_lunas = 0;
            $jml_jamaah_manajer_belum_lunas = 0;
            foreach ($id_manajers as $manajer) {
                $get_jamaah_manajer = $this->db->get_where("tbl_jamaah", array("agen_pemilik_id" => $manajer->id_agen));
                $total_jm_manajer = $total_jm_manajer + $get_jamaah_manajer->num_rows();
                $realisasi_jamaah_total[$count] = $total_jm_manajer;
                $total_jamaah_semua_agen = $total_jamaah_semua_agen + $get_jamaah_manajer->num_rows();

                $bayar_dp_umroh = "bayar_dp_umroh";
                $bayar_lunas_umroh = "bayar_lunas_umroh";
                $tbl_manajer_jamaah_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_lunas_umroh' 
and agen_pemilik_id='$manajer->id_agen'");
                $jml_jamaah_manajer_lunas += $tbl_manajer_jamaah_lunas->num_rows();

                $tbl_manajer_jamaah_belum_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_dp_umroh' 
and agen_pemilik_id='$manajer->id_agen'");
                $jml_jamaah_manajer_belum_lunas += $tbl_manajer_jamaah_belum_lunas->num_rows();
            }
            $lunas_only[$count] = $jml_jamaah_manajer_lunas;
            $belum_lunas_only[$count] = $jml_jamaah_manajer_belum_lunas;
            //echo "jml jamaah manajer lunas: ".$lunas_only[$count]."<br>";
            //echo "jml jamaah manajer belum lunas: ".$belum_lunas_only[$count]."<br>";
            //die;

            //$count = 3;
            $count = 2;
            $jml_jamaah_baitullah_lunas = 0;
            $jml_jamaah_baitullah_belum_lunas = 0;
            foreach ($id_baitullahs as $baitul) {
                $get_jamaah_baitul = $this->db->get_where("tbl_jamaah", array("agen_pemilik_id" => $baitul->id_agen));
                $total_jm_baitullah = $total_jm_baitullah + $get_jamaah_baitul->num_rows();
                $realisasi_jamaah_total[$count] = $total_jm_baitullah;
                $total_jamaah_semua_agen = $total_jamaah_semua_agen + $get_jamaah_baitul->num_rows();

                $bayar_dp_umroh = "bayar_dp_umroh";
                $bayar_lunas_umroh = "bayar_lunas_umroh";
                $tbl_baitullah_jamaah_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_lunas_umroh' 
and agen_pemilik_id='$baitul->id_agen'");
                $jml_jamaah_baitullah_lunas += $tbl_baitullah_jamaah_lunas->num_rows();

                $tbl_baitullah_jamaah_belum_lunas = $this->db->query("select * from tbl_jamaah where 
status_pembayaran='$bayar_dp_umroh' 
and agen_pemilik_id='$baitul->id_agen'");
                $jml_jamaah_baitullah_belum_lunas += $tbl_baitullah_jamaah_belum_lunas->num_rows();

            }

            $lunas_only[$count] = $jml_jamaah_baitullah_lunas;
            $belum_lunas_only[$count] = $jml_jamaah_baitullah_belum_lunas;
            //echo "jml jamaah baitullah lunas: ".$lunas_only[$count]."<br>";
            //echo "jml jamaah baitullah belum lunas: ".$belum_lunas_only[$count]."<br>";
            //die;

            //$data['total_jamaah'] = $this->db->get_where("tbl_jamaah",array("agen_id"=>$this->session->userdata('id_user')));
            //echo "<pre>"; print_r($realisasi_jamaah_total); die;
            //echo "<pre>"; print_r($total_jamaah_semua_agen); die;
            $data['realisasi_jamaah_total'] = $realisasi_jamaah_total;
            $data['realisasi_jamaah_total_lunas'] = $lunas_only;
            $data['realisasi_jamaah_total_belum_lunas'] = $belum_lunas_only;
            $data['array_level_id'] = $array_level_id;
            $data['id_presdirs'] = $id_presdirs;
            $data['id_direkturs'] = $id_direkturs;
            $data['id_manajers'] = $id_manajers;
            $data['id_baitullahs'] = $id_baitullahs;
            //echo "<pre>"; print_r($data['array_level_id']); die;
            $data['total_jamaah_semua_agen'] = $total_jamaah_semua_agen;
            $data['array_level'] = $array_level;
            $get_tbl_agen = $this->db->get_where("tbl_agen", array("id_agen" => $this->session->userdata('id_user')));

            $id_atasan = $get_tbl_agen->row()->sponsor_atasan;
            $data['bonus'] = $get_tbl_agen->row()->bonus_umroh_valid;
            $data['bonus_haji'] = $get_tbl_agen->row()->bonus_haji_valid;

            $data['zona_level_agen'] = $zona_level_agen;

            // echo $data['zona_level_agen']; die;

//            echo $id_atasan; die;

            $nama_atasan = $this->db->get_where("tbl_agen",
                array(
                    "id_agen" => $id_atasan
                )
            )->row()->nama_agen;

            //echo $nama_atasan; die;
            $data["nama_atasan"] = $nama_atasan;
            // echo "<pre>"; print_r($get_tbl_agen->row()); die;

            //echo $data['total_jamaah']->num_rows(); die;

            /*cara get semua record database pada tbl_zona*/
            $data_zonaAll = $this->db->get("tbl_zona")->result();

            //$pemda_id
            $data_harmonisasi = $this->db->get("tbl_berita")->result();

            //echo '<pre>'; print_r($tbl_user->result()[0]);die;
            //echo '<pre>'; print_r($data_harmonisasi);die;
            // echo '<pre>'; print_r($data_zonaAll);die;


            $array_daerah = array();
            $counter = 0;
            $total = 0;
            $total_dokumen = 0;
            foreach ($data_zonaAll as $key => $val) {
                if ($val->nama_zona != "kasub_perancang" && $val->nama_zona != "superadmin" && $val->nama_zona != "perancang") {

                    $tbl_berita_by_zona = $this->db->get_where('tbl_berita', array(
                        'zona_dokumen' => $val->nama_zona
                    ));

                    $tbl_berita_by_zona_selesai_only = $this->db->get_where('tbl_berita', array(
                        'zona_dokumen' => $val->nama_zona,
                        'status' => "selesai"
                    ));
                    $tbl_berita_by_zona_belum_selesai_only = $this->db->get_where('tbl_berita', array(
                        'zona_dokumen' => $val->nama_zona,
                        'status !=' => "selesai"
                    ));
                    //echo $val->nama_zona." : ".$tbl_berita_by_zona->num_rows()."<br>";

                    $zona_id[$counter] = $tbl_berita_by_zona->num_rows();
                    $selesai_only[$counter] = $tbl_berita_by_zona_selesai_only->num_rows();
                    $belum_selesai_only[$counter] = $tbl_berita_by_zona_belum_selesai_only->num_rows();
                    //$zona_id_pemda[$val->id_zona] = $tbl_berita_by_zona->num_rows();
                    $pemda_id[$counter] = $val->id_zona;
                    $nama_zona[$counter] = $val->nama_panjang;


                    $total += $tbl_berita_by_zona->num_rows();
                    $total_dokumen += $tbl_berita_by_zona->num_rows();

                    $counter++;

                    array_push($array_daerah, (object)[
                        "id_zona" => $val->id_zona,
                        "nama_zona" => $val->nama_zona,
                        "nama_panjang" => $val->nama_panjang,
                        "status" => $val->status,
                        "jumlah_dokumen_harmonisasi" => $tbl_berita_by_zona->num_rows(),
                    ]);
                }
                //echo '<pre>'; print_r($data_zonaAll[$key]->nama_zona);
                //echo $val->nama_zona."<br>";

            }
            //echo $total_dokumen; die;

            // echo "<pre>"; print_r($tbl_berita_by_zona->result()); die;

            //echo "<pre>";  print_r($nama_zona); die;
            //echo "<pre>"; print_r($zona_id);

            //echo $total; die;
            //die;

            $data['realisasi_harmonisasi_total'] = $zona_id;
            $data['selesai_only'] = $selesai_only;
            $data['belum_selesai_only'] = $belum_selesai_only;
            //echo "<pre>"; print_r($zona_id); die;
            //echo "<pre>"; print_r($selesai_only); die;
            //echo "<pre>"; print_r($belum_selesai_only); die;
            $data['pemda_id'] = $pemda_id;
            $data['total'] = $total;
            //echo "<pre>"; print_r($zona_id); die;


            $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);
            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            //echo "<pre>"; print_r($data['user']->row()); die;
            $data['users'] = $this->Mcrud->get_users();
            $data['nama_panjang_admin'] = $tbl_zona->row()->nama_panjang;
            $data['nama_lengkap'] = $tbl_user->row()->nama_lengkap;
            $data['zona_pemda'] = $tbl_zona->row()->nama_zona;

            $data['zona_daerah_list'] = $data_zonaAll;
            $data['zona_daerah_list_ii'] = $nama_zona;
            $data['array_daerah'] = $array_daerah;

            //echo "<pre>"; print_r($array_daerah); die;


            //echo "<pre>"; print_r($data_zonaAll); die;


//			foreach ($tbl_user->result() as $idx=>$val){
//			    if ($_SESSION['username']==$tbl_zona->row()->nama_zona){
//
//                }
//            }

            $data['judul_web'] = "Dashboard";

            //echo "wkwokwow"; die;
            $this->load->view('users/header', $data);
            $this->load->view('users/dashboard', $data);
            $this->load->view('users/footer');
        }
    }

    //lanjutkan utk beri parameter aksi dan id pada function profile ini, yg dipanggil melalui header (dlm folder user)
    public function profile($aksi = '', $id = '')
    {
        //echo "wey"; die;
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            if ($aksi == "se") {
                //echo "simpan edit";die;
                $input_old_password = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 = htmlentities(strip_tags($this->input->post('new_password_2')));

                //echo $new_password_1; die;

                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_agen",
                    array(
                        'id_agen' => $this->session->userdata('id_user')
                    )
                );


                $data_password_lama = $data_lama->result()[0]->password;

//                echo $data_password_lama."<br>";
//                echo crypt($input_old_password,'salt-coba')."<br>";
//                die;


                $id_user = $this->session->userdata("id_user");
                //echo $id_user; die;
                $nama_lengkap = $data_lama->result()[0]->nama_agen;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->role_agen_id;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if ($data_password_lama == crypt($input_old_password, 'salt-coba')) {
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if ($new_password_1 == '' && $new_password_2 == '') {
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        //$password_to_save = $data_lama->result()[0]->password;
                        $password_to_save = $data_password_lama;
                    } else if (($new_password_1 != '' && $new_password_2 == '') or ($new_password_1 == '' && $new_password_2 != '')) {
                        //echo "salah 1 inputan password baru belum di isi"; die;
                        $simpan = "n";
                    } else if ($new_password_1 != '' && $new_password_2 != '') {
                        //echo "sampai sini  ygy"; die;
                        if ($new_password_1 == $new_password_2) {
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1 != $new_password_2) {
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
//                        echo "pass to save : ".$password_to_save; die;
                    }

                    //echo "password to save : ".$password_to_save; die;

                    if ($simpan == "y") {
                        $data = array(
                            'id_agen' => $id_user,
                            'nama_agen' => $nama_lengkap,
                            'username' => $username,
                            'password' => crypt($password_to_save, "salt-coba"),
                            'role_agen_id' => $level,
                            'tgl_update' => date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_agen", $data, array(
                            'id_agen' => $id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses !</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if ($simpan == "n") {
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/" . $id);
            }
            //echo "wkwkwkwkeke"; die;
            $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);
            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            //echo "<pre>"; print_r($data['user']->row()); die;
            $data['user_bk'] = $this->Mcrud->get_users_by_un($ceks);
            $data['level_users'] = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] = "Ganti Password Pengguna";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile', $data);
            $this->load->view('users/footer');
        }
    }

    public function profile_atasan($aksi = '', $id = '')
    {
        //echo "profile atasan"; die;
        //echo hashids_decrypt($id);die;
        //echo $id;die;
        //echo $aksi."<br>";
        //echo $id; die;
        //echo $_SESSION['id_user'];die;
        $ceks = $this->session->userdata('username');

        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            if ($aksi == "se") {
                //echo "simpan edit";die;
                $input_old_password = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 = htmlentities(strip_tags($this->input->post('new_password_2')));
                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
                $data_password_lama = $data_lama->result()[0]->password;

                //echo $old_password."<br>".$new_password_1."<br>".$new_password_2; die;

                $id_user = $_SESSION['id_user'];
                $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->level;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if ($data_password_lama == crypt($input_old_password, 'salt-coba')) {
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if ($new_password_1 == '' && $new_password_2 == '') {
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        $password_to_save = $data_lama->result()[0]->password;
                    } else if ($new_password_1 != '' || $new_password_2 != '') {

                        if ($new_password_1 == $new_password_2) {
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1 != $new_password_2) {
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
                    }

                    if ($simpan == "y") {
                        $data = array(
                            'id_user' => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'username' => $username,
                            'password' => crypt($password_to_save, "salt-coba"),
                            'level' => $level,
                            'id_zona' => $id_zona,
                            'tgl_update' => date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_user", $data, array(
                            'id_user' => $id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 brohs!</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if ($simpan == "n") {
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/" . $id);
            }
//            echo $id_user; die;
            $get_tbl_agen_for_atasan = $this->db->get_where("tbl_agen", array("id_agen" => $id_user))->row();
            $id_atasan = $get_tbl_agen_for_atasan->sponsor_atasan;

            //echo $id_atasan; die;

            $get_dt_atasan = $this->db->get_where("tbl_agen", array("id_agen" => $id_atasan))->row();
            $data["nama_atasan_lengkap"] = $get_dt_atasan->nama_agen;

            $get_data_role_agen = $this->db->get_where("tbl_role_agen", array("id_role_agen" => $get_dt_atasan->role_agen_id))->row();
            $data["nama_role_atasan"] = $get_data_role_agen->nama_role_agen_lengkap;

            $get_jumlah_agen_atasan = $this->db->get_where("tbl_agen", array("sponsor_atasan" => $id_atasan));
            $data["jumlah_agen_atasan"] = $get_jumlah_agen_atasan->num_rows();

            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            $data['level_users'] = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] = "Profile Atasan";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile_atasan', $data);
            $this->load->view('users/footer');
        }
    }

    public function history_pencairan($aksi = '', $id = '')
    {

        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            if ($aksi == "se") {
                //echo "simpan edit";die;
                $input_old_password = htmlentities(strip_tags($this->input->post('old_password')));
                $new_password_1 = htmlentities(strip_tags($this->input->post('new_password_1')));
                $new_password_2 = htmlentities(strip_tags($this->input->post('new_password_2')));
                //ini juga kunci kesuksesan get data dari database
                //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
                $data_lama = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
                $data_password_lama = $data_lama->result()[0]->password;

                //echo $old_password."<br>".$new_password_1."<br>".$new_password_2; die;

                $id_user = $_SESSION['id_user'];
                $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
                $username = $data_lama->result()[0]->username;
                $password = $data_lama->result()[0]->password;
                $level = $data_lama->result()[0]->level;
                $id_zona = $data_lama->result()[0]->id_zona;

                $pesan = "Data Belum Berhasil Disimpan!";

                //echo $data_password_lama."<br>".$input_old_password;die;

                if ($data_password_lama == crypt($input_old_password, 'salt-coba')) {
                    //echo "inputan pass old oleh user SAMA DENGAN old pass di DB";die;
                    if ($new_password_1 == '' && $new_password_2 == '') {
                        //echo "pass 1 dan 2 tidak di isi"; die;
                        $simpan = "y";
                        $password_to_save = $data_lama->result()[0]->password;
                    } else if ($new_password_1 != '' || $new_password_2 != '') {

                        if ($new_password_1 == $new_password_2) {
                            //echo "password 1 dan 2 sama";die;
                            $simpan = "y";
                            $password_to_save = $new_password_1;
                        } else if ($new_password_1 != $new_password_2) {
                            //echo "password 1 dan 2 tidak sama";die;
                            $simpan = "n";
                            $password_to_save = $data_lama->result()[0]->password;
                        }
                    }

                    if ($simpan == "y") {
                        $data = array(
                            'id_user' => $id_user,
                            'nama_lengkap' => $nama_lengkap,
                            'username' => $username,
                            'password' => crypt($password_to_save, "salt-coba"),
                            'level' => $level,
                            'id_zona' => $id_zona,
                            'tgl_update' => date('Y-m-d H:i:s'),
                        );
                        $this->db->update("tbl_user", $data, array(
                            'id_user' => $id_user,
                        ));

                        $this->session->set_flashdata('msg',
                            '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 brohs!</strong> Berhasil disimpan.
							</div>
						  <br>'
                        );

                    } else if ($simpan == "n") {
                        $this->session->set_flashdata('msg',
                            '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                        );

                    }
                } else {
                    //echo "inputan pass old oleh user TIDAK SAMA DENGAN old pass di DB";die;
                    $this->session->set_flashdata('msg',
                        '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                    );

                }
                redirect("users/profile/e/" . $id);
            }
//            echo $id_user; die;
            $get_tbl_agen_for_atasan = $this->db->get_where("tbl_agen", array("id_agen" => $id_user))->row();
            $id_atasan = $get_tbl_agen_for_atasan->sponsor_atasan;

            //echo $id_atasan; die;

            $get_dt_atasan = $this->db->get_where("tbl_agen", array("id_agen" => $id_atasan))->row();
            $data["nama_atasan_lengkap"] = $get_dt_atasan->nama_agen;

            $get_data_role_agen = $this->db->get_where("tbl_role_agen", array("id_role_agen" => $get_dt_atasan->role_agen_id))->row();
            $data["nama_role_atasan"] = $get_data_role_agen->nama_role_agen_lengkap;

            $get_jumlah_agen_atasan = $this->db->get_where("tbl_agen", array("sponsor_atasan" => $id_atasan));
            $data["jumlah_agen_atasan"] = $get_jumlah_agen_atasan->num_rows();

            $data['user'] = $this->Mcrud->get_users_by_un_tbl_agen($ceks);
            $data['level_users'] = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            //$data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] = "Profile Atasan";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile_atasan', $data);
            $this->load->view('users/footer');
        }
    }

    public function update_pass()
    {
        //echo "update pass route tes"; die;
        //echo $_SESSION['id_user'];die;
        $ceks = $this->session->userdata('username');
        $id_user = $this->session->userdata('id_user');
        $level = $this->session->userdata('level');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {
            $new_password_1 = htmlentities(strip_tags($this->input->post('new_password_1')));
            $new_password_2 = htmlentities(strip_tags($this->input->post('new_password_2')));
            //ini juga kunci kesuksesan get data dari database
            //$data_lama = $this->db->get_where("tbl_user", array('id_user'=>$_SESSION['id_user']))->row();
            $data_lama = $this->db->get_where("tbl_user", array('id_user' => $_SESSION['id_user']));
            //echo $data_lama->password; die;
            //echo $new_password_1."<br>".$new_password_2; die;
            //echo $new_password_1."<br>".$new_password_2; die;

            //echo $data_lama->num_rows();die;
            //echo $data_lama->result()[0]->password;die;

            $id_user = $_SESSION['id_user'];
            $nama_lengkap = $data_lama->result()[0]->nama_lengkap;
            $username = $data_lama->result()[0]->username;
            $password = $data_lama->result()[0]->password;
            $level = $data_lama->result()[0]->level;
            $id_zona = $data_lama->result()[0]->id_zona;

            $pesan = "Data Belum Berhasil Disimpan!";
            if ($new_password_1 == '' && $new_password_2 == '') {
                //echo "pass 1 dan 2 tidak di isi"; die;
                $simpan = "y";
                $password = $data_lama->result()[0]->password;
            } else if ($new_password_1 != '' || $new_password_2 != '') {
                //echo "salah 1 pass 1 dan 2 telah di isi"; die;
                if ($new_password_1 == $new_password_2) {
                    //echo "password 1 dan 2 sama";die;
                    $simpan = "y";
                    $password = $new_password_1;
                } else if ($new_password_1 != $new_password_2) {
                    //echo "password 1 dan 2 tidak sama";die;
                    $simpan = "n";
                    $password = $data_lama->result()[0]->password;
                }
            }

            if ($simpan == "y") {
                $data = array(
                    'id_user' => $id_user,
                    'nama_lengkap' => $nama_lengkap,
                    'username' => $username,
                    'password' => $password,
                    'level' => $level,
                    'id_zona' => $id_zona,
                );
                $this->db->update("tbl_user", $data, array(
                    'id_user' => $id_user,
                ));

                $this->session->set_flashdata('msg',
                    '
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses5 broh!</strong> Berhasil disimpan.
							</div>
						  <br>'
                );

            } else if ($simpan == "n") {
                $this->session->set_flashdata('msg',
                    '
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
												 </button>
												 <strong>Gagal!</strong> ' . $pesan . '.
											</div>
										 <br>'
                );
            }

            $data['user'] = $this->Mcrud->get_users_by_un($ceks);
            $data['level_users'] = $this->Mcrud->get_level_users();
            $get_password = $this->db->get_where("tbl_user", array(
                'id_user' => $_SESSION['id_user'],
            ));
            //ini adalah kunci kesuksesan mendapat data dari database
            //echo $get_password->result()[0]->password; die;

            $data['password_lama'] = $get_password->result()[0]->password;
            $data['judul_web'] = "Profile";

            $this->load->view('users/header', $data);
            $this->load->view('users/profile', $data);
            $this->load->view('users/footer');
        }
    }

}
