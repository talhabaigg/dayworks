<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoComplete Search</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <select id="conditionDropdown">
        <option value="AAH">Search by Item Code</option>

    </select>
    <input type="text" id="search" placeholder="Search">
    <div id="item_list"></div>

    <script>
        $(document).ready(function() {
            $("#search").autocomplete({

                source: function(request, response) {
                    var condition = $("#conditionDropdown").val();
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
                appendTo: "#search-results", // ID of the search box
            });
        });
    </script>


</body>

</html>
