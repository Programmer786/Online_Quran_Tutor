<!-- Row start -->
<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-hover m-0">
                        <thead>
                            <tr>
                                <th scope="col">Course Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                                    <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td>
                                            <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editCourseRegistrationModal" onclick="setEditModalData(<?php echo htmlspecialchars(json_encode($row)); ?>)"><i class="bi bi-pencil"></i></button> -->
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseRegistrationModal" onclick="setDeleteModalData(<?php echo $row['id']; ?>)"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="3">No Course Registration found.</td>
                                </tr>
                            <?php
                            }
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Row end -->


<!-- Delete Course Registration Modal -->
<div class="modal fade" id="deleteCourseRegistrationModal" tabindex="-1" aria-labelledby="deleteCourseRegistrationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseRegistrationModalLabel">Delete Course Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this Course Registration?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteCourseRegistrationForm" action="Controller/delete_course_registration.php" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteCourseRegistrationId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setDeleteModalData(id) {
        document.getElementById('deleteCourseRegistrationId').value = id;
    }
</script>

<?php
$conn->close();
?>
