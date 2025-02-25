<style>
    #voice-recorder {
        position: fixed;
        bottom: 20px;
        right: 10px;
        display: flex;
        align-items: center;
        transition: transform 0.3s ease;
        z-index: 999;
    }

    #voice-recorder.retracted {
        transform: translateX(calc(100% - 20px));
    }

    #toggle-button {
        background: #6a4a86;
        color: white;
        border: none;
        padding: 8px 13px;
        cursor: pointer;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease;
    }

    #toggle-button:hover {
        background: rgb(66, 42, 87);
    }

    #recorder-container {
        display: flex;
        align-items: center;
        background: #f5f5f5;
        padding: 0px 10px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-left: 10px;
    }

    #mic-button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 24px;
        color: green;
    }

    #info-button {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: darkgray;
    }

    #mic-button.recording {
        color: #ff4d4d;
    }

    .recordingDiv {
        outline: 1px solid red;
    }

    #download-button {
        background: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 20px;
        font-size: 14px;
        transition: background 0.3s ease;
    }

    #download-button:disabled {
        background: #cccccc;
        cursor: not-allowed;
    }

    #download-button:hover:not(:disabled) {
        background: #218838;
    }

    .small-block {
        background: #282c34;
        color: #61dafb;
        padding: 15px;
        border-radius: 8px;
        font-family: monospace;
        white-space: pre-wrap;
    }

    .command {
        color: #98c379;
        font-weight: bold;
    }
</style>
<div class="modal fade" id="infoModal" role="dialog" aria-labelledby="voiceCommandsTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Voice Commands</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_finish_modal" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <span>The voice command feature allows you to perform actions such as navigating to modules or executing other system commands using simple spoken phrases. To use it, retract the arrow in the bottom-right corner and click the mic icon. An indicator will show that the voice command is being recorded. After saying the command, click the mic icon again to process it into action.</span>
                    </div>
                    <div class="col-md-12 mb-3">
                        <strong>> go to</strong>
                        <ul class="ps-4 mb-0">
                            <li>Allows to navigate on specific module. Click this <a class="text-decoration-none" href="#gotoModulesCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">[module list]</a> link to see the available modules you can redirect to.</li>
                            <li><u>Example</u>: say <strong>"go to [module]"</strong> and it will redirect to the specific module.</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="collapse" id="gotoModulesCollapse">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Modules</th>
                                            <th>Navigation Path</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="voice-recorder" class="retracted">
    <button id="toggle-button"><i class="fas fa-chevron-left"></i></button>
    <div id="recorder-container">
        <button id="mic-button"><i class="fas fa-microphone"></i></button>
        <button id="info-button" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fas fa-info-circle"></i></button>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/pluralize@8.0.0/pluralize.min.js"></script>
<script>
    $(document).ready(function() {
        var BASE_URL = window.origin;
        let isRetracted = true;
        let isRecording = false;
        let mediaRecorder;
        let audioChunks = [];
        let db;
        const API_KEY = '5aeaacff142e4add9ed06d5d7c2b8b42';
        const API_URL = 'https://api.assemblyai.com/v2/transcript';
        const gotoCommandDictionary = {
            // Dashboard and Notifications
            "dashboard": "/dashboard",
            "inbox": "/inbox",

            // Communication
            "sms": "/messages",
            "calls and logs": "/calls",
            "scheduled calls": "/calls/scheduled_calls",
            "smart zoom": "/SmartZoom",

            // Calendar and Appointments
            "work calender": "/workcalender",
            "work calender settings": "/settings/schedule",
            "appointment types": "/appointment_types/index",
            "online booking": "/more/addon/booking",

            // Events
            "events": "/events",
            "event settings": "/events/settings",
            "event types settings": "/events/event_types",
            "event tags settings": "/events/event_tags",
            "add event": "/events/event_add",
            "add event type": "/events/event_types_add",
            "add event tag": "/events/event_tags_add",

            // Tasks and Jobs
            "task hub": "/taskhub",
            "add task": "/taskhub/create",
            "jobs": "/job",
            "job settings": "/job/settings",
            "job type settings": "/job/job_types",
            "job tag settings": "/job/job_tags",
            "job checklist settings": "/job_checklists/list",
            "add job": "/job/new",
            "add job checlist": "/job_checklists/add_new",
            "bird's eye view": "/job/bird_eye_view",

            // Estimates and Work Orders
            "estimates": "/estimate",
            "estimate settings": "/estimate/settings",
            "estimate plan settings": "/plans",
            "add estimate plan": "/plans/add",
            "work orders": "/workorder",
            "work order settings": "/workorder/settings",
            "work order checklist settings": "/workorder/checklists",
            "work order priority settings": "/estimate/priority",
            "work order status settings": "/workorder/status",
            "add work order checklist": "/workorder/add_checklist",

            // Tickets and Support
            "tickets": "/customer/ticketslist",
            "ticket settings": "/tickets/settings",
            "ticket panel types settings": "/tickets/settings_panel_types",
            "ticket plan types settings": "/tickets/settings_plan_types",
            "add ticket": "/ticket/add",

            // Customers and Leads
            "customers": "/customer",
            "accounting customers": "/accounting/customers",
            "add customer": "/customer/add_advance",
            "residential customers": "/customer/residential",
            "commercial customers": "/customer/commercial",
            "customer groups settings": "/customer/group",
            "lead settings": "/customer/leads",
            "sales area settings": "/customer/settings_sales_area",
            "lead source settings": "/customer/settings_lead_source",
            "lead types settings": "/customer/settings_lead_types",
            "customer status settings": "/customer/status",
            "rate plan settings": "/customer/settings_rate_plans",
            "activation fee settings": "/customer/settings_activation_fee",
            "system package type settings": "/customer/settings_system_package",
            "financing payment categories settings": "/customer/settings_financing_categories",
            "solar lender types settings": "/customer/settings_solar_lender_type",
            "solar system size settings": "/customer/settings_solar_system_size",
            "solar proposed modules settings": "/customer/settings_solar_modules",
            "solar proposed inverters settings": "/customer/settings_solar_inverter",
            "customer table header settings": "/customer/settings_headers",
            "customer import settings": "/customer/settings_import",
            "customer export settings": "/customer/settings_export",
            "customer form fields settings": "/customer/form_settings",

            // Accounting and Finance
            "banking": "/accounting/banking",
            "link bank": "/accounting/link_bank",
            "cash flow": "/accounting/cashflowplanner",
            "expenses": "/accounting/expenses",
            "sales overview": "/accounting/sales-overview",
            "payroll overview": "/accounting/payroll-overview",
            "reports": "/accounting/reports",
            "taxes": "/accounting/salesTax",
            "chart of accounts": "/accounting/chart-of-accounts",
            "invoices": "/invoice",
            "add invoice": "/invoice/add",
            "products and services": "/accounting/products-and-services",
            "employees": "/accounting/employees",
            "contractors": "/accounting/contractors",

            // Inventory and Vendors
            "inventory": "/inventory",
            "services": "/inventory/services",
            "fees": "/inventory/fees",
            "vendors": "/inventory/vendors",
            "item categories settings": "/inventory/item_groups",
            "add item": "/inventory/add",

            // Business Tools and Automation
            "business tools": "/tools/api_connectors",
            "eSign": "/esignmain",
            "my business overview": "/users/businessview",
            "account summary": "/mycrm/account_summary",
            "automation": "/automation"
        };

        function processToSingular(text) {
            return text.toLowerCase()
                       .replace(/[^a-z0-9\s]/g, '')
                       .split(/\s+/)
                       .map(word => pluralize.singular(word))
                       .join(' ')
                       .trim();
        }

        const processGotoCommandDictionary = {};
        for (const key in gotoCommandDictionary) {
            const processCommandKey = processToSingular(key);
            processGotoCommandDictionary[processCommandKey] = gotoCommandDictionary[key];
        }

        function handleVoiceCommand(commandText) {
            let processedCommand = commandText.replace(/^(go to|goto|open|show)\s+/i, '');
            const processCommand = processToSingular(processedCommand);
            Swal.close();

            if (processGotoCommandDictionary[processCommand]) {

                const navigation = Object.keys(gotoCommandDictionary).find(
                    key => processToSingular(key) === processCommand
                );

                iziToast.success({
                    message: `Redirecting to ${navigation}.`,
                    displayMode: 1,
                    timeout: 2000,
                    position: 'topCenter',
                    close: true,
                    onClosed: function(instance, toast, closedBy) {
                        window.location.href = `${BASE_URL}/${processGotoCommandDictionary[processCommand]}`;
                    }
                });

                return;

            } else {
                iziToast.error({
                    message: 'Command not recognized. Please try again.',
                    displayMode: 1,
                    timeout: 3000,
                    position: 'topCenter',
                    close: true
                });
            }
        }

        function populateVoiceCommandTable() {
            const tableBody = $("#infoModal tbody");
            tableBody.empty();

            $.each(gotoCommandDictionary, (command, url) => {
                const row = `
                    <tr>
                        <td>${command}</td>
                        <td><small class="font-monospace text-muted">${url}</small></td>
                    </tr>
                `;
                tableBody.append(row);
            });
        } populateVoiceCommandTable();

        function initDB() {
            const request = indexedDB.open("VoiceCommandDB", 1);

            request.onupgradeneeded = (event) => {
                db = event.target.result;
                if (!db.objectStoreNames.contains("audioFiles")) {
                    db.createObjectStore("audioFiles", {
                        keyPath: "id",
                        autoIncrement: true
                    });
                }
            };

            request.onsuccess = (event) => {
                db = event.target.result;
            };

            request.onerror = (event) => {
                console.error("Error opening IndexedDB:", event.target.error);
            };
        };

        function saveAudioToDB(audioBlob) {
            const transaction = db.transaction("audioFiles", "readwrite");
            const store = transaction.objectStore("audioFiles");
            store.clear().onsuccess = () => {
                const request = store.add({
                    blob: audioBlob
                });

                request.onsuccess = () => {
                    console.log("Audio saved to IndexedDB");
                    $("#download-button").prop("disabled", false);
                };

                request.onerror = (event) => {
                    console.error("Error saving audio:", event.target.error);
                };
            }
        };

        function getAudioBlob() {
            const transaction = db.transaction("audioFiles", "readonly");
            const store = transaction.objectStore("audioFiles");
            const request = store.getAll();

            request.onsuccess = (event) => {
                const audioFiles = event.target.result;
                if (audioFiles.length > 0) {
                    const audioBlob = audioFiles[audioFiles.length - 1].blob;
                    // transcribeAudio(audioBlob);
                    const url = URL.createObjectURL(audioBlob);
                    const a = document.createElement("a");
                    a.href = url;
                    a.download = "voiceCommand.webm";
                    a.click();
                    URL.revokeObjectURL(url);
                }
            };

            request.onerror = (event) => {
                console.error("Error retrieving audio:", event.target.error);
            };
        };

        function transcribeAudio(audioBlob) {
            const formData = new FormData();
            formData.append("file", audioBlob); 

            $.ajax({
                url: `${BASE_URL}/VoiceCommand/uploadVoiceCommand`, 
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function(uploadResponse) {
                    const response = JSON.parse(uploadResponse);

                    if (response.status === 'success') {
                        const fileUrl = response.file_url; 
                        console.log("File uploaded successfully. URL:", fileUrl);

                        $.ajax({
                            url: API_URL,
                            method: "POST",
                            headers: {
                                authorization: API_KEY,
                                "content-type": "application/json",
                            },
                            data: JSON.stringify({
                                audio_url: fileUrl,
                            }),
                            success: function(submitResponse) {
                                const transcriptId = submitResponse.id;
                                console.log("Transcript ID:", transcriptId);
                                pollTranscriptionResult(transcriptId);
                            },
                            error: function(error) {
                                console.error("Error submitting transcription:", error.responseJSON || error.message);
                                $("#transcriptionResult").text(
                                    "Error: " + (error.responseJSON ? error.responseJSON.error : error.message)
                                );
                            },
                        });
                    } else {
                        console.error("Error uploading file to server:", response.message);
                    }
                },
                error: function(error) {
                    console.error("Error uploading file to server:", error.responseJSON || error.message);
                },
            });
        }

        function pollTranscriptionResult(transcriptId) {
            $.ajax({
                url: `${API_URL}/${transcriptId}`,
                method: 'GET',
                headers: {
                    authorization: API_KEY,
                },
                success: function(statusResponse) {
                    if (statusResponse.status === 'completed') {

                        console.log('Transcription:', statusResponse.text);
                        handleVoiceCommand(statusResponse.text);

                    } else if (statusResponse.status === 'error') {
                        console.error('Transcription failed:', statusResponse.error);
                    } else {
                        console.log('Transcription status:', statusResponse.status);
                        setTimeout(function() {
                            pollTranscriptionResult(transcriptId);
                        }, 3000);
                    }
                },
                error: function(error) {
                    console.error('Error polling transcription status:', error.responseJSON || error.message);
                },
            });
        }

        $("#mic-button").click(function() {
            if (!isRecording) {
                navigator.mediaDevices.getUserMedia({ audio: true })
                    .then(function(stream) {
                        mediaRecorder = new MediaRecorder(stream, { mimeType: "audio/webm;codecs=opus" });
                        mediaRecorder.ondataavailable = function(event) {
                            audioChunks.push(event.data);
                        };

                        mediaRecorder.onstop = function() {
                            const audioBlob = new Blob(audioChunks, { type: "audio/webm" });

                            // if (audioBlob.size === 0) {
                            //     console.error("Recorded audio blob is empty.");
                            //     alert("No audio data recorded. Please try again.");
                            //     return;
                            // }

                            // console.log("Audio Blob Size:", audioBlob.size);
                            // console.log("Audio Blob Type:", audioBlob.type);

                            // saveAudioToDB(audioBlob);
                            transcribeAudio(audioBlob);
                            audioChunks = [];
                        };

                        mediaRecorder.start();
                        isRecording = true;
                        $("#mic-button").addClass("recording");
                        $("#recorder-container").addClass("recordingDiv");

                        iziToast.warning({
                            id: 'voiceCommandToast',
                            message: 'You are currently recording a voice command',
                            displayMode: 1,
                            timeout: false,
                            position: 'topCenter',  
                            close: true
                        });
                    })
                    .catch(function(error) {
                        console.error("Error accessing microphone:", error);

                        iziToast.error({
                            message: 'Microphone access is required for recording. Please grant permission.',
                            displayMode: 1,
                            timeout: 3000,
                            position: 'topCenter',
                            close: true
                        });
                    });
            } else {
                mediaRecorder.stop();
                isRecording = false;
                $("#mic-button").removeClass("recording");
                $("#recorder-container").removeClass("recordingDiv");

                iziToast.hide({
                    transitionOut: 'fadeOut'
                }, document.querySelector('#voiceCommandToast'));

                Swal.fire({
                    icon: "info",
                    title: "Processing Command!",
                    html: "Please wait while processing the voice command...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            }
        });

        $("#toggle-button").click(function (e) { 
            isRetracted = !isRetracted;
            $("#voice-recorder").toggleClass("retracted", isRetracted);
            $("#toggle-button i").toggleClass("fa-chevron-left fa-chevron-right");
        });

        initDB();
    });
</script>