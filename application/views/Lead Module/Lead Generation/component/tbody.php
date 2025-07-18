<tbody>
    <?php if (!empty($leads)) {
        $i = 1;
        foreach ($leads as $obj) { ?>
            <tr>
                <td>
                    <div class="item-checkbox ms-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input checkbox sub_chk" name="sub_chk[]"
                                id="checkBox_<?= $i ?>" value="<?= $obj['id'] ?>">
                            <label class="custom-control-label" for="checkBox_<?= $i ?>"></label>
                        </div>
                    </div>
                </td>
                <td><?= $i ?></td>
                <td>
                    <?php if (!empty($obj['is_duplicate']) && $obj['is_duplicate'] == 1) { ?>
                        <p style="color:red;">Seems Like Duplicate as</p>
                        <a href="<?= base_url('index.php/Leads/view/' . $obj['duplicate_lead_code']) ?>">
                            <?= $obj['duplicate_lead_code'] ?>
                        </a>
                    <?php } ?>
                </td>
                <td>
                    <?php
                    $status = $obj['lead_status'];
                    switch ($status) {
                        case 'Pending':
                            echo '<div class="badge bg-warning text-dark">Pending</div>';
                            break;
                        case 'Approved':
                            echo '<div class="badge bg-success text-white">Approved</div>';
                            break;
                        case 'In Process':
                            echo '<div class="badge bg-primary text-white">In Process</div>';
                            break;
                        case 'Converted':
                            echo '<div class="badge bg-info text-white">Converted</div>';
                            break;
                        case 'Rejected':
                            echo '<div class="badge bg-danger text-white">Rejected</div>';
                            break;
                        default:
                            echo '<div class="badge bg-secondary text-white">Unknown</div>';
                    }
                    ?>
                </td>
                <td><?= $obj['lead_code'] ?? '-' ?></td>
                <td style="white-space: nowrap;">
                    <?= !empty($obj['date']) ? date('d-M-Y', strtotime($obj['date'])) : '-' ?>
                </td>
                <td><?= $obj['category_name'] ?? '-' ?></td>
                <td style="max-width:250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <?= $obj['lead_title'] ?? '-' ?>
                </td>
                <td><?= $obj['contact_person'] ?? '-' ?></td>
                <td>
                    <a href="tel:<?= $obj['mobile'] ?>"><?= $obj['mobile'] ?? '-' ?></a>
                </td>
                <td>
                    <a href="mailto:<?= $obj['email'] ?>"><?= $obj['email'] ?? '-' ?></a>
                </td>
                <td>
                    <div class="hstack gap-2 justify-content-end">
                        <a href="<?php echo base_url(); ?>index.php/Leads/add/<?php echo $obj['id']; ?>"
                            class="avatar-text avatar-md">
                            <i class="feather feather-edit-3 "></i>
                        </a>
                        <a class="avatar-text avatar-md" data-bs-toggle="offcanvas"
                            data-bs-target="#ViewLeave<?php echo $obj['id']; ?>">
                            <i class="feather feather-eye"></i>
                        </a>
                    <?php $this->load->view('Lead Module/Lead Generation/component/view-leave', ['obj' => $obj]); ?>
                    </div>
                </td>
            </tr>
            <?php $i++;
            
        }
    } else { ?>
        <tr>
            <td colspan="100">
                <h5 style="text-align: center;">No Leads Found</h5>
            </td>
        </tr>
    <?php } ?>
</tbody>