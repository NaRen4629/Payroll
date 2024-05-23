<!-- <php
// Retrieve the request_id from the URL
$request_id = $_GET['request_id'];

// Include your database connection
include 'config/connection.php';

// Use a JOIN query to fetch data from both tables
$sql = "SELECT t1.request_id, t1.Request_No, t2.item_id, t2.Item, t2.Unit_Price, t2.Quantity, t2.Uom, t2.Price, t2.Total_Price
        FROM tbl_request t1
        LEFT JOIN tbl_request_item t2 ON t1.request_id = t2.request_id
        WHERE t1.request_id = :request_id";

// Prepare and execute the query
$statement = $db->prepare($sql);
$statement->bindParam(':request_id', $request_id, PDO::PARAM_INT);
$statement->execute();

// Fetch the result
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

?> -->


<div class="modal fade" id="viewRequest_<?php echo $Request['request_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="modalContent_<?php echo $Request['request_id']; ?>">
                <!-- Content will be loaded here -->

                twzsfa
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-success" name="approveRequest" data-request-id="<?php echo $Request['request_id']; ?>">Approve</button>
                <button type="button" class="btn btn-sm btn-danger" name="rejectRequest" data-request-id="<?php echo $Request['request_id']; ?>">Reject</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        // Trigger the modal when a button is clicked
        $('[data-toggle="modal"]').click(function () {
            var request_id = $(this).data('request-id'); // Retrieve the request_id

            $('#viewRequest_' + request_id).modal('show');

            // Load content based on request_id using AJAX
            $.ajax({
    type: 'POST',
    url: 'crud-operation.php',
    data: { request_id: request_id },
    dataType: 'json', // Specify that you expect JSON response
    success: function (data) {
        // Process the JSON data and display it in your modal
        var modalContent = $('#modalContent_' + request_id);
        modalContent.empty(); // Clear existing content

        if (data.length > 0) {
            var html = '<table>'; // Create an HTML table for the data
            // Populate the table with data from the JSON response
            html += '<tr><th>Request No</th><th>Item</th><th>Unit Price</th><th>Quantity</th><th>UOM</th><th>Price</th><th>Total Price</th></tr>';
            for (var i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td>' + data[i].Request_No + '</td>';
                html += '<td>' + data[i].Item + '</td>';
                html += '<td>' + data[i].Unit_Price + '</td>';
                html += '<td>' + data[i].Quantity + '</td>';
                html += '<td>' + data[i].Uom + '</td>';
                html += '<td>' + data[i].Price + '</td>';
                html += '<td>' + data[i].Total_Price + '</td>';
                html += '</tr>';
            }
            html += '</table>';
            modalContent.append(html);
        } else {
            modalContent.html('No data found.');
        }
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.log("AJAX Error: " + errorThrown);
    }
});

        });
    });
</script>
