<?php
$this->load->view('includes/adminSideBar');
?>

<head>
    <link href="<?php echo base_url('assets/css/course.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/announcement.css'); ?>" rel="stylesheet" type="text/css">
    <title>Admin | Course</title>
</head>
<div class="height-100 pt-2 container-fluid">
    <?php if ($this->session->flashdata('errorCourse')) : ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $this->session->flashdata('errorCourse'); ?>
                <button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
            </div>
            <?php $this->session->unset_userdata ('errorCourse'); ?>
        <?php elseif ($this->session->flashdata('successCourse')) : ?>
            
            <div class="alert alert-success alert-dismissible fade show">
                <?= $this->session->flashdata('successCourse'); ?>
                <button type="button" class="btn-close close" data-bs-dismiss="alert"></button>
            </div>
            <?php $this->session->unset_userdata ('successCourse'); ?>
        <?php endif?>
    <div class=" my-3" id="mainCourse" style="display: block;">
        <div class="CourseTab my-3">
            <h3>Course</h3>
        </div>
        <!--Add Course-->
        <div class="col-12 align-self-center my-3" id="createCourse">
            <div class="accordion accordion-flush" id="accordion-addCourse">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="addCourseHeader">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addCourse" aria-expanded="false" aria-controls="addCourse">
                            Add Course
                        </button>
                    </h2>
                    <div id="addCourse" class="accordion-collapse collapse" aria-labelledby="addCourseHeader" data-bs-parent="#accordion-addCourse">
                        <div class="accordion-body">
                            <form method="POST" action="<?php echo site_url('courseController/addcourse') ?>" id="addCourseForm">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <label for="degree" class="form-label">Enter Degree: </label>
                                        <input type="text" id="degree" name="degree" required class="form-control">
                                    </div>
                                    <div class="col-6">
                                        <label for="major" class="form-label">Enter Major: </label>
                                        <input type="text" id="major" name="major" required class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 align-self-center">
                                        <label for="college" class="form-label">College: </label>
                                        <select name="college" id="college" class="form-select" required id="collegeSelect">
                                            <option value="" disabled selected hidden>Please Select</option>
                                            <option value="College of Science">College of Science</option>
                                            <option value="College of Engineering">College of Engineering</option>
                                            <option value="College of Industrial Education">College of Industrial Education</option>
                                            <option value="College of Architecture and Fine Arts">College of Architecture and Fine Arts</option>
                                            <option value="College of Liberal Arts">College of Liberal Arts</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="addCourseButton d-flex justify-content-end">
                                    <button class="btn btn-default" id="saveCourse" type="submit" value="save">Save</button>
                                    <button class="btn btn-default" id="cancelCourse" type="reset" value="cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Course List-->
        <div class="col-12 align-self-center" id="CourseTable">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col">
                            <h2>List of Courses</h2>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-2">
                    <table class="table table-default align-middle table-striped table-borderless table-hover table-body" aria-label="courseList" id="table-body">
                        <thead>
                            <tr>
                                <th scope="col" class="pb-3">Degree</th>
                                <th scope="col" class="pb-3">Major</th>
                                <th scope="col" class="pb-3">College</th>
                                <th scope="col" class="pb-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($course as $courserow) { ?>
                                <tr>
                                    <td><?php echo $courserow->degree ?></td>
                                    <td><?php echo $courserow->major ?></td>
                                    <td><?php echo $courserow->college ?></td>
                                    <td>
                                        <div class="action-buttons">
                                        <ul>
                                            <?php if ($courserow->courseStatus == 1) : ?>
                                                <li><button type="button" id="view" data-id='<?php echo $courserow->courseID; ?>' class="btn view_data viewsubject_data" data-bs-toggle="modal" data-bs-target="#viewCourse"><em class="fas fa-eye" data-bs-toggle="tooltip" title="View"></em> View</button></li>
                                                <li><button type="button" id="edit" data-id='<?php echo $courserow->courseID; ?>' class="btn edit_data" data-bs-toggle="modal" data-bs-target="#editCourse"><em class="fas fa-pen" data-bs-toggle="tooltip" title="Edit"></em> Edit</button></li>
                                                <li>
                                                <li><button type="button" class="btn" id="status" onclick="location.href='<?php if ($courserow->courseStatus == 1) {
                                                                                                                                echo site_url('courseController/deactivate');
                                                                                                                            } else {
                                                                                                                                echo site_url('courseController/activate');
                                                                                                                            } ?>/<?php echo $courserow->courseID; ?>'">
                                                        Deactivate
                                                    </button>
                                                </li>
                                            <?php else : ?>
                                                <li><button type="button" id="view" data-id='<?php echo $courserow->courseID; ?>' class="btn" disabled style="background-color: gray;"><em class="fas fa-eye" data-bs-toggle="tooltip" title="View"></em> View</button></li>
                                                <li><button type="button" id="edit" data-id='<?php echo $courserow->courseID; ?>' class="btn" disabled style="background-color: gray;"><em class="fas fa-pen" data-bs-toggle="tooltip" title="Edit"></em> Edit</button></li>
                                                <li>
                                                <li><button type="button" id="status" class="btn" onclick="location.href='<?php if ($courserow->courseStatus == 1) {
                                                                                                                                echo site_url('courseController/deactivate');
                                                                                                                            } else {
                                                                                                                                echo site_url('courseController/activate');
                                                                                                                            } ?>/<?php echo $courserow->courseID; ?>'">
                                                        Activate
                                                    </button>
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!--Course View-->
        <div class="modal fade" id="viewCourse" tabindex="-1" aria-modal="true" aria-labelledby="viewCourseHeader" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewCourseHeader">View Course</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="view_course">

                        </div>

                        <div id="view_coursesubjects">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Course-->
        <div class="modal fade" id="editCourse" tabindex="-1" aria-modal="true" aria-labelledby="editCourseHeader" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCourseHeader">Edit Course</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="edit_course">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-1"></div>
</div>
<script src="<?php echo base_url('assets/js/course.js'); ?>"></script>
<!-- jQuery JS CDN -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- jQuery DataTables JS CDN -->
<script src="<?php echo base_url('assets/js/dataTables.min.js'); ?>"></script>
<!-- Ajax fetching data -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('.view_data').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('courseController/viewCourse'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#view_course').html(data);
                }
            });
        });
        $('.edit_data').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('courseController/editCourse'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#edit_course').html(data);
                }
            });
        });
        $('.viewsubject_data').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('courseController/viewCoursesubjects'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    $('#view_coursesubjects').html(data);
                }
            });
        });
        $('#table-body').DataTable({
            "lengthMenu": [
                [20, 30, 50, -1],
                [20, 30, 50, "All"]
            ]
        });
        jQuery('.dataTable').wrap('<div class="dataTables_scroll" />');
    });
</script>
<script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
</body>

</html>