@extends('layout3')

@section('content')
    <div class="container mx-auto mb-2 p-1">
        <div class="flex flex-wrap">

            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6  sm:p-6 md:p-8 ">

                <div class="mb-4">

                    <h1
                        class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-teal-500 text-4xl font-black">
                        CREATE NEW DAYWORK</h1>

                    <form id="myForm" action="{{ route('daywork_orders.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- header Container starts here -->
                        <div class="grid grid-col-1 sm:grid-cols-2 gap-2">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                <input type="date" id="date" name="dayworks_date"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="site_induction_no"
                                    class="text-left block text-sm font-medium text-gray-700">Site
                                    Induction No</label>
                                <input type="text" id="site_induction_no" name="site_induction_no"
                                    class="w-full ml-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                    value="{{ isset($project) ? $project->project_number : '' }}">
                            </div>
                            <div>
                                <label for="dayworks_ref_no" class="block text-sm font-medium text-gray-700">Dayworks Ref
                                    No</label>
                                <input type="text" id="dayworks_ref_no" name="dayworks_ref_no"
                                    value=""class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="project_name" class="text-left block text-sm font-medium text-gray-700">Project
                                    Name</label>
                                <input type="hidden" id="project_id" name="project_id" value="{{ $project->id }}">
                                <input type="text" id="project_name" name="project_name"
                                    class="w-full ml-auto w-80 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                    value="{{ isset($project) ? $project->project_name : '' }} " readonly disabled>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <option value="Ongoing" selected>Ongoing</option>
                                    <option value="Completed">Completed</option>

                                </select>
                            </div>
                            <div>
                                <label for="description"
                                    class="text-left block text-sm font-medium text-gray-700">Description
                                    of
                                    Work</label>
                                <input id="description" name="description_of_work" rows="3" value=""
                                    class=" w-full ml-auto w-80 h-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="site_instruction_no" class="block text-sm font-medium text-gray-700">Site
                                    Instruction No</label>
                                <input type="text" id="site_instruction_no" name="site_instruction_no"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="issued_by" class="text-left block text-sm font-medium text-gray-700">Issued
                                    By</label>

                                <input type="hidden" id="issued_by" name="issued_by" value="{{ auth()->user()->id }}">
                                <input type="text" id="issued_by_name" name="issued_by_name"
                                    class="w-full ml-auto w-80 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                    value="{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}"readonly
                                    disabled>
                            </div>
                        </div>

                        <!-- lineItem Container starts here -->
                        <div id="lineItemsContainer">

                            <label class = "text-2xl font-semibold text-gray-900">MATERIAL</label>

                            <div
                                class="grid grid-cols-3 sm:grid-cols-6 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                <select class="bg-transparent manufacturer_name" name="manufacturer_name[]"
                                    placeholder="Manufacturer name" id="manufacturer_name">
                                    @foreach ($supplier_names as $supplier)
                                        <option value="{{ $supplier->supplier_name }}">
                                            {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                    <option value="other">Other</option>

                                </select>
                                {{-- <input class="bg-transparent" type="text" name="manufacturer_name[]"
                                    placeholder="Manufacturer name" id="manufacturer_name"> --}}
                                <input class=" bg-transparent" type="text" id="search" name="item_code[]"
                                    placeholder="Search" oninput="searchInput(this)">
                                {{-- <input class="bg-transparent" type="text" name="item_code[]" placeholder="Item Code"
                                    id="item_code"> --}}
                                <input class="bg-transparent item-qty"id="item_qty" value="10" type="number"
                                    name="item_qty[]" placeholder="Quantity" oninput="calculateTotal(this)">
                                <input class="bg-transparent item-rate" value="150" type="number" step="0.01"
                                    id="item_rate" name="item_rate[]" class="item-rate" placeholder="Rate"
                                    oninput="calculateTotal(this)">
                                <input class="bg-transparent item-total" type="number" step="0.01" id="item_total"
                                    name="item_total[]" class="item-total" value="1500" placeholder="Total" readonly>
                                <div class="flex items-center overflow-hidden w-full ">
                                    <input class="bg-transparent flex-grow w-3/4" type="text" id = "item_description"
                                        name="item_description[]" value="Example"placeholder="Item Description">
                                    <button
                                        class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full"
                                        onclick="deleteLineItem(this)"> x
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- Line Items Finish Here -->
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded"
                            type="button" onclick="addLineItem()"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>

                        <!-- Labour Items Start Here -->
                        <div id="LabourItemsContainer">
                            <!-- Existing line items go here -->
                            <label class = "text-2xl font-semibold text-gray-900">LABOUR</label>

                            <div
                                class="grid grid-cols-3 sm:grid-cols-5 gap-2 my-2 labour-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                <select class="bg-transparent col-span-1 sm:col-span-1" name="labour_name[]">
                                    <option value="regular_time" selected>Regular Time</option>
                                    <option value="regular_time">Overtime</option>
                                </select>
                                {{-- <input class="bg-transparent" type="text" name="labour_name[]" placeholder="Labour"> --}}
                                <input type="date" name="labour_date[]"
                                    class="bg-transparent col-span-1 sm:col-span-1" placeholder="Date"
                                    value="2024-01-01">
                                <input type="number" step="0.5" name="labour_qty[]"
                                    class="bg-transparent labour-qty col-span-1 sm:col-span-1" placeholder="Quantity"
                                    value="1" oninput="calculateLabour(this)">
                                <input type="number" step="0.01" name="labour_rate[]"
                                    class="bg-transparent labour-rate col-span-1 sm:col-span-1" placeholder="Rate"
                                    oninput="calculateLabour(this)" value="120">
                                <label for="labour_total" class= "block  md:hidden">TOTAL:</label>
                                <div class="flex items-center overflow-hidden w-full ">
                                    <input class="bg-transparent labour-total col-span-1 sm:col-span-1 w-3/4"
                                        type="number" name="labour_total[]" placeholder="Total" value="120"
                                        readonly>
                                    <button
                                        class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full"
                                        onclick="deleteLabourItem(this)"> x
                                    </button>
                                </div>
                            </div>

                        </div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded"
                            type="button" onclick="addLabourItem()"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>


                        <div id="AttachmentsContainer">

                            <label class = "text-2xl font-semibold text-gray-900">ATTACHMENTS</label>

                            <div
                                class=" grid grid-cols-5 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                <input class="bg-transparent col-span-5" type="file" name="attachments">
                            </div>

                        </div>



                        {{-- 


                        <input type="hidden" id="signatureImage" name="signatureImage"> --}}
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"type="button"
                            onclick="submitForm()">SAVE</button>
                    </form>


                    <!-- signaturepad goes here -->
                    {{-- <div class="flex flex-col items-center ">
                        <!-- Signature Pad -->

                        <div
                            class="grid grid-cols-5 w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <canvas id="signatureCanvas" class="col-span-5 border-b-2 border-gray-500 rounded-md"
                                width="400" height="100"></canvas>
                            <input class="bg-transparent" type="text" name="approver_name" placeholder="YOUR NAME">
                        </div>

                        <!-- Buttons Container -->
                        <div class="flex justify-between mt-3 w-full">
                            {{-- <!-- Button 1 (Save as Image) -->
                            <button
                                class="my-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                                onclick="saveCanvasAsImage()">Save as Image</button> --}}

                    <!-- Button 2 (Clear) -->
                    {{-- <button
                                class="my-1 bg-black hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
                                onclick="clearCanvas()">CLEAR</button>
                        </div>
                    </div> --}}

                    <!-- upload attachments goes here -->
                    {{-- <div class="mt-4">
                        <input type="file" id="uploadPhoto" accept="image/*" class="hidden"
                            onchange="previewPhoto(this)">
                        <label for="uploadPhoto"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer">Upload
                            Attachment</label>
                    </div>
                    <div id="photoPreview" class="mt-4"></div>
                    <button onclick="logValues()">Log Values</button> --}}
                </div>



            </div>
        </div>
        <script>
            document.getElementById('date').valueAsDate = new Date();
            var canvas = document.getElementById('signatureCanvas');
            var signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'transparent',
                penColor: 'black',
            });
            // SEARCH FUNCTION 
            function searchInput(element) {

                var lineItem = element.closest('.line-item');

                $(element).autocomplete({


                    source: function(request, response) {
                        var condition = lineItem.querySelector('.manufacturer_name').value;


                        $.ajax({
                            url: "/autocomplete",
                            dataType: "json",
                            data: {
                                query: request.term,
                                condition: condition
                            },
                            success: function(data) {
                                console.log(data);
                                response(data.map(item => item.item_code));
                            }
                        });
                    },
                    minLength: 2, // Minimum characters before triggering autocomplete

                    // appendTo: "#search-results", // ID of the search box
                    open: function(event, ui) {
                        // Set the background color of the autocomplete results
                        $(".ui-autocomplete").css("background-color", "white").css("border", "1px solid #ccc")
                            .css("width", "300px").css("box-shadow", "0px 4px 8px rgba(0, 0, 0, 0.1)").css(
                                "border-radius", " 0 0 8px 8px").css("padding", "10px").css("margin-top", "2px");

                    }

                });
            }

            function saveCanvasAsImage() {
                if (signaturePad.isEmpty()) {
                    alert('Please provide a signature before saving.');
                } else {
                    // Convert canvas content to an image
                    var imageDataURL = canvas.toDataURL('image/png');

                    // Create a link element to trigger the download
                    var downloadLink = document.createElement('a');
                    console.log(downloadLink);
                    downloadLink.href = imageDataURL;
                    downloadLink.download = 'signature.png';

                    // Append the link to the document and trigger the download
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                }
            }
            $(".line-item .item-code").on("input", function() {
                searchInput($(this));
            });

            function clearCanvas() {
                signaturePad.clear();
            }

            function previewPhoto(input) {
                var photoPreview = document.getElementById('photoPreview');
                photoPreview.innerHTML = '';

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var image = document.createElement('img');
                        image.src = e.target.result;
                        image.classList.add('max-w-full', 'max-h-48', 'mt-2', 'rounded');
                        photoPreview.appendChild(image);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function logValues() {
                // Create an object to store the values
                var values = {};

                // Get values from input boxes
                values.date = document.getElementById('date').value;
                values.site_induction_no = document.getElementById('site_induction_no').value;
                values.dayworks_ref_no = document.getElementById('dayworks_ref_no').value;
                values.project_name = document.getElementById('project_name').value;
                values.status = document.getElementById('status').value;
                values.description = document.getElementById('description').value;
                values.site_instruction_no = document.getElementById('site_instruction_no').value;
                values.issued_by = document.getElementById('issued_by').value;

                // Log the values as JSON to the console
                console.log(JSON.stringify(values, null, 2));
            }

            function addLineItem() {
                var container = document.getElementById("lineItemsContainer");
                var newItem = document.createElement("div");
                newItem.className =
                    "grid grid-cols-3 sm:grid-cols-6 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5";
                newItem.innerHTML = `
                <select class="bg-transparent manufacturer_name" name="manufacturer_name[]"
                                    placeholder="Manufacturer name" id="manufacturer_name">
                                    @foreach ($supplier_names as $supplier)
                                        <option value="{{ $supplier->supplier_name }}">
                                            {{ $supplier->supplier_name }}</option>
                                    @endforeach
                                    <option value="other">Other</option>
                                </select>
                                {{-- <input class="bg-transparent" type="text" name="manufacturer_name[]"
                                    placeholder="Manufacturer name" id="manufacturer_name"> --}}
                                <input class="  bg-transparent" type="text" id="search" name="item_code[]"
                                    placeholder="Search" oninput="searchInput(this)">
                                {{-- <input class="bg-transparent" type="text" name="item_code[]" placeholder="Item Code"
                                    id="item_code"> --}}
                                <input class="bg-transparent item-qty"id="item_qty" value="10" type="number"
                                    name="item_qty[]" placeholder="Quantity" oninput="calculateTotal(this)">
                                <input class="bg-transparent item-rate" value="150" type="number" step="0.01"
                                    id="item_rate" name="item_rate[]" class="item-rate" placeholder="Rate"
                                    oninput="calculateTotal(this)">
                                <input class="bg-transparent item-total" type="number" step="0.01" id="item_total"
                                    name="item_total[]" class="item-total" value="1500" placeholder="Total" readonly>
                                <div class="flex items-center overflow-hidden w-full">
                                    <input class="bg-transparent flex-grow w-3/4" type="text" id = "item_description"
                                        name="item_description[]" value="Example"placeholder="Item Description">
                                    <button class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full" onclick="deleteLineItem(this)"> x
                                    </button>
                                </div>
            `;
                container.appendChild(newItem);
            }

            function addLabourItem() {
                var container = document.getElementById("LabourItemsContainer");
                var newItem = document.createElement("div");
                newItem.className =
                    "grid grid-cols-3 sm:grid-cols-5 gap-2 my-2 labour-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5";
                newItem.innerHTML = `
                <select class="bg-transparent" name="labour_name[]">
                                    <option value="regular_time" selected>Regular Time</option>
                                    <option value="regular_time">Overtime</option>
                                </select>
                                {{-- <input class="bg-transparent" type="text" name="labour_name[]" placeholder="Labour"> --}}
                                <input type="date" name="labour_date[]" class="bg-transparent " placeholder="Date"
                                    value="2024-01-01">
                                <input type="number" step="0.01" name="labour_qty[]"
                                    class="bg-transparent labour-qty" placeholder="Quantity" value="1"
                                    oninput="calculateLabour(this)">
                                <input type="number" step="0.01" name="labour_rate[]"
                                    class="bg-transparent labour-rate" placeholder="Rate" oninput="calculateLabour(this)"
                                    value="120">
                                    <label for="labour_total" class= "block  md:hidden">TOTAL:</label>
                                <div class="flex items-center overflow-hidden w-full ">
                                    <input class="bg-transparent labour-total col-span-1 sm:col-span-1 w-3/4"
                                        type="number" name="labour_total[]" placeholder="Total" value="120"
                                        readonly>
                                    <button
                                        class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full"
                                        onclick="deleteLabourItem(this)"> x
                                    </button>
                                </div>
            `;
                container.appendChild(newItem);
            }

            function addSignaturetoForm() {
                // Get the canvas element
                var canvas = document.getElementById('signatureCanvas');

                // Convert canvas content to an image data URL
                var imgDataUrl = canvas.toDataURL('image/png');

                // Update the hidden input field with the image data URL
                document.getElementById('signatureImage').value = imgDataUrl;

                submitForm();
            }

            function submitForm() {
                var form = document.getElementById("myForm");
                // You can add any additional validation here before submitting


                // Submit the form
                form.submit();
            }

            function calculateTotal(element) {
                var lineItem = element.closest('.line-item');
                var itemRate = parseFloat(lineItem.querySelector('.item-rate').value) || 0;
                var quantity = parseFloat(lineItem.querySelector('.item-qty').value) || 0;

                // Calculate the total amount
                var totalAmount = itemRate * quantity;

                // Update the total amount field for the current line item
                lineItem.querySelector('.item-total').value = totalAmount.toFixed(2);
            }

            function calculateLabour(element) {
                var labourItem = element.closest('.labour-item');
                var labourRate = parseFloat(labourItem.querySelector('.labour-rate').value) || 0;
                var labourQty = parseFloat(labourItem.querySelector('.labour-qty').value) || 0;

                // Calculate the total amount
                var totalAmount = labourRate * labourQty;

                // Update the total amount field for the current line item
                labourItem.querySelector('.labour-total').value = totalAmount.toFixed(2);
            }

            function deleteLineItem(button) {
                event.preventDefault();
                // Get the parent div of the button (the entire line item)
                var lineItemDiv = button.parentNode.parentNode;

                // Get the parent container of all line items
                var lineItemsContainer = document.getElementById('lineItemsContainer');

                // Check if the line item div and container exist
                if (lineItemDiv && lineItemsContainer) {

                    var lineItemDivs = lineItemsContainer.getElementsByClassName('line-item');
                    if (lineItemDivs.length > 1) {
                        // More than one line item, proceed with deletion
                        lineItemsContainer.removeChild(lineItemDiv);
                    } else {
                        // Only one line item, show message or handle accordingly
                        console.log("Can't delete. At least one line item must be present.");
                    }
                } else {
                    console.log('Line item or container not found.');
                }
            }

            function deleteLabourItem(button) {
                event.preventDefault();
                // Get the parent div of the button (the entire line item)
                var lineItemDiv = button.parentNode.parentNode;

                // Get the parent container of all line items
                var lineItemsContainer = document.getElementById('LabourItemsContainer');

                // Check if the line item div and container exist
                if (lineItemDiv && lineItemsContainer) {

                    var lineItemDivs = lineItemsContainer.getElementsByClassName('labour-item');
                    if (lineItemDivs.length > 1) {
                        // More than one line item, proceed with deletion
                        lineItemsContainer.removeChild(lineItemDiv);
                    } else {
                        // Only one line item, show message or handle accordingly
                        console.log("Can't delete. At least one line item must be present.");
                    }
                } else {
                    console.log('Line item or container not found.');
                }
            }

            function populateFields() {
                // Function to generate a random string
                function generateRandomString(length) {
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    let result = '';
                    for (let i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() * characters.length));
                    }
                    return result;
                }

                // Populate fields with random data
                document.getElementById('manufacturer_name').value = generateRandomString(8);
                document.getElementById('item_code').value = generateRandomString(8);
                document.getElementById('item_qty').value = Math.floor(Math.random() * 1000);
                document.getElementById('item_rate').value = Math.random() * 100;
                document.getElementById('item_total').value = Math.random() > 0.5 ? 'True' : 'False';
                document.getElementById('item_description').value = generateRandomString(12);
            }
        </script>
    @endsection
