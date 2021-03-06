<?php
$this->load->view('includes/adminSideBar');
?>

<head>
    <link href="<?php echo base_url('assets/css/announcement.css'); ?>" rel="stylesheet" type="text/css">
    <title>Admin | Subjects</title>
    <style>
        .table-body tr {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .table-body td {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 0;
        }
        ul {
            margin: 0px;
            padding: 0px;
        }
        #saveSubject,
        #saveEdit {
            background-color: #800000;
            border-color: transparent;
            color: white;
            text-decoration: none;
            font-size: 0.8rem;
            margin: 0px 8px;
        }
        #cancelSubject,
        #cancelEdit {
            background-color: #aaaaaa;
            border-color: transparent;
            color: black;
            text-decoration: none;
            font-size: 0.8rem;
            margin: 0px;
        }
        #saveSubject:hover,
        #saveEdit:hover,
        #cancelSubject:hover,
        #cancelEdit:hover {
            background-color: white;
            border-color: #800000;
            color: #800000;
            font-size: 0.8rem;
        }
        .btn:focus {
            box-shadow: none;
        }
    </style>
</head>
<div class="height-100 pt-2 container-fluid">   
    <?php if ($this->session->flashdata('errorSubject')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $this->session->flashdata('errorSubject'); ?>
                <button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
            </div>
            <?php $this->session->unset_userdata ('errorSubject'); ?>

        <?php elseif ($this->session->flashdata('successSubject')) : ?> 
            <div class="alert alert-success alert-dismissible fade show">
                <?= $this->session->flashdata('successSubject'); ?>
                <button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
            </div>
            <?php $this->session->unset_userdata ('successSubject'); ?>
        <?php endif?>
    <div class="my-3">
        <div class="CourseTab my-3">
            <h4 class="fw-bold">Subject</h4>
        </div>
        <!--Add Subject-->
        <div class="col-12 align-self-center pt-2 my-3">
            <div class="accordion accordion-flush">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addSubject" aria-expanded="false" aria-controls="addSubject">
                            Add Subject
                        </button>
                    </h2>
                    <div id="addSubject" class="accordion-collapse collapse" aria-labelledby="addSubjectHeader" data-bs-parent="#accordion-addCourse">
                        <div class="accordion-body">
                            <form method="POST" action="<?php echo site_url('subjectController/addsubject') ?>">
                                <div class="row mb-2">
                                    <div class="col-lg-2 col-md-2 col-sm-12 pt-2">
                                        <label class="form-label">Select Course: </label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-12 ">
                                        <select name="courseID" class="form-select " aria-labelledby="Course" required>
                                            <option value="" disabled selected hidden>Please Select</option>
                                            <?php foreach ($course as $courserow) { ?>
                                                <option value="<?php echo $courserow->courseID ?>"><?php echo $courserow->degree ?> in <?php echo $courserow->major ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-4 align-self-center my-3">
                                        <label class="form-label">Year Level: </label>
                                        <select name="yearlevel" class="form-select" aria-labelledby="Year Level" required>
                                            <option value="" disabled selected hidden>Please Select</option>
                                            <option value="1">1st Year</option>
                                            <option value="2">2nd Year</option>
                                            <option value="3">3rd Year</option>
                                            <option value="4">4th Year</option>
                                            <option value="5">5th Year</option>
                                        </select>
                                    </div>
                                    <div class="col-4 align-self-center my-3">
                                        <label class="form-label">Semester: </label>
                                        <select name="semester" class="form-select" aria-labelledby="Semester" required>
                                            <option value="" disabled selected hidden>Please Select</option>
                                            <option value="1">1st Semester</option>
                                            <option value="2">2nd Semester</option>
                                        </select>
                                    </div>
                                    <div class="col-4 align-self-center my-3">
                                        <label class="form-label">College: </label>
                                        <select name="college" class="form-select" aria-labelledby="College" required>
                                            <option value="" disabled selected hidden>Please Select</option>
                                            <option value="College of Science">COS</option>
                                            <option value="College of Engineering">COE</option>
                                            <option value="College of Industrial Education">CIE</option>
                                            <option value="College of Architecture and Fine Arts">CAFA</option>
                                            <option value="College of Liberal Arts">CLA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label class="form-label">Enter Subject Code: </label>
                                        <input type="text" name="subjectCode" class="form-control" aria-labelledby="Subject Code" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Enter Subject Name: </label>
                                        <input type="text" name="name" class="form-control" aria-labelledby="Subject Name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                    <div class="col-2">
                                        <label class="form-label">Number of Units: </label>
                                        <input type="number" name="units" class="form-control" aria-labelledby="Units" required>
                                    </div>
                                </div>
                                <div class="addSubjectButton d-flex justify-content-end">
                                    <button class="btn btn-default" id="saveSubject" type="submit" value="save">Save</button>
                                    <button class="btn btn-default" id="cancelSubject" type="reset" value="cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Subject List-->
        <div class="col-12 align-self-center" id="CourseTable">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col">
                            <h2>List of Subjects</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-2">
                    <table class="table table-default align-middle table-striped table-borderless table-hover table-body" aria-label="subjectList" id="subjectTable">
                        <thead>
                            <tr>
                                <th scope="col" class="pb-3">Subject Code</th>
                                <th scope="col" class="pb-3">Subject Name</th>
                                <th scope="col" class="pb-3">Units</th>
                                <th scope="col" class="pb-3">Semester</th>
                                <th scope="col" class="pb-3">College</th>
                                <th scope="col" class="pb-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tbodySubject">
                            <?php foreach ($subject as $subjectrow) { ?>
                                <tr>
                                    <td><?php echo $subjectrow->subjectCode ?></td>
                                    <td><?php echo $subjectrow->name ?></td>
                                    <td><?php echo $subjectrow->units ?></td>
                                    <td><?php echo $subjectrow->semester ?></td>
                                    <td><?php echo $subjectrow->college ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <?php if ($subjectrow->status == 1) : ?>
                                                <ul>
                                                    <li>
                                                        <button type="button" data-id='<?php echo $subjectrow->subjectID ?>' class="btn edit_data" data-bs-toggle="modal" data-bs-target="#editSubject">
                                                            <em class="fas fa-pen" data-bs-toggle="tooltip" title="Edit"></em> Edit</button>
                                                    </li>
                                                    <li><button type="button" class="btn" onclick="location.href='<?php if ($subjectrow->status == 1) {
                                                                                                                        echo site_url('subjectController/deactivate');
                                                                                                                    } else {
                                                                                                                        echo site_url('subjectController/activate');
                                                                                                                    } ?>/<?php echo $subjectrow->subjectID; ?>'">
                                                            Deactivate
                                                        </button>
                                                    </li>
                                                </ul>
                                            <?php else : ?>
                                                <ul>
                                                    <li>
                                                        <button type="button" data-id='<?php echo $subjectrow->subjectID; ?>' class="btn" disabled style="background-color: gray;">
                                                            <em class="fas fa-pen" data-bs-toggle="tooltip" title="Edit"></em> Edit</button>
                                                    </li>
                                                    <li><button type="button" class="btn" id="uniqueSubjectEdit" onclick="location.href='<?php if ($subjectrow->status == 1) {
                                                                                                                                                echo site_url('subjectController/deactivate');
                                                                                                                                            } else {
                                                                                                                                                echo site_url('subjectController/activate');
                                                                                                                                            } ?>/<?php echo $subjectrow->subjectID; ?>'">
                                                            Activate
                                                        </button>
                                                    </li>
                                                </ul>
                                            <?php endif ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!--Edit Subject-->
        <div class="modal fade" id="editSubject" tabindex="-1" aria-modal="true" aria-labelledby="editSubjectHeader" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCourseHeader">Edit Subject</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="edit_subject">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pt-1">&nbsp;</div>
</div>

<!-- jQuery JS CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jQuery DataTables JS CDN -->
<script src="<?php echo base_url('assets/js/dataTables.min.js'); ?>"></script>
<!-- Ajax fetching data -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('.edit_data').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('subjectController/editSubject'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#edit_subject').html(data);
                }
            });
        });
        $('#subjectTable').DataTable({
            "lengthMenu": [
                [15, 25, 50, -1],
                [15, 25, 50, "All"]
            ]
        });
    jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
    });
  

</script>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>