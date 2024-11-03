<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">All Student Feedback</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Student Name</th>
                                <th>Rating</th>
                                <th>Comments</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_feedback->num_rows > 0) {
                                while ($feedback = $result_feedback->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($feedback['course_name']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['student_name']); ?></td>
                                        <td>
                                            <?php
                                            // Display filled stars with color
                                            for ($i = 1; $i <= $feedback['rating']; $i++) {
                                                echo '<i class="fas fa-star" style="color: #FFD700;"></i>';
                                            }
                                            // Display empty stars with a lighter color
                                            for ($i = $feedback['rating'] + 1; $i <= 5; $i++) {
                                                echo '<i class="far fa-star" style="color: #ccc;"></i>';
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo htmlspecialchars($feedback['comments']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="5">No feedback submitted yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
