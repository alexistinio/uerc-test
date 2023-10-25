<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>NON-DISCLOSURE AND CONFIDENTIALITY AGREEMENT</title>
<style>
    .container-b div, .container-signatures div, .container-f div{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 14px;
    }
</style>
</head>
<body>
 <div class="content">
   @include('view.form.form_header')

    <main>
    <div class="container-b pt-5 px-4 mx-5">
            <div class="text-center fw-bold">NON-DISCLOSURE AND CONFIDENTIALITY AGREEMENT</div>
            <div class="mt-5">I, {{ $protocols->primary_reviewer }}, agree that any information pertinent to the protocol entrusted to me shall be considered proprietary and confidential.  The information shall be used for evaluation purposes only and shall not be duplicated, distributed, disseminated nor given out to anybody without permission unless authorized by the UERC and the proponent of the protocol. I understand that unauthorized disclosure could cause harm and significant damage to the proponent. Further, I agree that upon request, I shall return all written and electronic files of the protocol forwarded to me.
            </div>
            <div class="mt-4">Confidential information shall not include information previously known to me, the general public, or previously recognized as standard practice in the field.</div>
        </div>

        <div class="container-signatures" style="margin: 180px 0 0 70px">
            <div class="fw-bold">CONFORME,</div>
            <input type="file" id="imageInput" style="position: absolute">
            <img id="selectedImage" style="width: 260px; height: 130px;">
                <div style="border: 1px solid black; width: 300px"></div>
                <div style="line-height: 130%">
                    <div class="mt-1 fw-bold">{{ $protocols->primary_reviewer }}</div>
                    <div class="mt-1">{{ $protocols->user->role=='Admin' ? 'UERC' : $protocols->user->colleges.', '.'CERC' }}</div>
                    <div>{{ date('M d, Y', strtotime($protocols->date_of_receipt)) }}</div>
            
                </div>
        </div>

        <div class="container-f d-flex justify-content-between px-4 mx-5" style="margin-top: 140px">
            <div style="font-size: 12px">F-CRD-UERC Form No. 008 Non-Disclosure and Confidentiality Agreement</div>
            <div style="font-size: 14px">Page <span class="fw-bold">1</span> of <span class="fw-bold">1</span></div>
        </div>
    </main>
</div>
<div class="d-flex justify-content-center">
  <button style="height: 60px; width: 170px" class="btn btn-outline-secondary mt-3 mx-4 mb-5" onclick="history.back()">Back</button>
  <button style="height: 60px; width: 170px" class="btn btn-primary mt-3 mb-5" onclick="generatePDF()">Download</button>
</div>

</body>
<script>
    function generatePDF(){
        const element = document.querySelector('.content');
        var opt = {
            margin:0,
            filename:     'ndc agreement.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(element).set(opt).save()
    }

    const inputElement = document.getElementById("inputElement");

// Get the result element by its id
const resultElement = document.getElementById("resultElement");



// Get the input element and the image element
    const imageInput = document.getElementById("imageInput");
    const selectedImage = document.getElementById("selectedImage");

    // Add an event listener to the input element
    imageInput.addEventListener("change", function() {
        // Check if a file was selected
        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();

            // Set up a callback function to run when the image has been loaded
            reader.onload = function(e) {
                // Display the selected image
                selectedImage.src = e.target.result;
                selectedImage.style.display = "block";
            };

            // Read the selected image as a data URL
            reader.readAsDataURL(imageInput.files[0]);
            imageInput.style.display = 'none'
        }
});
</script>
</html>