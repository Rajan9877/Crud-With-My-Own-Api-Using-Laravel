<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload Using Api</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .container{
            text-align: center;
        }
        .fileinput{
            margin-left: 100px;
        }
        .message{
            position: fixed;
            top: 5px;
            right: 5px;
            background-color: red;
            padding: 10px 15px;
            color: white;
            border-radius: 50px;
            display: none;
        }
    </style>
  </head>
  <body>
    <div class="message">
    </div>
    <div class="container">
        <h3>File Upload Using API</h3>
        <form id="uploadForm">
            <label for="file">Upload Your File</label>
            <div class="fileinput">
                <input type="file" id="fileInput">
            </div>
            <button type="submit" class="btn btn-dark my-2 btn-sm">Upload</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const uploadForm = document.getElementById("uploadForm");
        const fileInput = document.getElementById("fileInput");
    
        uploadForm.addEventListener("submit", function (e) {
            e.preventDefault();
    
            // Create a FormData object
            const formData = new FormData();
    
            // Append the selected file to the FormData
            formData.append("file", fileInput.files[0]);
    
            // Send a POST request with Fetch
            fetch("http://localhost:8000/api/fileupload", {
                method: "POST",
                body: formData,
            })
                .then((response) => {
                    if (response.ok) {
                        // File successfully uploaded
                        // console.log("File uploaded successfully!");
                        $('.message').html("File Uploaded Successfully!");
                        $('.message').fadeIn();
                        setTimeout(() => {
                            $('.message').fadeOut();
                        }, 3000);
                    } else {
                        // Handle the error response
                        console.error("File upload failed.");
                    }
                })
                .catch((error) => {
                    console.error("Error: " + error);
                });
        });
    });
    </script>
  </body>
</html>