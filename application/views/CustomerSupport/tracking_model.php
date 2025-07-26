 <div class="offcanvas offcanvas-end" tabindex="-1"
        id="ViewTracking<?= $obj['ticket_data']['id']; ?>">
        <div
            class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
            <h2 class="fs-16 fw-bold text-truncate-1-line">Ticket <?= $obj['ticket_data']['ticket'] ?>  Details</h2>
            <button type="button" class="btn-close"
                data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="drive-comments">
                <div class="px-4 py-2 fw-bold text-dark border-top border-bottom sticky-top bg-gray-100"> Activity</div>
                <div class="p-4">
                    <ul class="list-unstyled activity-feed">
                        <li class="d-flex justify-content-between feed-item feed-item-success">
                            <div>
                                <span class="text-truncate-1-line lead_date"> </span>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0)" class="me-2"> Ticket Created <?= $obj['ticket_data']['ticket'] ?></a>
                                    <div class="fs-11 fw-normal text-muted">(<?= $obj['ticket_data']['created_at'] ?>)</div>
                                </div>
                                 <div class="fs-12 text-muted mt-1 text-truncate-2-line"><?= $obj['ticket_data']['description'] ?></div>
                            </div>
                            <!-- <div class="ms-3 d-flex gap-2 align-items-center">
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Make Read" aria-label="Make Read"><i class="feather feather-check fs-12"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="View Activity" aria-label="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="More Options" aria-label="More Options"><i class="feather feather-more-vertical"></i></a>
                            </div> -->
                        </li>
                        <li class="d-flex justify-content-between feed-item feed-item-info">
                            <div>
                                <span class="text-truncate-1-line lead_date">5+ friends join this group <span class="date">[April 20, 2023]</span></span>
                                <span class="text">Joined the group <a href="javascript:void(0);" class="fw-bold text-primary">"Duralux"</a></span>
                            </div>
                            <!-- <div class="ms-3 d-flex gap-2 align-items-center">
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Make Read" aria-label="Make Read"><i class="feather feather-check fs-12"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="View Activity" aria-label="View Activity"><i class="feather feather-eye fs-12"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-sm" data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="More Options" aria-label="More Options"><i class="feather feather-more-vertical"></i></a>
                            </div> -->
                        </li>
                    </ul>
                </div>
            </div>
           <div class="drive-comments">
            <div class="px-4 py-2 fw-bold text-dark border-top border-bottom sticky-top bg-gray-100">Comments</div>
                <div class="p-4">
                  
                    <div class="mb-4 d-flex align-items-start">
                        <div class="me-3 avatar-image">
                            <img src="assets/images/avatar/3.png" class="rounded-circle img-fluid" alt="image">
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" class="me-2"> Marianne Audrey </a>
                                <div class="fs-11 fw-normal text-muted">(Mar 2, 5:26 am)</div>
                            </div>
                            <div class="fs-12 text-muted mt-1 text-truncate-2-line">Lorem ipsum dolor sit amet, consec tetuer adipi scing elit aenean commodo scing elit aenean commodo</div>
                        </div>
                    </div>
                    <div class="mb-4 d-flex align-items-start">
                        <div>
                            <div class="me-3 bg-warning text-white avatar-text">N</div>
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" class="me-2"> Nancy Elliot </a>
                                <div class="fs-11 fw-normal text-muted">(Mar 2, 5:26 am)</div>
                            </div>
                            <div class="fs-12 text-muted mt-1 text-truncate-2-line">Lorem ipsum dolor sit amet, consec tetuer adipi scing elit aenean commodo scing elit aenean commodo</div>
                        </div>
                    </div>
                    <div class="mb-4 d-flex align-items-start">
                        <div class="me-3 avatar-image">
                            <img src="assets/images/avatar/4.png" class="rounded-circle img-fluid" alt="image">
                        </div>
                        <div>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" class="me-2"> Holland Scott </a>
                                <div class="fs-11 fw-normal text-muted">(Mar 2, 2:21 pm)</div>
                            </div>
                            <div class="fs-12 text-muted mt-1 text-truncate-2-line">Lorem ipsum dolor sit amet, consec tetuer adipi scing elit aenean commodo scing elit aenean commodo</div>
                        </div>
                    </div>
                    <textarea rows="5" class="form-control" placeholder="Comment"></textarea>
                    <a href="javascript:void(0);" class="btn btn-primary mt-4">Post Comment</a>
                </div>
            </div>
        </div>
        <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
            <a href="javascript:void(0);" class="btn btn-danger w-50"
                data-bs-dismiss="offcanvas">Cancel</a>
        </div>
    </div>