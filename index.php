<?php require_once "template/header.php"?>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
       <div class="col-12 col-md-8">
            <div class="card">
            <div class="card-body">
                <div class="">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>profile</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody class="py-3">
                            <?php foreach (alluser() as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><img class="table-img" src="<?php echo $url ?>assets/img/store/<?php echo $value['profile'] ?>" alt=""></td>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo $value['email'] ?></td>
                                    <td><?php echo $value['phone'] ?></td>
                                    <td class="text-capitalize"><?php echo $value['gender'] ?></td>
                                    <td>
                                        <a href="userDelete.php?id=<?php echo $value['id']?>" class="btn btn-outline-danger"><i class="fas fa-trash"></i></a>
                                        <a href="logout.php" class="btn btn-outline-warning"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>

                                    </td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
    </div>
</div>


<?php require_once "template/footer.php"?>