<?php
include "header.php";
include "includes/adminnav.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Publish</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
if (isset($_POST['publish'])) {
require "../gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 

$gump->validation_rules(array(
    'title'    => 'required|max_len,120|min_len,15',
    'tags'   => 'required|max_len,100|min_len,3',
    'content' => 'required|max_len,20000|min_len,150',
));
$gump->filter_rules(array(
    'title' => 'trim|sanitize_string',
    'tags' => 'trim|sanitize_string',
    ));
$validated_data = $gump->run($_POST);

if($validated_data === false) {
    ?>
    <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
    <?php 
    $post_title = $_POST['title'];
      $post_tag = $_POST['tags'];
      $post_content = $_POST['content'];
}
else {
    $post_title = $validated_data['title'];
      $post_tag = $validated_data['tags'];
      $post_content = $validated_data['content'];
if (isset($_SESSION['firstname'])) {
        $post_author = $_SESSION['firstname'];
    }
    $post_date = date('Y-m-d');
    $post_status = 'draft';
    

    $image = $_FILES['image']['name'];
    $ext = $_FILES['image']['type'];
    $validExt = array ("image/gif",  "image/jpeg",  "image/pjpeg", "image/png");
    if (empty($image)) {
echo "<script>alert('Attach an image');</script>";
    }
    else if ($_FILES['image']['size'] <= 0 || $_FILES['image']['size'] > 1024000 )
    {
echo "<script>alert('Image size is not proper');</script>";
    }
    else if (!in_array($ext, $validExt)){
        echo "<script>alert('Not a valid image');</script>";

    }
    else {
        $folder  = '../allpostpics/';
        $imgext = strtolower(pathinfo($image, PATHINFO_EXTENSION) );
        $picture = rand(1000 , 1000000) .'.'.$imgext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $folder.$picture)) {
            $query = "INSERT INTO posts (title,author,postdate,image,content,status,tag) VALUES ('$post_title' , '$post_author' , '$post_date' , '$picture' , '$post_content' , '$post_status', '$post_tag') ";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script> alert('News posted successfully.It will be published after admin approves it');
                window.location.href='posts.php';</script>";
            }
            else {
                "<script> alert('Error while posting..try again');</script>";
            }
        }
    }
}
}
?>
    <!-- Main content -->
    <form class="content" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title" id="logins-part-trigger">Publish Post</h3>
              </div>
              <div class="card-body p-0">
                <div class="bs-stepper">
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <p type="text" class="step-trigger" role="tab"  >
                        <b><span class="bs-stepper-label">Post Information</span></b>
                      </p>
                    </div>
                  </div>
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Post Title</label>
                        <input type="text" name ="title"class="form-control" id="exampleInputEmail1" placeholder="Post title" value= "<?php if(isset($_POST['publish'])) { echo $post_title; } ?>">
                      </div>
                      <div class="form-group">
                          <label for="post_image">Post Image </label> <font color='brown' > &nbsp;&nbsp;(Allowed image size: 1024 KB) </font> 
                          <input type="file" name="image" >
                      </div>
                      <div class="form-group">
                        <label for="post_tag">Post Tags</label>
                        <input type="text" name="tags" placeholder = "ENTER SOME TAGS SEPERATED BY COMMA (,)" value= "<?php if(isset($_POST['publish'])) { echo $post_tag; } ?>" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea class="form-control" name="content"  id="" cols="30" rows="15" ><?php if(isset($_POST['publish'])) { echo $post_content; } ?></textarea>
                      </div>
                      <button type="submit" name="publish" class="btn btn-primary" value="Publish Post">Publish Post</button>
                    </div>
                    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                      
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
</form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php
include('footer.php')
?>
