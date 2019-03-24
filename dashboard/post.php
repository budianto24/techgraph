<?php 
	session_start();
	if(!isset($_SESSION['name'])){
		header("location:../login?status=forbidden");
	}
	
	include ('../database/koneksi.php');

	if($_SESSION['status']=="user"){
		$query="SELECT * FROM tb_artikel WHERE author='{$_SESSION['name']}'";
	}else if($_SESSION['status']="admin"){
		$query="SELECT * FROM tb_artikel ORDER BY id_artikel ASC";
	}
		$query_sql=mysqli_query($koneksi, $query);
		$show=mysqli_fetch_array($query_sql);
		$jumlah=mysqli_num_rows($query_sql);
	$no=0;
	
	$today=date('d M Y');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>
	
    <!--Font CSS-->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/admin-style.css" rel="stylesheet">
    <link href="../css/simple-sidebar.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
      <?php include ("cek-session.php");?> 
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                         <h2><span class="fa fa-pencil"></span>&nbsp;Post</h2><hr>
							<a class="btn btn-default btn-md" href="create-post" role="button"><span class="fa fa-plus"></span>&nbsp; Create Post</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
										<th width="450">TITLE</th>
										<th>AUTHOR</th>
										<th>CATEGORY</th>
										<th>DATE</th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php do{ $no++?>
                                    <tr>
										<td align="center"><?php echo $no;?></td>
										<td><?php echo $show['judul'];?></td>
										<td><?php echo $show['author'];?></td>
										<td><?php echo $show['kategori'];?></td>
										<td><?php echo $show['tgl'];?></td>
										<td><center>
										<a class="btn btn-default btn-md" href="update-post?id=<?php echo $show['id_artikel'];?>" title="Edit" role="button"><span class="fa fa-pencil-square-o"></span></a>							
										<a class="btn btn-default btn-md" href="delete?id=<?php echo $show['id_artikel'];?>" title="Delete" role="button"><span class="fa fa-trash"></span></a>							
										</center></td>
                                    </tr>
									<?php } while($show=mysqli_fetch_array($query_sql));?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>
</html>