<style>
    /* Desactivar mayúsculas automáticas */
    .no-uppercase {
      text-transform: none !important;
    }
    
</style>

<div class="main-content">
    <div class="col-md-12">
        <div class="card" style="min-height: 485px;">
            <div class="card-header card-header-text">

                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add User
                </button>

                <h4 class="card-title">Users</h4>

            </div>
            <div class="card-content table-responsive">
                <table id="UsersTable" class="table table-hover">
                    <thead class="text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="no-uppercase">
                        <!-- getUsers.php -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="scripts/ajaxUsers.js"></script>

<?php include_once("modalNewUser.php"); ?>
<?php include_once("modalEditUser.php"); ?>


			 
			 