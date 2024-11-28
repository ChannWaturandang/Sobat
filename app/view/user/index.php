<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .form-container {
            flex: 1;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }

        .table-container {
            flex: 1;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: auto;
            max-height: 600px;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 500;
        }

        .form-control {
            border-radius: 5px;
            height: 35px;
            font-size: 14px;
        }

        .btn {
            border-radius: 5px;
            height: 35px;
            font-size: 14px;
        }

        .btn-search {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }

        .btn-search:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #ffffff;
        }

        .btn-add {
            background-color: #28a745;
            border-color: #28a745;
            color: #ffffff;
        }

        .btn-add:hover {
            background-color: #218838;
            border-color: #218838;
            color: #ffffff;
        }

        .btn-save {
            background-color: #007bff;
            border-color: #007bff;
            color: #ffffff;
        }

        .btn-save:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #ffffff;
        }

        .btn-reset {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #ffffff;
        }

        .btn-reset:hover {
            background-color: #5a6268;
            border-color: #545b62;
            color: #ffffff;
        }

        /* Added styles for the table */
        .table {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
            color: #000000;
        }

        .table th {
            background-color: #f2f2f2;
        }

        /* Box shadow for the header container */
        .header-container {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
            width: 100%;
        }

        /* Adding styles for the sales number and date */
        .sales-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .modal-dialog {
            max-width: 80%;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-body {
            max-height: 300px;
            overflow-y: auto;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Container -->
        <div class="header-container">
            <h1>Form Penjualan</h1>
            <div class="sales-info">
                <div>Nomor Penjualan: <span id="salesNumber">001</span></div>
                <div>Tanggal: <span id="currentDate"></span></div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <h2 class="mb-4 text-center">Payment and Purchase Form</h2>

            <!-- Drug Search and Modal Trigger -->
            <div class="form-group">
                <label for="drugSearch">Search Drug</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="drugSearch" placeholder="Search drug...">
                    <button data-bs-toggle="modal" data-bs-target="#drugModal" class="btn btn-search" type="button" id="btnSearch"><i class="fas fa-search"></i></button>
                </div>
            </div>

            <!-- Drug Name Input -->
            <div class="form-group">
                <label for="drugName">Nama Obat</label>
                <input type="text" class="form-control" id="drugName" readonly>
            </div>

            <!-- Price Input -->
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price" readonly>
            </div>

            <!-- Unit Input -->
            <div class="form-group">
                <label for="unit">Unit</label>
                <input type="number" class="form-control" id="unit" readonly>
            </div>

            <!-- Satuan Input -->
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" id="satuan" readonly>
            </div>

            <!-- Total Price -->
            <div class="form-group">
                <label for="totalPrice">Total Harga</label>
                <input type="number" class="form-control" id="totalPrice" readonly>
            </div>

            <!-- Buttons -->
            <div class="form-group text-center">
                <button type="button" class="btn btn-reset mx-2" id="btnReset">Reset</button>
                <button type="button" class="btn btn-add mx-2" id="btnAdd">Add</button>
                <button type="button" class="btn btn-save mx-2" id="btnSave">Save</button>
            </div>
        </div>

        <!-- Table Container for Transaction History -->
        <div class="table-container">
            <h2 class="mb-4 text-center">Transaction History</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Total Harga</th>
                    </tr>
                </thead>
                <tbody id="transactionTable">
                    <tr>
                        <td>1</td>
                        <td>Paracetamol</td>
                        <td>Rp.10.000</td>
                        <td>2</td>
                        <td>Tablet</td>
                        <td>Rp.20.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Drug Selection -->
    <div class="modal fade" id="drugModal" tabindex="-1" aria-labelledby="drugModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="drugModalLabel">Select Drug</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="drugList" class="list-group">
                        <!-- Drug items will be populated here dynamically -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNlMnx6MC32uwc8UB5xJm8JOSNxt47/5ZR6Acd/7llvX+Zm5O7WAE59RxVHYV1y" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGkQ6hJ6Aual60e8CkyayLR1EoS7pr7PPl3ywFj8jLxr2+I7HVa3w8eKk8E" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentDate = new Date().toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('currentDate').innerText = currentDate;

            const btnAdd = document.getElementById('btnAdd');
            const btnSave = document.getElementById('btnSave');
            const btnReset = document.getElementById('btnReset');
            const drugSearch = document.getElementById('drugSearch');
            const drugName = document.getElementById('drugName');
            const price = document.getElementById('price');
            const unit = document.getElementById('unit');
            const satuan = document.getElementById('satuan');
            const totalPrice = document.getElementById('totalPrice');

            btnAdd.addEventListener('click', function () {
                const table = document.getElementById('transactionTable');
                const newRow = table.insertRow();

                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                const cell4 = newRow.insertCell(3);
                const cell5 = newRow.insertCell(4);
                const cell6 = newRow.insertCell(5);

                cell1.innerText = table.rows.length;
                cell2.innerText = drugName.value;
                cell3.innerText = price.value;
                cell4.innerText = unit.value;
                cell5.innerText = satuan.value;
                cell6.innerText = totalPrice.value;

                // Reset form inputs after adding the row
                drugSearch.value = '';
                drugName.value = '';
                price.value = '';
                unit.value = '';
                satuan.value = '';
                totalPrice.value = '';
            });

            btnSave.addEventListener('click', function () {
                alert('Data has been saved.');
            });

            btnReset.addEventListener('click', function () {
                drugSearch.value = '';
                drugName.value = '';
                price.value = '';
                unit.value = '';
                satuan.value = '';
                totalPrice.value = '';
            });

            const drugList = [
                { name: 'Paracetamol', price: 10000, satuan: 'Tablet' },
                { name: 'Amoxicillin', price: 15000, satuan: 'Kapsul' },
                { name: 'Ibuprofen', price: 20000, satuan: 'Tablet' },
                { name: 'Metformin', price: 5000, satuan: 'Tablet' },
                { name: 'Aspirin', price: 12000, satuan: 'Tablet' }
            ];

            const drugListElement = document.getElementById('drugList');
            drugList.forEach(drug => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                listItem.innerText = `${drug.name} - Rp.${drug.price} per ${drug.satuan}`;
                listItem.addEventListener('click', () => {
                    drugName.value = drug.name;
                    price.value = drug.price;
                    satuan.value = drug.satuan;
                    totalPrice.value = price.value * unit.value;
                    document.querySelector('#drugModal .btn-close').click();
                });
                drugListElement.appendChild(listItem);
            });

            unit.addEventListener('input', function () {
                totalPrice.value = price.value * unit.value;
            });
        });
    </script>
</body>

</html>
