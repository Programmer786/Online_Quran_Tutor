<!-- App header starts -->
<div class="app-header d-flex align-items-center">

    <!-- Toggle buttons start -->
    <div class="d-flex">
        <button class="btn btn-outline-primary me-2 toggle-sidebar" id="toggle-sidebar">
            <i class="bi bi-text-indent-left fs-5"></i>
        </button>
        <button class="btn btn-outline-primary me-2 pin-sidebar" id="pin-sidebar">
            <i class="bi bi-text-indent-left fs-5"></i>
        </button>
    </div>
    <!-- Toggle buttons end -->


    <!-- App brand sm start -->
    <div class="app-brand-sm d-md-none d-sm-block">
        <a href="index.html">
            <!-- <img src="../assets/images/logo-sm.svg" class="logo" alt="Bootstrap Gallery"> -->
        </a>
    </div>
    <!-- App brand sm end -->

    <!-- App header actions start -->
    <div class="header-actions">
        
        <!-- <div class="dropdown ms-2">
            <a class="dropdown-toggle d-flex p-2 border rounded-2" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-bell fs-4 lh-1"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow">
                <div class="dropdown-item">
                    <div class="d-flex py-2 border-bottom">
                        <img src="../assets/images/user.png" class="img-4x me-3 rounded-3" alt="Admin Theme" />
                        <div class="m-0">
                            <h6 class="mb-1">Sophie Michiels</h6>
                            <p class="mb-2">Membership has been ended.</p>
                            <p class="small m-0 text-secondary">Today, 07:30pm</p>
                        </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2 border-bottom">
                        <img src="../assets/images/user2.png" class="img-4x me-3 rounded-3" alt="Admin Theme" />
                        <div class="m-0">
                            <h6 class="mb-1">Sophie Michiels</h6>
                            <p class="mb-2">Congratulate, James for new job.</p>
                            <p class="small m-0 text-secondary">Today, 08:00pm</p>
                        </div>
                    </div>
                </div>
                <div class="dropdown-item">
                    <div class="d-flex py-2">
                        <img src="../assets/images/user1.png" class="img-4x me-3 rounded-3" alt="Admin Theme" />
                        <div class="m-0">
                            <h6 class="mb-1">Sophie Michiels</h6>
                            <p class="mb-2">Lewis added new schedule release.</p>
                            <p class="small m-0 text-secondary">Today, 09:30pm</p>
                        </div>
                    </div>
                </div>
                <div class="d-grid m-3">
                    <a href="events.html" class="btn btn-primary">View all</a>
                </div>
            </div>
        </div> -->
        <div class="dropdown ms-3">
            <a id="userSettings" class="dropdown-toggle d-flex py-2 align-items-center ps-3 border-start" href="#!"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="d-none d-md-block me-2"><?php echo htmlspecialchars($user['username']); ?></span>
                <img src="../assets/uploads/<?php echo htmlspecialchars($user['profile_photo']); ?>" class="rounded-circle img-3x" alt="Bootstrap Gallery" />
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow">
                <a class="dropdown-item d-flex align-items-center" href="profile.php"><i
                        class="bi bi-person fs-4 me-2"></i>Profile</a>
                <a class="dropdown-item d-flex align-items-center" href="../logout.php"><i
                        class="bi bi-escape fs-4 me-2"></i>Logout</a>
            </div>
        </div>
    </div>
    <!-- App header actions end -->

</div>
<!-- App header ends -->