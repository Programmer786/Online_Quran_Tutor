<!-- Assignments Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Assignment Submissions</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Assignment Title</th>
                        <th>Student</th>
                        <th>File</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_submissions->num_rows > 0) {
                        while ($row = $result_submissions->fetch_assoc()) {
                            $file_path = '../assets/uploads/' . $row['file_path'];
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['assignment_title']); ?></td>
                                <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                                <td>
                                    <?php if ($row['file_path'] && file_exists($file_path)) { ?>
                                        <a href="<?php echo htmlspecialchars($file_path); ?>" class="btn btn-sm btn-secondary" download>
                                            Download
                                        </a>
                                    <?php } else {
                                        echo 'File not available';
                                    } ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['submitted_at']); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No assignments submitted.</td>
                        </tr>
                    <?php
                    }
                    $stmt_submissions->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$conn->close();
?>