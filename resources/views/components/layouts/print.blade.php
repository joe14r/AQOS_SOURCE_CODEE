<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
    	.order-details {
	margin: 0 auto;
	width: 30%;
}
        @media print {
            /* Use a monospaced font for better alignment */
            body {
                font-family: "Courier New", monospace;
                font-size: 12px;
            }

            /* Remove unnecessary margins and padding */
            .order-details {
                margin: 0;
                padding: 0;
            }

            h2, h3 {
                font-size: 16px;
                text-align: center;
            }

            .order-info,
            .order-status,
            .order-items {
                margin-bottom: 10px;
            }

            .order-info p,
            .order-status p,
            .order-items p {
                margin: 5px 0;
            }

            .status-btn {
                margin-right: 5px;
                font-weight: bold;
            }

            /* Order items table styling for better alignment */
            .items-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            .items-table th,
            .items-table td {
                text-align: left;
                padding: 3px;
                font-size: 12px;
                border-bottom: 1px solid #000;
            }

            .items-table th {
                font-weight: bold;
            }

            /* Footer for Grand Total */
            .items-table tfoot {
                font-weight: bold;
            }

            .items-table tfoot td {
                border-top: 2px solid #000;
            }

            /* Ensuring everything fits within the POS width */
            .order-details {
                width: 100%;
                max-width: 500px; /* Max width for better printability */
                margin: auto;
            }

            .order-items {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

{{ $slot }}

<!-- Print button to trigger the print functionality -->
<!-- <button onclick="window.print()">Print Order</button> -->
<script>
    // Automatically trigger the print dialog as soon as the page is fully loaded
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>