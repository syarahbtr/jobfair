<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Artikel</li>
        </ol>
        <h2>Artikel</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">
      <?php echo $this->session->flashdata('msg');?>
        <div class="row">

          <div class="col-lg-8 entries">
        <?php
    foreach($q->result() as $row){
        ?>
            <article class="entry">

              <div class="entry-img">
                <img src="image/<?php echo $row->gambar?>" style="width:800px;height:500px;" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="artikel/detailartikel/<?php echo $row->slug?>"><?php echo $row->judul?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="artikel/detailartikel/<?php echo $row->slug?>"><?php echo $row->nama_user?></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="artikel/detailartikel/<?php echo $row->slug?>"><time datetime="2020-01-01"><?php echo $row->date?></time></a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a href="artikel/detailartikel/<?php echo $row->slug?>"><?php echo $row->views?> Views</a></li>
                </ul>
              </div>

              <div class="entry-content">
                <!--<p>-->
                <!-- <?= substr($row->keterangan,0,20) ?>-->
                <!--</p>-->
                <div class="read-more">
                  <a href="artikel/detailartikel/<?php echo $row->slug?>">Cek Selengkapnya</a>
                </div>
              </div>

            </article><!-- End blog entry -->
        <?php } ?>
            
              <nav>
                    <?php error_reporting(0); echo $page;?>
                </nav>
            

          </div><!-- End blog entries list -->
            
          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              <div class="sidebar-item search-form">
                <form action="artikel/cariartikel" method="get">
                  <input type="text" name="keyword" autocomplete="off">
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Kategori</h3>
              <div class="sidebar-item categories">
                <ul>
                  <?php 
                  foreach($kategori->result() as $row) { 
                  ?>
                  <li><a><?php echo $row->kategori?> <span>(<?php echo $row->jml?>)</span></a></li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Artikel Popular</h3>
              <div class="sidebar-item recent-posts">
              <?php 
              foreach ($popular as $row){
              ?>
                <div class="post-item clearfix">
                  <img src="image/<?php echo $row->gambar?>" style="width:80px;height:60px;" alt="">
                  <h4><a href="artikel/detailartikel/<?php echo $row->slug?>"><?php echo $row->judul?></a></h4>
                  <time datetime="2020-01-01"><?php echo date("d F Y",strtotime($row->date)) ?></time>
                </div>
            <?php } ?>
              </div><!-- End sidebar recent posts-->

              <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <?php 
                  foreach($kategori->result() as $row) { 
                  ?>
                  <li><a><?php echo $row->kategori?></a></li>
                  <?php } ?>
                </ul>
              </div><!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->