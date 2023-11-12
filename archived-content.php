<style>
    /* Desactivar mayúsculas automáticas */
    .no-uppercase {
      text-transform: none !important;
    }
    
</style>

<div class="main-content">

    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card" style="min-height: 485px;">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Deleted sneakers</h4>
                </div>
                <div class="card-content table-responsive">
                    <table id="aSneakerTable" class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Deleted at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- getInventoryA.php -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card" style="min-height: 485px;">
                <div class="card-header card-header-text">
                    <h4 class="card-title">Deleted Users</h4>
                </div>
                <div class="card-content table-responsive">
                    <table id="aUsersTable" class="table table-hover">
                        <thead class="text-primary">
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Deleted at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="no-uppercase">
                            <!-- getUsersA.php -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="scripts/ajaxArchived.js"></script>



			 
			 