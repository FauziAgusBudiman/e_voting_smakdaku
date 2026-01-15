<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        /* Override Dashboard Background */
        body { background-color: #1A252F !important; color: #ECF0F1; }
        
        .cursor-pointer { cursor: pointer; }
        
        /* Card Styling Theme */
        .hover-card:hover { 
            background-color: rgba(231, 76, 60, 0.05) !important;
            border-color: #E74C3C !important; 
            transition: all 0.3s ease;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        /* Modal Theme */
        .modal-content { 
            border-radius: 20px; 
            overflow: hidden; 
            background-color: #2C3E50; 
            color: #ECF0F1;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .modal-header {
            border-bottom: 2px solid #E74C3C !important;
            background: linear-gradient(135deg, #2C3E50 0%, #1A252F 100%) !important;
        }
        .modal-footer {
            background-color: #1A252F !important;
            border-top: 1px solid rgba(255,255,255,0.05) !important;
        }

        /* Progress & Buttons */
        .progress-thin { height: 8px; border-radius: 10px; background-color: rgba(255,255,255,0.1); }
        .btn-round { border-radius: 30px; padding-left: 25px; padding-right: 25px; }
        
        .btn-primary { 
            background-color: #E74C3C !important; 
            border-color: #E74C3C !important; 
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        .btn-primary:hover { background-color: #C0392B !important; }
        
        .text-primary { color: #E74C3C !important; }
        .bg-primary { background-color: #E74C3C !important; }
        
        /* Form Inputs */
        .form-control {
            background-color: #1A252F !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: white !important;
        }
        .form-control:focus {
            border-color: #E74C3C !important;
            box-shadow: none;
        }
        .input-group-text {
            background-color: #34495E !important;
            border: 1px solid rgba(255,255,255,0.1) !important;
            color: #ECF0F1 !important;
        }

        /* Typography */
        .text-gray-800 { color: #ffffff !important; }
        .text-muted { color: #bdc3c7 !important; }
        .border { border: 1px solid rgba(255,255,255,0.1) !important; }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 text-gray-800 font-weight-bold">Dashboard</h4>
            <p class="text-muted small mb-0">Kelola laporan dan pantau aktivitas pemungutan suara.</p>
        </div>
        <!-- <div class="d-flex mt-3 mt-sm-0">
            <div class="btn-group shadow-sm border rounded-pill overflow-hidden">
                <a href="{{ route('dashboard.generate-pdf') }}" target="_blank" class="btn btn-white btn-sm text-danger border-right bg-dark border-0">
                    <i class="fas fa-file-pdf mr-1"></i> PDF REPORT
                </a>
            </div>
        </div> -->
    </div>

    @include('dashboard.components.card')

    @include('dashboard.components.chart')

    <div class="modal fade" id="emailConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white py-3">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-envelope-open-text mr-2 text-primary"></i>Email Report
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="options-container mb-4">
                        <label class="text-primary font-weight-bold small text-uppercase mb-3 d-block" style="letter-spacing: 1px;">Choose Destination</label>
                        
                        <div class="custom-control custom-radio mb-3 p-3 border rounded hover-card cursor-pointer" style="background: rgba(255,255,255,0.02);">
                            <input type="radio" id="sendToAll" name="sendOption" class="custom-control-input" value="all" checked>
                            <label class="custom-control-label d-block cursor-pointer" for="sendToAll">
                                <span class="d-block font-weight-bold text-white">Broadcast to All</span>
                                <small class="text-muted">Send report to all registered voters and administrators.</small>
                            </label>
                        </div>

                        <div class="custom-control custom-radio p-3 border rounded hover-card cursor-pointer" style="background: rgba(255,255,255,0.02);">
                            <input type="radio" id="sendToSingle" name="sendOption" class="custom-control-input" value="single">
                            <label class="custom-control-label d-block cursor-pointer" for="sendToSingle">
                                <span class="d-block font-weight-bold text-white">Specific Recipient</span>
                                <small class="text-muted">Enter a single email address to receive the report.</small>
                            </label>
                        </div>
                    </div>

                    <div class="form-group d-none animate__animated animate__fadeIn" id="singleEmailField">
                        <label for="singleEmail" class="font-weight-bold small text-muted">Recipient Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="email" class="form-control" id="singleEmail" placeholder="name@example.com">
                        </div>
                    </div>

                    <div class="alert bg-dark border-0 small py-2 px-3 mb-0 text-muted" id="confirmationBox">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        <span id="confirmationText">Ready to broadcast the voting results.</span>
                    </div>

                    <div class="mt-4 d-none" id="emailProgress">
                        <div class="progress progress-thin mb-2">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small class="text-muted d-block text-center italic">Processing, please wait...</small>
                    </div>

                    <div id="emailResult" class="mt-3"></div>
                </div>

                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal" style="text-decoration: none;">Cancel</button>
                    <button type="button" class="btn btn-primary btn-round shadow-sm font-weight-bold" id="confirmSendEmails">
                        Send Emails <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // UI Interactivity: Toggle email input field
            $('input[name="sendOption"]').on('change', function() {
                if ($(this).val() === 'single') {
                    $('#singleEmailField').removeClass('d-none').addClass('animate__fadeIn');
                    $('#confirmationText').text('The report will be sent to the specific address below.');
                } else {
                    $('#singleEmailField').addClass('d-none');
                    $('#confirmationText').text('The report will be sent to all voters and administrators.');
                }
            });

            // Show Modal
            $('#sendEmailsBtn').on('click', function() {
                $('#emailProgress').addClass('d-none');
                $('#emailResult').empty();
                $('#confirmSendEmails').prop('disabled', false);
                $('#emailConfirmationModal').modal('show');
            });

            // Handle Email Sending via AJAX
            $('#confirmSendEmails').on('click', function() {
                const $btn = $(this);
                const sendOption = $('input[name="sendOption"]:checked').val();
                const singleEmail = $('#singleEmail').val();

                // Validation for single email
                if (sendOption === 'single' && !singleEmail) {
                    $('#emailResult').html('<div class="alert alert-warning small bg-dark border-warning text-warning">Please enter a valid email address.</div>');
                    return;
                }

                // UI Loading State
                $btn.prop('disabled', true);
                $('#emailProgress').removeClass('d-none');
                $('#emailProgress .progress-bar').css('width', '40%');
                $('#emailResult').empty();
                $('#confirmationBox').addClass('d-none');

                $.ajax({
                    url: '{{ route('dashboard.send-report-emails') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sendOption: sendOption,
                        singleEmail: singleEmail
                    },
                    success: function(response) {
                        $('#emailProgress .progress-bar').css('width', '100%');
                        $('#emailResult').html(`
                            <div class="alert alert-success border-0 shadow-sm animate__animated animate__bounceIn bg-dark text-success">
                                <i class="fas fa-check-circle mr-2"></i> ${response.message}
                            </div>
                        `);
                        setTimeout(() => {
                            $('#emailConfirmationModal').modal('hide');
                        }, 2500);
                    },
                    error: function(xhr) {
                        $('#emailProgress').addClass('d-none');
                        const errorMsg = xhr.responseJSON?.message || 'Failed to send emails. Check connection.';
                        $('#emailResult').html(`
                            <div class="alert alert-danger border-0 shadow-sm bg-dark text-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i> ${errorMsg}
                            </div>
                        `);
                        $btn.prop('disabled', false);
                        $('#confirmationBox').removeClass('d-none');
                    }
                });
            });
        });
    </script>
</x-layout>