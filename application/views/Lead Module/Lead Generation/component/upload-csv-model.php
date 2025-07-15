<!-- Accordion Section -->
<div id="UploadCsvs" class="accordion-collapse collapse page-header-collapse">
    <div class="accordion-body d-flex justify-content-center">
        <div class="card shadow rounded p-4" style="width: 60%;">
            <h5 class="mb-3"><i class="feather-upload-cloud me-2"></i>Upload Excel/CSV File</h5>
            <form action="<?= base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
                
                <!-- File Input -->
                <div class="mb-3">
                    <label for="csvFile" class="form-label fw-semibold">Choose File</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="csvFile" name="csv_file" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                        <label class="input-group-text" for="csvFile">
                            <i class="feather-paperclip"></i>
                        </label>
                    </div>
                    <div class="form-text text-muted">
                        Accepted formats: <strong>.csv, .xls, .xlsx</strong>
                    </div>
                </div>

                <!-- Note -->
                <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="feather-info me-2"></i>
                    <div>Only Excel/CSV file uploads allowed. Ensure it matches the required format.</div>
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="feather-upload me-1"></i> Upload File
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
