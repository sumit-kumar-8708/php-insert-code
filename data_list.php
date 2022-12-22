<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/new/css/style.css" /> -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
<link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css'>
<div class='row mt-4'>
    <div class='col-md-2'></div>
    <div class="col-md-9">
        <div class=" ">
            <div class="h_text_breadcrumb">
                <section class="course_header">
                    <h4><b>User List :</b></h4>
                </section>
                <!-- <section class="navigation_bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="https://abl.leco.live/abl/dashboard"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User List</li>
                    </ol>
                </nav>
            </section> -->
            </div>

            <div class="row dashboard_card mr-1">
                <div class="col-md-12 card " style="
                padding: 10px;">
                    <div class="add_btn_div">
                        <a href="<?= base_url() ?>data/multi_add_user" class="btn btn-primary save_btn mb-3">Add user <i
                                class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                    <section>
                        <?php
                    if (!empty($this->session->flashdata('message'))) {
                        echo "<div class='alert alert-success'>" . $this->session->flashdata('message') . "</div>";
                    } ?>
                        <?php if (!empty($this->session->flashdata('msg'))) {
                        echo "<div class='alert alert-danger'>" . $this->session->flashdata('msg') . "</div>";
                    }
                    ?>

                        <!-- All delete -->
                        
                        <form action="<?php echo base_url() . 'data/multi_data_delete'?>" method="POST">
                            <table class="table table-striped table-hover datatable" id="table">
                                <thead class="cf">
                                    <tr class="draggable">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-danger">All Delete</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class='col-md-2'></div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js">
< script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
integrity = "sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
crossorigin = "anonymous"
referrerpolicy = "no-referrer" >
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js"
    integrity="sha512-CX7sDOp7UTAq+i1FYIlf9Uo27x4os+kGeoT7rgwvY+4dmjqV0IuE/Bl5hVsjnQPQiTOhAX1O2r2j5bjsFBvv/A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> -->

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>

<script type="text/javascript">
<?php
    $url = base_url("data/ajax_data_list");
    ?>
$(document).ready(function() {

    oTable = $('#table').dataTable({

        "bFilter": true,
        "bInfo": true,
        "bSort": true,
        "bAutoWidth": false,
        "bProcessing": true,
        "bServerSide": true,
        "stateSave": true,
        "aaSorting": [
            [0, 'desc']
        ],
        "sAjaxSource": '<?= $url; ?>',
        "sServerMethod": "POST",
        'columnDefs': [{
            "targets": [0, ],
            "orderable": false
        }]

    });
});
</script>