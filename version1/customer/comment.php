<?php 
include '../_base.php';
include '../include/header.php'; 


?>

<link rel="stylesheet" href="../css/comment.css">
</head>

<body>
    <div class="custRateContainer">
        <h1>Rate product</h1>
        <p>
            Pen

        </p>
        <form action="/PlayTime/userCommentServlete" method="post" onsubmit="return checkInput()">
            <div class="productQuality">
                <p><br><br><br><br>Please Rate :</p>
                <div class="rating">
                    <input type="radio" name="rating" id="rate1" value="5" onclick="showGrade(5)">
                    <label for="rate1"></label>
                    <input type="radio" name="rating" id="rate2" value="4" onclick="showGrade(4)">
                    <label for="rate2"></label>
                    <input type="radio" name="rating" id="rate3" value="3" onclick="showGrade(3)">
                    <label for="rate3"></label>
                    <input type="radio" name="rating" id="rate4" value="2" onclick="showGrade(2)">
                    <label for="rate4"></label>
                    <input type="radio" name="rating" id="rate5" value="1" onclick="showGrade(1)">
                    <label for="rate5"></label>
                    <br>
                </div>
                <p id="ratingText"></p>

               

                <script>
                    function showGrade(value) {
                        var ratingText = "";
                        switch (value) {
                            case 1:
                                ratingText = "Poor";
                                break;
                            case 2:
                                ratingText = "Fair";
                                break;
                            case 3:
                                ratingText = "Average";
                                break;
                            case 4:
                                ratingText = "Good";
                                break;
                            case 5:
                                ratingText = "Excellent";
                                break;
                            default:
                                ratingText = "";
                                break;
                        }
                        document.getElementById("ratingText").innerText = ratingText;
                    }
                </script>
            </div>
            <br><br>
            <label for="photo">Product Photo:</label><br>
                    <label class="upload" tabindex="0">
                        <?= html_file('photo', 'image/*', 'hidden') ?>
                        <img src="../images/photo.jpg" width="100" height="100">
                    </label>
                    <?= err('photo') ?>
                    <br>
                    
            <div class="inputBox">
                <br>
                <textarea name="commentText" id="commentText" placeholder="Enter your comment here"></textarea>
                <div class="submitContainer">
                    <input type="reset" name="reset" value="Reset" id="reset">
                    <input type="submit" name="submit" value="Submit" id="submit">
                
                </div>
            </div>
        </form>
    </div>
    </div>

    <script>
        function checkInput() {
            var rate = document.querySelector('input[name="rating"]:checked');
            var comment = document.getElementById('commentText').value;

            if (!rate || comment.trim() === "") {
                alert("Dear customer, you can't submit the comment without any input");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>