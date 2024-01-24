<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $titulo; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php 
              if(isset($breadcumb) && is_array($breadcumb)){
                  foreach($breadcumb as $text => $content){
              ?>
                <li class="breadcrumb-item <?php echo $content['active'] ? 'active' : ''; ?>"><a href="<?php echo $content['url']; ?>"><?php echo $text; ?></a></li>              
              <?php 
                  }
              }
              ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
                <?php var_dump($data); ?>
            </div>
        </div>
      </div>
    </section>
  </div>