
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
           
            <div class="row">
       <div class="col-md-5">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h5 class="card-title">Entri Kategori</h5>

                <div class="card-tools">
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" id="entri">
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>   <!-- /.row -->
          <div class="col-md-7">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h5 class="card-title">Data Kategori</h5>

                <div class="card-tools">
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" id="get">
             
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>   <!-- /.row -->
    


          </div>
        </section>
        
      </div>

      <script>
$("#get").load("admin/loadkategori");
$("#entri").load("admin/entrikategori");
</script>