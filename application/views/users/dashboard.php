<?php
$cek    = $user->row();
$level  = $cek->level;


?>
<!-- begin #content -->
<div id="content" class="content">
	  <!-- begin breadcrumb -->
	  <ol class="breadcrumb pull-right">
		<li class="active">Dashboard</li>
	  </ol>
	  <!-- end breadcrumb -->
	  <!-- begin page-header -->
    <?php
    $nama_user = explode('_',$_SESSION['username']);
    if(count($nama_user)==3){
        $nama_user_fix = $nama_user[0]." ".$nama_user[1]." ".$nama_user[2];
    } else if (count($nama_user)==2){
        $nama_user_fix = $nama_user[0]." ".$nama_user[1];
    } else if (count($nama_user)==1){
        $nama_user_fix = $nama_user[0];
    }
    ?>
	  <h1 class="page-header" style="font-size: 25px">Dashboard  <small> <?php echo strtoupper($nama_user_fix);?></small></h1>
	  <h3 class="page-header"  style="font-size: 18px">Selamat Datang di SITAROH</h3>
	  <!-- end page-header -->
	  <!-- begin row -->



	<!-- DASHBOARD superADMIN -->

	<div class="row">
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div style="margin-left: 3px" class="row hidden">
                    <h5>Unggah Dokumen Hasil Harmonisasi</h5>
                    <br>
                    <a href="harmonisasi/v/t.html" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Dokumen </a>

                </div>

<!--                <hr>-->
                <h5 style="font-family: Karla-Regular; font-size: 15px">Lihat Dokumen Jamaah<?php
                    /*tempat orek2*/
                    //echo $nama_lengkap;
                    //echo "<pre>"; print_r($zona_daerah_list);
                ?></h5>
                <?php
                echo $this->session->flashdata('msg');

//                echo $this->session->userdata('id_user',"$row->id_user")."<br>";
//                echo $this->session->userdata('nama_lengkap',"$row->nama_lengkap")."<br>";
//                echo $this->session->userdata('username',"$row->username")."<br>";
//                echo $this->session->userdata('level',"$row->level")."<br>";
//                echo $this->session->userdata('id_cabang',"$row->id_cabang")."<br>";
//                echo $this->session->userdata('nama_cabang',"$tbl_cabang->nama_cabang")."<br>";
//                echo $this->session->userdata('nama_panjang_cabang',"$tbl_cabang->nama_panjang")."<br>";
//                echo $this->session->userdata('nid_zona', "$row->id_zona")."<br>";
//                echo $this->session->userdata('nama_zona', $tbl_zona->nama_zona)."<br>";
//                die;
                ?>
                <div class="row">
                    <?php
                    if($this->session->userdata('nama_level')=="administrator"
                        || $this->session->userdata('nama_level')=="presiden_direktur" ){
                        $col_data = 'col-md-6';
                    } else if($this->session->userdata('nama_level')=="direktur_mujahid"){
                        $col_data = 'col-md-4';
                    } else if($this->session->userdata('nama_level')=="manajer_mujahid"){
                        $col_data = 'col-md-4';
                    } else if($this->session->userdata('nama_level')=="baitullah_mujahid"){
                        $col_data = 'col-md-4';
                    }
                    ?>
                    <div class="<?= $col_data?>" >
                        <a href="jamaah/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc" style="font-family: Karla-Regular; font-size: 15px">Total Jamaah</div>
                                <div class="stats-number">
                                    <?php

                                        echo $total_jamaah->num_rows()." Data Jamaah";
                                    ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div  class="stats-desc" style="font-family: Karla-Regular; font-size: 13px;">Lihat Detail Jamaah</div>
                            </div>
                        </a>

                    </div>

                    <?php
                    if($nama_atasan!="Administrator"){
                        ?>
                        <div class="<?= $col_data?>" >
                            <a href="users/profile_atasan/e/<?= hashids_encrypt($_SESSION['id_user']); ?>" style="text-decoration: none">
                                <div class="widget widget-stats bg-gradient-purple-inverse text-inverse">
                                    <div class="stats-icon stats-icon-lg stats-icon-square">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <div class="stats-desc" style="font-family: Karla-Regular; font-size: 15px">Atasan</div>
                                    <div class="stats-number" style="color: white">
                                        <?php
                                        echo $nama_atasan;
                                        ?>
                                    </div>
                                    <div class="stats-progress progress">
                                        <div class="progress-bar" style="width: 70.1%;"></div>
                                    </div>
                                    <div class="stats-desc" style="font-family: Karla-Regular; font-size: 13px">Lihat Data Atasan</div>
                                </div>
                            </a>

                        </div>
                        <?php

                    }
                    ?>



                    <?php
                    /*ubah jadi 'presiden_direktur' jika inging hide kotak bonus dari role presiden_direktur*/
                    if($this->session->userdata("nama_level")!="presdir"){
                        ?>
                        <div  class="<?= $col_data?>" >
                            <a href="bonus/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>" style="text-decoration: none">
                                <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                    <div class="stats-icon stats-icon-lg stats-icon-square">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </div>
                                    <div class="stats-desc" style="font-family: Karla-Regular; font-size: 15px">Total Bonus Umroh</div>
                                    <div class="stats-number">
                                        <?php
                                        echo "Rp ".number_format($bonus);

                                        ?>
                                    </div>
                                    <div class="stats-progress progress">
                                        <div class="progress-bar" style="width: 70.1%;"></div>
                                    </div>
                                    <div  class="stats-desc" style="font-family: Karla-Regular; font-size: 13px">Lihat History Pencairan</div>
                                </div>
                            </a>

                        </div>
                        <?php
                    }
                    ?>


                    <?php
                    /*ubah jadi 'presiden_direktur' jika inging hide kotak bonus dari role presiden_direktur*/
                    if($this->session->userdata("nama_level")!="presdir"){
                        ?>
                        <div  class="hidden col-md-3" >
                            <a href="bonus/v/aksi/id/<?php echo hashids_encrypt($this->session->userdata('id_user'))?>" style="text-decoration: none">
                                <div class="widget widget-stats bg-gradient-green-light text-inverse">
                                    <div class="stats-icon stats-icon-lg stats-icon-square">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </div>
                                    <div class="stats-desc" style="font-family: Karla-Regular; font-size: 15px">Total Bonus Haji</div>
                                    <div class="stats-number">
                                        <?php
                                        echo "Rp ".number_format($bonus_haji);

                                        ?>
                                    </div>
                                    <div class="stats-progress progress">
                                        <div class="progress-bar" style="width: 70.1%;"></div>
                                    </div>
                                    <div  class="stats-desc" style="font-family: Karla-Regular; font-size: 13px">Lihat History Pencairan</div>
                                </div>
                            </a>

                        </div>
                        <?php
                    }
                    ?>



                    <!--dari sini sampai sini-->
                    <div <?php if($_SESSION['nama_zona']=='pemprov_ntb'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='perancang') { ?> class="col-md-3" <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemprov_ntb.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-purple text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemprov NTB</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }

                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemprov_ntb'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>

                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemprov_ntb'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemprov_ntb.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemprov NTB</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemprov_ntb'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkot_mataram'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkot_mataram.html" style="text-decoration: none; ">
                            <div class="widget widget-stats bg-gradient-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Mataram</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkot_mataram'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>
                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkot_mataram'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkot_mataram.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Mataram</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkot_mataram'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>



                    <div <?php if($_SESSION['nama_zona']=='pemkot_bima'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkot_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-dark-blue-light text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkot_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>
                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkot_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkot_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkot Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkot_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkab_sumbawa_barat'){?> class="col-md-6" <?php }   else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_sumbawa_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_sumbawa_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>
                        </a>

                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkab_sumbawa_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_sumbawa_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_sumbawa_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_sumbawa'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_sumbawa.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-green text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_sumbawa'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkab_sumbawa'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_sumbawa.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Sumbawa</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_sumbawa'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_utara'){?> class="col-md-6" <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_utara.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-blue-inverse text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Utara</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_utara'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>

                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_utara'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_utara.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Utara</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_utara'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_timur'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_timur.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-yellow text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Timur</div>
                                <div style="color: white" class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_timur'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_timur'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_timur.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Timur</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_timur'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_tengah'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_tengah.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-blue-dark text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Tengah</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_tengah'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_tengah'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_tengah.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Tengah</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_tengah'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_barat'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_lombok_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-pink text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_lombok_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_lombok_barat'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_lombok_barat.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Lombok Barat</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_lombok_barat'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_dompu'){?> class="col-md-6" <?php }  else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_dompu.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Dompu</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_dompu'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div hidden <?php if($_SESSION['nama_zona']=='pemkab_dompu'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_dompu.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Dompu</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_dompu'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_bima'){?> class="col-md-6" <?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="harmonisasi/v/pemkab_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-purple-inverse text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Bima</div>
                                <div style="color: #f9fffb" class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_berita', array('zona_dokumen'=>'pemkab_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Harmonisasi</div>
                            </div>

                        </a>
                    </div>
                    <div <?php if($_SESSION['nama_zona']=='pemkab_bima'){?> class="col-md-6" <?php } else if($_SESSION['nama_zona']=='superadmin'){ ?> class="col-md-3 hidden"<?php } else { ?> class="col-md-3 hidden" <?php } ?> >
                        <a href="pemda/draft/pemkab_bima.html" style="text-decoration: none">
                            <div class="widget widget-stats bg-gradient-red-orange text-inverse">
                                <div class="stats-icon stats-icon-lg stats-icon-square">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </div>
                                <div class="stats-desc">Pemkab Bima</div>
                                <div class="stats-number">
                                    <?php
                                    if($level=='pelaksana'){
                                        $this->db->where('id_user',$cek->id_user);
                                    }
                                    echo number_format($this->db->get_where('tbl_draft', array('zona_dokumen'=>'pemkab_bima'))->num_rows(),0,",","."); ?>
                                </div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Total Dokumen Draft Raperda</div>
                            </div>
                        </a>

                    </div>
                    <!--sampai sini-->
                </div>

                <!--bar chart dari sini-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="realisasi-card card">
                            <div class="card-body">
                                <!--grafik data paling awal bar chart zona daerah-->
                                <canvas id="bar_chart_by_level" height="175">tes</canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!--bar chart sampai sini-->

                <div  class="c-content-accordion-1 c-theme dashboard-all">
                    <div class="panel-group" id="accordion" role="tablist">
                        <?php
                        //echo "<pre>"; print_r($array_daerah) ;
                        //echo "<pre>"; print_r($zona_daerah_list_ii) ; die;
                        ?>

                        <?php
                            $isFirst = true;
                            foreach ($array_level as $key=>$val){
                                //echo $val->id_zona;
                                ?>
                                <div class="panel">
                                    <div class="panel-heading dipa-accordion-btn" role="tab"
                                         id="heading<?php echo $val->id_role_agen; ?>" style="color: white">
                                        <h4 class="panel-title">
                                            <a class="c-font-bold c-font-19"  data-toggle="collapse"
                                               data-parent="#accordion"
                                               href="#collapse<?php echo $val->id_role_agen; ?>"
                                               aria-expanded="true"
                                               aria-controls="collapse<?php echo $val->id_role_agen; ?>">
                                                <?php echo $val->nama_role_agen_lengkap; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo $val->id_role_agen; ?>"
                                         class="panel-collapse collapse <?php if ($isFirst) { ?> in <?php } ?>"
                                         role="tabpanel"
                                         aria-labelledby="heading<?php echo $val->id_role_agen; ?>">
                                        <div class="panel-body c-font-18">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="realisasi-card card">
                                                        <div class="card-body">
                                                            <div class="penyerapan-chart row">
                                                                <div class="col-md-5">
                                                                    <canvas id="chart_penyerapan<?php echo $val->id_role_agen; ?>"></canvas>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="dashboard-progress">
                                                                        <div class="progress-title" style="color: white">
                                                                            TOTAL JAMAAH
                                                                        </div>
                                                                        <div class="text-white progress-angka">
                                                                            <?php

                                                                            $get_agen_by_role = $this->db->get_where("tbl_agen",array("role_agen_id"=>$val->id_role_agen))->result();


                                                                            $jml_jamaah_per_level = 0;
                                                                            $jml_jamaah_per_level_lunas = 0;
                                                                            $jml_jamaah_per_level_belum_lunas = 0;
                                                                            foreach ($get_agen_by_role as $agency){
                                                                                $get_jamaah = $this->db->get_where("tbl_jamaah",array(
                                                                                        "agen_pemilik_id"=>$agency->id_agen
                                                                                ));

                                                                                $get_jamaah_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                        "agen_pemilik_id"=>$agency->id_agen,
                                                                                        "status_pembayaran"=>"bayar_lunas_umroh"
                                                                                ));
                                                                                $get_jamaah_belum_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                        "agen_pemilik_id"=>$agency->id_agen,
                                                                                        "status_pembayaran"=>"bayar_dp_umroh"
                                                                                ));
                                                                                $jml_jamaah_per_level = $jml_jamaah_per_level + $get_jamaah->num_rows();
                                                                                $jml_jamaah_per_level_lunas = $jml_jamaah_per_level_lunas + $get_jamaah_lunas->num_rows();
                                                                                $jml_jamaah_per_level_belum_lunas = $jml_jamaah_per_level_belum_lunas + $get_jamaah_belum_lunas->num_rows();

                                                                            }
                                                                            //echo $jml_jamaah_per_level."<br>";
                                                                            //echo $jml_jamaah_per_level_lunas."<br>";
                                                                            //echo $jml_jamaah_per_level_belum_lunas."<br>";

                                                                            $total_dokumen_per_zona =  $jml_jamaah_per_level;

                                                                            $total_dokumen_per_zona_selesai =  $jml_jamaah_per_level_lunas;

                                                                            $total_dokumen_per_zona_belum_selesai =  $jml_jamaah_per_level_belum_lunas;

                                                                            $persentase_total = ($total_dokumen_per_zona * 100) / ($total_dokumen_per_zona_selesai + $total_dokumen_per_zona_belum_selesai) ;
                                                                            //cukz

                                                                            $persentase_total_formatted = number_format($persentase_total,2,",","");
                                                                            if($persentase_total_formatted=='nan'){
                                                                                $persentase_total_formatted = 0;
                                                                            }
                                                                            echo $total_dokumen_per_zona ." JAMAAH"." (".$persentase_total_formatted." %)";
                                                                            ?>
                                                                        </div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-striped" role="progressbar"
                                                                                 style="<?php if ($persentase_total_formatted=="nan"){ ?>
                                                                                         width: 0%;
                                                                                 <?php } else  { ?>
                                                                                         width: 100%;
                                                                                 <?php } ?>" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="dashboard-progress">
                                                                        <div class="progress-title">JAMAAH SUDAH LUNAS </div>
                                                                        <div class="text-white progress-angka">
                                                                            <?php

                                                                            $get_agen_by_role = $this->db->get_where("tbl_agen",array("role_agen_id"=>$val->id_role_agen))->result();


                                                                            $jml_jamaah_per_level = 0;
                                                                            $jml_jamaah_per_level_lunas = 0;
                                                                            $jml_jamaah_per_level_belum_lunas = 0;
                                                                            foreach ($get_agen_by_role as $agency){
                                                                                $get_jamaah = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen
                                                                                ));

                                                                                $get_jamaah_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen,
                                                                                    "status_pembayaran"=>"bayar_lunas_umroh"
                                                                                ));
                                                                                $get_jamaah_belum_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen,
                                                                                    "status_pembayaran"=>"bayar_dp_umroh"
                                                                                ));
                                                                                $jml_jamaah_per_level = $jml_jamaah_per_level + $get_jamaah->num_rows();
                                                                                $jml_jamaah_per_level_lunas = $jml_jamaah_per_level_lunas + $get_jamaah_lunas->num_rows();
                                                                                $jml_jamaah_per_level_belum_lunas = $jml_jamaah_per_level_belum_lunas + $get_jamaah_belum_lunas->num_rows();

                                                                            }

                                                                            $total_dokumen_per_zona =  $jml_jamaah_per_level;

                                                                            $total_dokumen_per_zona_selesai =  $jml_jamaah_per_level_lunas;

                                                                            $total_dokumen_per_zona_belum_selesai =  $jml_jamaah_per_level_belum_lunas;

                                                                            $persentase_total_selesai = ($total_dokumen_per_zona_selesai * 100) / ($total_dokumen_per_zona_selesai + $total_dokumen_per_zona_belum_selesai) ;
                                                                            //$persentase_total_selesai_formatted = number_format($persentase_total_selesai,2,",","");

                                                                            $persentase_total_selesai_formatted = number_format($persentase_total_selesai,2,",","");

                                                                            if($persentase_total_selesai_formatted=='nan'){
                                                                                $persentase_total_selesai_formatted = 0;
                                                                            }
                                                                            echo $total_dokumen_per_zona_selesai ." JAMAAH"." (".$persentase_total_selesai_formatted." %)";
                                                                            /*cuky*/
                                                                            ?>

                                                                        </div>
                                                                        <div class="progress">
                                                                            <div class="progress-bar progress-bar-success progress-bar-striped " role="progressbar"
                                                                                 aria-valuenow="<?php echo $persentase_total_selesai;  ?>"
                                                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase_total_selesai; ?>%">
                                                                                <span class="sr-only"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="dashboard-progress">
                                                                        <div class="progress-title">JAMAAH BELUM LUNAS</div>
                                                                        <div class="text-white progress-angka">
                                                                            <?php

                                                                            $get_agen_by_role = $this->db->get_where("tbl_agen",array("role_agen_id"=>$val->id_role_agen))->result();


                                                                            $jml_jamaah_per_level = 0;
                                                                            $jml_jamaah_per_level_lunas = 0;
                                                                            $jml_jamaah_per_level_belum_lunas = 0;
                                                                            foreach ($get_agen_by_role as $agency){
                                                                                $get_jamaah = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen
                                                                                ));

                                                                                $get_jamaah_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen,
                                                                                    "status_pembayaran"=>"bayar_lunas_umroh"
                                                                                ));
                                                                                $get_jamaah_belum_lunas = $this->db->get_where("tbl_jamaah",array(
                                                                                    "agen_pemilik_id"=>$agency->id_agen,
                                                                                    "status_pembayaran"=>"bayar_dp_umroh"
                                                                                ));
                                                                                $jml_jamaah_per_level = $jml_jamaah_per_level + $get_jamaah->num_rows();
                                                                                $jml_jamaah_per_level_lunas = $jml_jamaah_per_level_lunas + $get_jamaah_lunas->num_rows();
                                                                                $jml_jamaah_per_level_belum_lunas = $jml_jamaah_per_level_belum_lunas + $get_jamaah_belum_lunas->num_rows();

                                                                            }
                                                                            //echo $jml_jamaah_per_level."<br>";
                                                                            //echo $jml_jamaah_per_level_lunas."<br>";
                                                                            //echo $jml_jamaah_per_level_belum_lunas."<br>";

                                                                            $total_dokumen_per_zona =  $jml_jamaah_per_level;

                                                                            $total_dokumen_per_zona_selesai =  $jml_jamaah_per_level_lunas;

                                                                            $total_dokumen_per_zona_belum_selesai =  $jml_jamaah_per_level_belum_lunas;



                                                                            $persentase_total_belum_selesai = ($total_dokumen_per_zona_belum_selesai * 100) / ($total_dokumen_per_zona_selesai + $total_dokumen_per_zona_belum_selesai) ;
                                                                            //$persentase_total_belum_selesai_formatted = number_format($persentase_total_belum_selesai,2,",","");

                                                                            $persentase_total_belum_selesai_formatted = number_format($persentase_total_belum_selesai,2,",","");

                                                                            if($persentase_total_belum_selesai_formatted=='nan'){
                                                                                $persentase_total_belum_selesai_formatted = 0;
                                                                            }

                                                                            echo $total_dokumen_per_zona_belum_selesai ." JAMAAH"." (".$persentase_total_belum_selesai_formatted." %)";
                                                                            ?>
                                                                        </div>
                                                                        <div class="progress">


                                                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                                                                                 aria-valuenow="<?php echo $persentase_total_belum_selesai;  ?>"
                                                                                 aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentase_total_belum_selesai; ?>%">
                                                                                <span class="sr-only"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $isFirst = false;
                                //die;
                            }
                            //die;
                        ?>

                    </div>
                </div>





            </div>

        </div>

	</div>






</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script>
    var role_agen_id = <?php echo json_encode($array_level_id);  ?>;
    console.log("role agen id umroh :" + role_agen_id);

    const realisasi_jamaah_total = <?php echo json_encode($realisasi_jamaah_total); ?>;
    //console.log(realisasi_jamaah_total);
    //console.log("realisasi_jamaah_total"+realisasi_jamaah_total);

    const total_jamaah_semua_agen = <?php echo json_encode($total_jamaah_semua_agen); ?>;
    //console.log("totalcuk : " + total_jamaah_semua_agen);


    const selesai_only = <?php echo json_encode($realisasi_jamaah_total_lunas); ?>;
    //console.log(selesai_only);

    const belum_selesai_only = <?php echo json_encode($realisasi_jamaah_total_belum_lunas); ?>;
    //console.log(belum_selesai_only);

    role_agen_id.forEach(myFunction);

    function myFunction(value, key) {
       // console.log("valueku:"+value);
        var kode_level = key;

        var options = {
            tooltips: {
                enabled: true
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        // console.log(ctx);
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        //console.log(ctx.chart.data);
                        dataArr.map(data => {
                            sum += data;
                        });

                        //sum = realisasi_satker_total[kode_satker] + sisa_satker_aktual[kode_satker];
                    }
                },
                legend: {
                    labels: {
                        font: {
                            size: 24,
                        },
                    }
                },
            },

        };

        var ctx = document.getElementById('chart_penyerapan' + value).getContext('2d');

        var chart_penyerapan = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Jamaah Lunas ', 'Harmonisasi Belum Lunas'],
                datasets: [{
                    /*cuky*/
                    data: [selesai_only[key], belum_selesai_only[key]],
                    backgroundColor: [
                        'rgba(0, 172, 172, 1)',
                        'rgba(234, 66, 114, 1)'
                    ],
                    borderColor: [
                        'rgba(45, 53, 60, 1)',
                        'rgba(45, 53, 60, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                tooltips: {
                    enabled: true
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            console.log(ctx.chart.data);
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            //console.log(ctx.chart.data);
                            dataArr.map(data => {
                                sum += data;
                            });

                            //sum = realisasi_satker_total[kode_satker] + sisa_satker_aktual[kode_satker];
                        }
                    },
                    legend: {
                        labels: {
                            font: {
                                size: 24,
                            },
                        },

                    },
                    labels: {
                        render: 'label',
                        precision: 1,
                        arc: false,
                        position: 'border',
                        fontColor: [
                            'rgba(255,26,104,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                        ],
                    },
                },

            }
        });
    }



</script>
<script>
    var zona_level_agen = <?php echo json_encode($zona_level_agen);  ?>;
    var nama_zona_level = [];
    var persen_realisasi = [];

    zona_level_agen.forEach(fungsi);

    function fungsi(val, key) {
        console.log("keynyas"+key);
        console.log("nama roleku : "+val['nama_role_agen_lengkap']);
        nama_zona_level[key] = val['nama_role_agen_lengkap'];
        let realisasi = realisasi_jamaah_total[key];

        persen_realisasi[key] = (Math.round(((realisasi / total_jamaah_semua_agen) * 100) * 100) / 100).toFixed(2)
    }

    const labels = nama_zona_level;
    const ctx = document.getElementById('bar_chart_by_level');
    const myChart = new Chart(ctx,{
        type:"bar",
        data:{
            labels : nama_zona_level,
            datasets: [{
                label: 'Presentase Perolehan Jamaah Per Level Agen (%)',
                data: persen_realisasi,//[100,2,4,5,6,7,8,9,10,11,12,13,14,5.5,16,17,18,19,20,21,22,23,24,25], //[100.0,75.6,87.8,100.0,91.6,84.9,74.4,86.2,71.7,86.8,83.0,78.5,75.9,85.5,91.6,89.5,94.9,84.0,64.7,90.3,67.9,90.2,80.8,88.4,92.3]
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }],

        },
        options: {
            legend: {
                labels: {
                    fontColor: 'white'
                }
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        fontColor: 'white'
                    }
                }],
                xAxes: [{
                    ticks: {
                        autoSkip: false,
                        maxRotation: 90,
                        minRotation: 15,
                        padding: 20,
                        fontColor: 'white'
                    }
                }]
            },
            plugins: {
                /*dokumentasi chart js utk positioning anchor*/
                /*https://chartjs-plugin-datalabels.netlify.app/guide/positioning.html#anchoring*/
                datalabels: {
                    anchor: 'end',
                    align: 'top',
                    textalign :'start',
                    formatter: (value, ctx) => {
                        console.log("what value: "+value);
                        return value + " %";
                    },
                    color: 'white',
                }
            },
        }
    });
</script>
<!-- end #content -->
