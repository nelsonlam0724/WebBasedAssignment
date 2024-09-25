<?php ?>


<body>
    <html>

    <head>
        <title>New Address</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }

            .container {
                padding: 20px;
            }

            .header {
                display: flex;
                align-items: center;
                padding: 10px;
                background-color: #fff;
                border-bottom: 1px solid #ddd;
            }

            .header i {
                color: #ff4500;
                font-size: 24px;
                margin-right: 10px;
            }

            .header h1 {
                font-size: 20px;
                margin: 0;
            }

            .section {
                background-color: #fff;
                padding: 15px;
                margin-top: 10px;
                border: 1px solid #ddd;
            }

            .section h2 {
                font-size: 14px;
                color: #888;
                margin: 0 0 10px 0;
            }

            .input-group {
                margin-bottom: 15px;
            }

            .input-group input {
                width: 100%;
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .input-group a {
                display: block;
                padding: 10px;
                font-size: 16px;
                color: #888;
                text-decoration: none;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .settings {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .settings label {
                font-size: 16px;
            }

            .settings .toggle {
                position: relative;
                width: 40px;
                height: 20px;
                background-color: #ddd;
                border-radius: 10px;
                cursor: pointer;
            }

            .settings .toggle::after {
                content: '';
                position: absolute;
                width: 18px;
                height: 18px;
                background-color: #fff;
                border-radius: 50%;
                top: 1px;
                left: 1px;
                transition: 0.3s;
            }

            .settings .toggle.active {
                background-color: #ff4500;
            }

            .settings .toggle.active::after {
                left: 21px;
            }

            .buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .buttons button {
                width: 48%;
                padding: 10px;
                font-size: 16px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            .buttons .submit {
                background-color: #ddd;
                color: #fff;
            }

            #maps {
                width: 100%;
                height: 30%;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <i class="fas fa-arrow-left"></i>
                <h1>New Address</h1>
            </div>
            <div class="section">
                <h2>Contact</h2>
                <div class="input-group">
                    <input type="text" placeholder="Full Name">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="Phone Number">
                </div>
            </div>
            <div class="section">

                <h2>Address</h2>

                <div id="maps" style="border:1px solid black"></div>
                <br>
                <div class="input-group">
                    <input type="text" id="city" placeholder="City">
                </div>
                <div class="input-group">
                    <input type="text" id="state" placeholder="State">
                </div>
                <div class="input-group">
                    <input type="text" id="postal_code" placeholder="Postal Code">
                </div>
                <div class="input-group">
                    <input type="text" id="street" placeholder="Detailed Address">
                </div>

            </div>
            <div class="section">
                <h2>Settings</h2>
               
                <div class="settings">
                    <label>Set as Default Address</label>
                    <div class="toggle"></div>
                </div>
            </div>
            <div class="buttons">
                <button class="submit">Submit</button>
            </div>
        </div>
        <script>
            document.querySelector('.toggle').addEventListener('click', function() {
                this.classList.toggle('active');
            });
        </script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="js/map.js"></script>
    </body>

    </html>
</body>

</html>