<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">User Details</h1>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="../assets/uploads/<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Photo" class="img-thumbnail mb-3" width="150">
                    </div>
                    <div class="col-md-8">
                        <h2 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h2>
                        <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                        <p class="card-text"><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                        <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
                        <p class="card-text"><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
                        <p class="card-text"><strong>CV:</strong> <a href="../assets/uploads/<?php echo htmlspecialchars($user['upload_cv']); ?>" class="btn btn-outline-primary btn-sm" download>Download CV</a></p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="text-center mb-4">Experiences</h2>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <?php if ($experience_result->num_rows > 0): ?>
                    <div class="accordion" id="experienceAccordion">
                        <?php while ($experience = $experience_result->fetch_assoc()): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo $experience['id']; ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $experience['id']; ?>" aria-expanded="true" aria-controls="collapse<?php echo $experience['id']; ?>">
                                        <?php echo htmlspecialchars($experience['job_title']); ?> at <?php echo htmlspecialchars($experience['company_name']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $experience['id']; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $experience['id']; ?>" data-bs-parent="#experienceAccordion">
                                    <div class="accordion-body">
                                        <p><strong>Start Date:</strong> <?php echo htmlspecialchars($experience['start_date']); ?></p>
                                        <p><strong>End Date:</strong> <?php echo htmlspecialchars($experience['end_date']); ?></p>
                                        <p><strong>Description:</strong> <?php echo htmlspecialchars($experience['description']); ?></p>
                                        <?php if ($experience['file_upload']): ?>
                                            <p><strong>File:</strong> <a href="../assets/uploads/<?php echo htmlspecialchars($experience['file_upload']); ?>" class="btn btn-outline-primary btn-sm" download>Download</a></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center">No experiences found.</p>
                <?php endif; ?>
            </div>
        </div>

        <h2 class="text-center mb-4">Documents</h2>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <?php if ($document_result->num_rows > 0): ?>
                    <div class="list-group">
                        <?php while ($document = $document_result->fetch_assoc()): ?>
                            <div class="list-group-item list-group-item-action">
                                <p class="mb-1"><strong>Document Name:</strong> <?php echo htmlspecialchars($document['doc_title'] ?? 'N/A'); ?></p>
                                <p class="mb-1"><strong>File:</strong> <a href="../assets/uploads/<?php echo htmlspecialchars($document['doc_file_name'] ?? ''); ?>" class="btn btn-outline-primary btn-sm" download>Download</a></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-center">No documents found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
