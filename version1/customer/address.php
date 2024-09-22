<?php




?>

<title>My Addresses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .header {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: white;
            border-bottom: 1px solid #ddd;
        }
        .header i {
            font-size: 24px;
            color:  #292a2a;
            margin-right: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
        }
        .content {
            padding: 20px;
        }
        .address-section {
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .address-section h2 {
            font-size: 16px;
            margin: 0 0 10px 0;
            color: #888;
        }
        .address-item {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .address-item h3 {
            font-size: 16px;
            margin: 0;
            display: inline-block;
        }
        .address-item span {
            font-size: 16px;
            color: #888;
            margin-left: 10px;
        }
        .address-item p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }
        .default-badge {
            display: inline-block;
            padding: 2px 8px;
            border: 1px solid #292a2a;
            color:  #292a2a;
            border-radius: 3px;
            font-size: 12px;
            margin-top: 5px;
        }
        .add-address {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            background-color: white;
            border-radius: 5px;
            border: 1px solid  #292a2a;
            color:  #292a2a;
            font-size: 16px;
            cursor: pointer;
        }
        .add-address i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <i class="fas fa-arrow-left"></i>
        <h1>My Addresses</h1>
    </div>
    <div class="content">
        <div class="address-section">
            <h2>Address</h2>
            <div class="address-item">
                <h3>Chong Sha...</h3>
                <span>(+60) 18-918 6372</span>
                <p>Unit B-9-12, B0912 Plaza Metro Prima Jalan Metro 1<br>
                Kepong 52100 Kuala Lumpur<br>
                W.P. Kuala Lumpur, W.P. Kuala Lumpur, 52100</p>
                <div class="default-badge">Default</div>
            </div>
        </div>
        <div class="add-address">
            <i class="fas fa-plus-circle"></i>
            <span>Add New Address</span>
        </div>
    </div>
</body>
</html>