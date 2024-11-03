<div class="row">
    <div class="col-xxl-12">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Your Submitted Feedback</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Course Name</th>
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
                                        <td><?php echo htmlspecialchars($feedback['rating']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['comments']); ?></td>
                                        <td><?php echo htmlspecialchars($feedback['created_at']); ?></td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan="4">No feedback submitted yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    Submit New Feedback
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 Modal for Feedback Submission -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="feedbackForm" method="POST" action="Controller/submit_feedback_action.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Submit Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courseSelect" class="form-label">Select Course</label>
                        <select class="form-select" id="courseSelect" name="course_id" required>
                            <option value="">Choose a course</option>
                            <?php
                            while ($course = $result_courses->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($course['id']) . "'>" . htmlspecialchars($course['name']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (out of 5)</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$stmt->close();
$stmt_feedback->close();
$conn->close();
?>