@extends('layout3')

@section('content')
    <div class="container mx-auto mb-2 p-1">
        <div id="loading-overlay"
            class="fixed top-0 left-0 w-full h-full bg-white bg-opacity-70 flex justify-center items-center hidden z-50">
            <div class="border-t-4 border-blue-500 border-solid rounded-full h-12 w-12 animate-spin"></div>
        </div>
        <div class="flex flex-wrap">

            <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6  sm:p-6 md:p-8 ">

                <div class="mb-4">

                    <h1
                        class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-teal-500 text-4xl font-black">
                        CREATE NEW MATERIAL REQ</h1>
                    <form id="myForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- header Container starts here -->
                        <div class="grid grid-col-1 sm:grid-cols-2 gap-2">

                            <div>
                                <label for="date_required" class="text-left block text-sm font-medium text-gray-700">Date
                                    Required</label>
                                <input type="date" id="date_required" name="date_required"
                                    class="w-full  ml-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                    value="">
                            </div>
                            <div>
                                <label for="supplier_name" class="block text-sm font-medium text-gray-700">Supplier
                                    Name</label>
                                <input type="text" id="supplier_name" name="supplier_name"
                                    value="Rondo"class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="delivery_contact" class="block text-sm font-medium text-gray-700">Delivery
                                    Contact</label>
                                <input type="text" id="delivery_contact" name="delivery_contact"
                                    value=""class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="pickup_contact" class="block text-sm font-medium text-gray-700">Pickup
                                    Contact</label>
                                <input type="text" id="pickup_contact" name="pickup_contact"
                                    value=""class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="deliver_to" class="block text-sm font-medium text-gray-700">Deliver To
                                </label>
                                <input type="text" id="deliver_to" name="deliver_to"
                                    value=""class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div>
                                <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name
                                </label>
                                <input type="text" id="project_name" name="project_name"
                                    value=""class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            </div>
                            <div class="col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                <textarea id="notes" name="notes" rows="2"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"></textarea>
                            </div>
                        </div>

                        <div id="lineItemsContainer">

                            <label class = "text-2xl font-semibold text-gray-900">MATERIAL</label>
                            <div
                                class="grid grid-cols-4 sm:grid-cols-7 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 shadow ">

                                <input class="  bg-transparent" type="text" id="search" name="item_code[]"
                                    placeholder="Search Item Code" oninput="searchInput(this)">
                                <input class="bg-transparent flex-grow w-full item_description col-span-2" type="text"
                                    id = "item_description" name="item_description[]"
                                    value="Example"placeholder="Item Description" readonly>
                                <input class="bg-transparent item-qty"id="item_qty" value="1" type="number"
                                    name="item_qty[]" placeholder="Quantity" oninput="calculateTotal(this)">
                                <input class="bg-transparent item-rate" value="150" type="number" step="0.01"
                                    id="item_rate" name="item_rate[]" class="item-rate" placeholder="Rate"
                                    oninput="calculateTotal(this)">
                                <input class="bg-transparent item-total" type="number" step="0.01" id="item_total"
                                    name="item_total[]" class="item-total" value="1500" placeholder="Total" readonly>

                                <div class="flex items-center overflow-hidden w-full ">
                                    <button
                                        class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full ml-auto"
                                        onclick="deleteLineItem(this)"> x
                                    </button>

                                </div>
                            </div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded" type="button"
                            onclick="addLineItem()"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <br>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-2 rounded"type="button"
                            onclick="submitForm()">CREATE PDF</button>
                    </form>
                </div>
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
                    var condition = document.getElementById('supplier_name').value;


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

                },
                select: function(event, ui) {
                    var selectedItemCode = ui.item.value;

                    // Make another AJAX call to get the full row data based on the selectedItemCode
                    $.ajax({
                        url: "/getItemDetails", // Replace with your actual endpoint
                        dataType: "json",
                        data: {
                            item_code: selectedItemCode
                        },
                        success: function(itemDetails) {

                            // Assuming you have fields in your HTML, update their values.
                            $(lineItem).find('.item_description').val(itemDetails.item_description);

                            // Add more lines as needed for other fields
                        }
                    });
                }
            });
        }




        function addLineItem() {
            var container = document.getElementById("lineItemsContainer");
            var newItem = document.createElement("div");
            newItem.className =
                "grid grid-cols-4 sm:grid-cols-7 gap-2 my-2 line-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 shadow ";
            newItem.innerHTML = `
           
                                <input class="  bg-transparent" type="text" id="search" name="item_code[]"
                                    placeholder="Search Item Code" oninput="searchInput(this)">
                                <input class="bg-transparent flex-grow w-full item_description col-span-2" type="text"
                                    id = "item_description" name="item_description[]"
                                    value="Example"placeholder="Item Description">
                                <input class="bg-transparent item-qty"id="item_qty" value="1" type="number"
                                    name="item_qty[]" placeholder="Quantity" oninput="calculateTotal(this)">
                                <input class="bg-transparent item-rate" value="150" type="number" step="0.01"
                                    id="item_rate" name="item_rate[]" class="item-rate" placeholder="Rate"
                                    oninput="calculateTotal(this)">
                                <input class="bg-transparent item-total" type="number" step="0.01" id="item_total"
                                    name="item_total[]" class="item-total" value="1500" placeholder="Total" readonly>

                                <div class="flex items-center overflow-hidden w-full ">
                                    <button
                                        class="w-6 h-6 bg-blue-500 hover:bg-blue-700 text-white text-center font-bold  rounded-full ml-auto"
                                        onclick="deleteLineItem(this)"> x
                                    </button>

                                </div>
                       
                            
        `;
            container.appendChild(newItem);
        }

        function submitForm() {
            var form = document.getElementById("myForm");
            var loadingOverlay = document.getElementById("loading-overlay");

            // Show loading overlay
            loadingOverlay.style.display = "flex";

            // Simulate delay (you can remove this in a real scenario)
            setTimeout(function() {
                // Submit the form
                form.submit();

                // Hide loading overlay after form submission (you can adjust this timing)
                setTimeout(function() {
                    loadingOverlay.style.display = "none";
                }, 500);
            }, 2000); // Simulated delay of 2 seconds (adjust as needed)
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
    </script>
@endsection
