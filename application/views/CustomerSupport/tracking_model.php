<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewTracking<?= $obj['ticket_data']['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold text-truncate-1-line">
            Ticket <?= $obj['ticket_data']['ticket'] ?> Details
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Main Body (now scrollable with sticky activity header) -->
    <div class="offcanvas-body" style="padding-bottom: 150px; overflow-y: auto; position:relative;">
        <!-- Activity Section with STICKY HEADER -->
        <div class="drive-comments">
            <!-- Sticky Activity Title -->
            <div 
                class="px-4 py-2 fw-bold text-dark border-top border-bottom bg-gray-100"
                style="position: sticky; top: 0; z-index: 2;">
                Activity
            </div>
            <div class="p-4 pb-2">
                <ul class="list-unstyled activity-feed mb-0">
                    <!-- Ticket Created Entry -->
                    <li class="d-flex justify-content-between feed-item feed-item-success">
                        <div>
                            <span class="text-truncate-1-line lead_date"></span>
                            <div class="d-flex align-items-center">
                                <a href="javascript:void(0)" class="me-2">
                                    Ticket Created <?= $obj['ticket_data']['ticket'] ?>
                                </a>
                                <div class="fs-11 fw-normal text-muted">(<?= $obj['ticket_data']['created_at'] ?>)</div>
                            </div>
                            <div class="fs-12 text-muted mt-1" style="white-space: pre-line; justify-content:center">
                                <?= $obj['ticket_data']['description'] ?>
                                <!-- Ticket Attachment -->
                                <?php if (!empty($obj['ticket_data']['photo'])) { ?>
                                    <a href="<?= base_url().'uploads/user_media/'.$obj['ticket_data']['photo']; ?>" target="_blank" download style="margin-left:10px;">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <!-- Timeline / Replies / Followups -->
                    <?php if (!empty($obj['followups'])) foreach ($obj['followups'] as $followup) { ?>
                        <li class="d-flex justify-content-between feed-item <?=!empty($followup['followup_by'])?'feed-item-info':'feed-item-secondary'?>">
                            <div>
                                <div class="d-flex align-items-center" >
                                    <span class="me-2">
                                        Reply by <?= !empty($followup['followup_by']) ? 'Company' : 'Customer'; ?>
                                    </span>
                                    <span class="fs-11 text-muted">(<?= $followup['followup_time'] ?>)</span>
                                </div>
                                <div class="fs-12"style="white-space: pre-line; justify-content:center">
                                    <?= $followup['answer'] ?>
                                    <?php if (!empty($followup['file_path'])) { ?>
                                        <a href="<?= base_url() . 'uploads/user_media/' . $followup['file_path']; ?>" target="_blank" download style="margin-left:10px;">
                                            <i class="fa fa-paperclip" aria-hidden="true"></i>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    <!-- Ticket Status (Closed / Resolved) -->
                    <?php if ($obj['ticket_data']['status'] == 'Closed') { ?>
                        <li class="d-flex justify-content-between feed-item feed-item-danger">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Ticket Closed</span>
                                    <span class="fs-11 text-muted">(<?= $obj['ticket_data']['closed_date'] ?>)</span>
                                </div>
                                <span class="badge bg-danger">Closed</span>
                            </div>
                        </li>
                    <?php } elseif ($obj['ticket_data']['status'] == 'Resolved') { ?>
                        <li class="d-flex justify-content-between feed-item feed-item-info">
                            <div>
                                <div class="d-flex align-items-center">
                                    <span class="me-2">Ticket Resolved</span>
                                    <span class="fs-11 text-muted">(<?= $obj['ticket_data']['resolved_date'] ?>)</span>
                                </div>
                                <span class="badge bg-info">Resolved</span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Sticky Footer: Only show if not closed/resolved -->
    <?php if ($obj['ticket_data']['status'] !== 'Closed' && $obj['ticket_data']['status'] !== 'Resolved') { ?>
    <div class="position-sticky bottom-0 w-100 bg-white border-top px-4 py-3" style="z-index: 1056;">
        <label for="comment" class="fw-bold text-dark mb-2">Reply</label>
        <form method="post" action="<?= base_url(); ?>index.php/CustomerSupport_controller/add_followup" enctype="multipart/form-data">
            <div style="border:1px solid gray; padding:5px; border-radius:10px; margin:5px">
                <input type="hidden" name="ticket" value="<?= $obj['ticket_data']['ticket'] ?>">
            <input type="hidden" name="customer_id" value="<?= $login_id ?>" >
            <textarea style=" border: none; outline: none;" id="comment" name="answer" rows="2" class="form-control mb-2" placeholder="Write your reply..." required></textarea>
            <!-- WhatsApp Style File Attach -->
            <div class="mb-3 position-relative">
                <input type="file" id="waAttachmentInput<?= $obj['ticket_data']['id'] ?>" name="attachment" class="d-none">
                <label for="waAttachmentInput<?= $obj['ticket_data']['id'] ?>" style="cursor:pointer;">
                    <span style="display: inline-flex; align-items: center; gap:5px;">
                        <!-- WhatsApp SVG Paperclip icon (you can swap with <i class="fa fa-paperclip"></i> if you want FontAwesome instead) -->
                        <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.437 11.566 11.568 21.436c-2.73 2.732-7.166 2.732-9.898 0-2.733-2.732-2.733-7.167 0-9.899l9.899-9.899c2.341-2.34 6.134-2.34 8.474 0 2.34 2.34 2.34 6.133 0 8.474l-9.9 9.899a3.555 3.555 0 0 1-5.032-5.033l9.192-9.191.707.707-9.193 9.19a2.555 2.555 0 1 0 3.615 3.613l9.899-9.899a5.006 5.006 0 0 0 0-7.072c-1.948-1.949-5.123-1.949-7.073 0l-9.899 9.899c-3.121 3.121-3.121 8.196 0 11.317 3.12 3.12 8.196 3.12 11.316 0l9.899-9.899.707.707z"/>
                        </svg>
                       
                    </span>
                </label>
            </div>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="submit" class="btn btn-primary">Post Reply</button>
                <button type="button" class="btn btn-danger w-25" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
    <?php } ?>
</div>
