<?php include 'common/header.php'; ?>
    <div class="container mt-5">
        <h2>Upload a File</h2>
        <form action="upload_processor.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileUpload" class="form-label">Choose file:</label>
                <input type="file" class="form-control" id="fileUpload" name="fileUpload" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                const fileInput = document.getElementById('fileUpload');
                const filePath = fileInput.value;
                const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)$/i;
                
                if (!allowedExtensions.exec(filePath)) {
                    alert('Invalid file type, only JPG, JPEG, PNG, GIF, and PDF are allowed.');
                    fileInput.value = ''; // Clear the input
                    event.preventDefault(); // Prevent the form from being submitted
                }
            });
        });
    </script>
</html>
