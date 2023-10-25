<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Final Certificate</title>
<style>
    body{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 14px;
    }
</style>
</head>
<body style="size: 20px">
 <div class="content">
   @include('view.form.form_header')

    <main>
    <div class="container-b mx-5 px-4 pt-4">
            <div style="font-size: 18px" class="text-center fw-bold">CERTIFICATION</div>

            <div class="mt-5 ">This is to certify that the study protocol with the title <span class="fw-bold">"{{ $protocols->title }}”</span> has been reviewed and approved by Ethics Review Board of Adamson University-Manila, Philippines.</div>
            <div class="mt-4 ">This certification is issued to the proponent for whatever scientific purposes it may serve him/her.</div>
        </div>

       
        <div class="container-signatures mt-3" style="margin-left: 70px; font-size: 13px">
            <div>Certified by:</div>
                <input type="file" id="imageInput" style="position: absolute">
                <img id="selectedImage" style="width: 260px; height: 130px;">
                <div style="border: 1px solid black; width: 300px"></div>
                <div style="line-height: 130%">
                    <input type="text" class="mt-2" style="width: 300px" id="inputElement" placeholder="Please insert name and press ENTER.">
                    <div class="mt-1 fw-bold" id="resultElement"></div>
                    <div class="mt-1">UERC Secretariat</div>
                    <div>Center for Research and Development</div>
                    <div>Adamson University</div>
                    <div>{{ date('M d, Y', strtotime($protocols->final_decision_access)) }}</div>
                </div>
            <div class="mt-5 pt-2">Noted by:</div>
            <input type="file" id="imageInput1" style="position: absolute">
                <img id="selectedImage1" style="width: 260px; height: 130px;">
                <div style="border: 1px solid black; width: 300px"></div>
                <div style="line-height: 130%">
                    <input type="text" class="mt-2" style="width: 300px" id="inputElement1" placeholder="Please insert name and press ENTER.">
                    <div class="mt-1 fw-bold" id="resultElement1"></div>
                    <div class="mt-1">UERC Chairperson</div>
                    <div>Center for Research and Development</div>
                    <div>Adamson University</div>
                    <div>{{ date('M d, Y', strtotime($protocols->final_decision_access)) }}</div>
                </div>

                
        </div>
        <div class="container-f px-5 mx-3 d-flex justify-content-between" style="margin-top: 65px">
            <div style="font-size: 12px">F-CRD-UERC Form No.030 Certification of Approval of Protocols</div>
            <div style="font-size: 14px">Page <span class="fw-bold">1</span> of <span class="fw-bold">1</span></div>
    </div>
      
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
            filename:     'final certificate',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(element).set(opt).save()
    }

const inputElement = document.getElementById("inputElement");

// Get the result element by its id
const resultElement = document.getElementById("resultElement");

// Add a keypress event listener to the input element
inputElement.addEventListener("keypress", function(event) {
    // Check if the key pressed is the Enter key (keyCode 13)
    if (event.keyCode === 13) {
        // Trigger your action here
       
        resultElement.textContent = inputElement.value;
        inputElement.style.display = 'none'
    }
});

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









const inputElement1 = document.getElementById("inputElement1");

// Get the result element by its id
const resultElement1 = document.getElementById("resultElement1");

// Add a keypress event listener to the input element
inputElement1.addEventListener("keypress", function(event) {
    // Check if the key pressed is the Enter key (keyCode 13)
    if (event.keyCode === 13) {
        // Trigger your action here
       
        resultElement1.textContent = inputElement1.value;
        inputElement1.style.display = 'none'
    }
});
    const imageInput1 = document.getElementById("imageInput1");
    const selectedImage1 = document.getElementById("selectedImage1");

    // Add an event listener to the input element
    imageInput1.addEventListener("change", function() {
        // Check if a file was selected
        if (imageInput1.files && imageInput1.files[0]) {
            const reader = new FileReader();

            // Set up a callback function to run when the image has been loaded
            reader.onload = function(e) {
                // Display the selected image
                selectedImage1.src = e.target.result;
                selectedImage1.style.display = "block";
            };

            // Read the selected image as a data URL
            reader.readAsDataURL(imageInput1.files[0]);
            imageInput1.style.display = 'none'
        }
});
</script>
</html>