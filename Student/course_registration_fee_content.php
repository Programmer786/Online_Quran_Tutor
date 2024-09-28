<!-- Course Cards -->
<div class="container mt-5">
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-xxl-4 col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="../assets/uploads/<?php echo htmlspecialchars($row['tutor_image']); ?>" width="150" height="400" class="card-img-top" alt="Tutor Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['course_name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <h6 class="card-price">$<?php echo htmlspecialchars($row['price']); ?></h6>
                            <p class="card-text"><small class="text-muted">Tutor: <?php echo htmlspecialchars($row['tutor_name']); ?></small></p>
                            <p class="card-text"><small class="text-muted">Gender: <?php echo htmlspecialchars($row['tutor_gender']); ?></small></p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal" data-course-id="<?php echo htmlspecialchars($row['course_id']); ?>" data-course-price="<?php echo htmlspecialchars($row['price']); ?>">Register Now</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No courses found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="Controller/register_course.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="courseId" name="course_id">
                    <div class="mb-3">
                        <label for="coursePrice" class="form-label">Course Price</label>
                        <input type="text" class="form-control" id="coursePrice" name="course_price" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="transactionNo" class="form-label">Transaction Number</label>
                        <input type="text" class="form-control" id="transactionNo" name="transaction_no" required>
                    </div>
                    <div class="mb-3">
                        <label for="receiptFile" class="form-label">Upload Receipt</label>
                        <input type="file" class="form-control" id="receiptFile" name="receipt_file" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    var paymentModal = document.getElementById('paymentModal');
    paymentModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        // Extract info from data-* attributes
        var courseId = button.getAttribute('data-course-id');
        var coursePrice = button.getAttribute('data-course-price');
        // Update the modal's hidden input with the course ID
        var modalBodyIdInput = paymentModal.querySelector('.modal-body input#courseId');
        var modalBodyPriceInput = paymentModal.querySelector('.modal-body input#coursePrice');
        modalBodyIdInput.value = courseId;
        modalBodyPriceInput.value = coursePrice;
    });
});
</script>
