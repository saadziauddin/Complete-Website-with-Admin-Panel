<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>




        <!-- Modal -->
<div class="modal fade" id="add_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="../Coding.php" method="POST" enctype="multipart/form-data">

    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <input type="text" class="form-control" name="category" id="exampleFormControlInput1" placeholder="Enter Category Name" required>
            </div>

            <div class="mb-3">
                <input type="file" class="form-control" name="c_img" id="exampleFormControlInput1" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_category" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>





        <!-- Product Modal -->
        <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="../Coding.php" method="POST" enctype="multipart/form-data">

    
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <input type="text" class="form-control" name="p_name" id="exampleFormControlInput1" placeholder="Enter Name" required>
            </div>

            <div class="mb-3">
                <input type="number" class="form-control" name="p_qty" id="exampleFormControlInput1" placeholder="Enter Quantity" required>
            </div>


            <div class="mb-3">
                <input type="number" class="form-control" name="p_price" id="exampleFormControlInput1" placeholder="Enter Price" required>
            </div>


            <div class="mb-3">
                <input type="text" class="form-control" name="p_desc" id="exampleFormControlInput1" placeholder="Enter Description" required>
            </div>


            <div class="mb-3">
                <select class="form-control" name="p_category">
                  <option value="">Select Category</option>
                  <?php 
                    include "../connection.php";

                    $fetchCategory = mysqli_query($con,"SELECT * FROM category");

                    while($data = mysqli_fetch_assoc($fetchCategory)){
                      ?>
                      <option value="<?php echo $data['c_name'];?>"><?php echo $data['c_name'];?></option>
                      <?php 
                    }
                  ?>
                </select>
            </div>

            <div class="mb-3">
                <input type="file" class="form-control" name="p_img" id="exampleFormControlInput1" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_product" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    </form>
  </div>
</div>