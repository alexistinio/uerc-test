<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Notice of Decision & Action Taken</title>
<style>
    body{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 12px;
    }

</style>
</head>
<body>
 <div class="content">
  @include('view.form.form_header')

    <main>
    <div class="container-b pt-4 px-4 mx-5">
            <h1 style="font-size: 15px" class="text-center fw-bold">Notice of Decision/Action Taken</h1>
            <div class="mt-2">{{ date('M d, Y', strtotime($protocols->date_of_receipt)) }}</div>
            <div class="mt-3">{{ $protocols->p_researcher }}</div>
            <div>"Designation"</div>
            <div>Adamson University</div>
            <div>900 San Marcelino St, Ermita, Manila, 1000 Metro Manila</div>
            <?php
                $p_researcher = (explode(" ",$protocols->p_researcher));
            ?>
            <div class="mt-4">Dear {{ current($p_researcher) }} {{ end($p_researcher) }},</div>
            <div class="mt-2">Relative to the study protocol with the title, {{ $protocols->title }}, {{ $protocols->protocol_code }} submitted on {{ date('M d, Y', strtotime($protocols->date_of_receipt)) }}, UERC acknowledges the receipt of:</div>
            <div class="container">
                <div class="row pt-2">
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Protocol for Initial Submission</label><br>
                    </div>
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Protocol for Resubmission</label><br>
                    </div>
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Progress Report</label><br>
                    </div>
                </div>     

                <div class="row">
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Final Report</label><br>
                    </div>
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Violation/ Deviation Report</label><br>
                    </div>
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Amendment Report</label><br>
                    </div>
                </div>   

                <div class="row">
                    <div class="col">
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Early Termination Report</label><br>
                    </div>
                </div>   
        </div>

        <div class="mt-2">Upon deliberation, the UERC has decided for the following action/decision:</div>
        <div class="ms-4">
            <div style="line-height: 130%;">
                <div class="fst-italic" style="font-size: 14px">For Initial submission and resubmission of protocol</div>
                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                <label for="vehicle1">For expedited review</label><br>
                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                <label for="vehicle1">For full review</label><br>
                <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                <label for="vehicle1">Termination of the study</label><br>
            </div>
           

            <div class="row">
                <div class="col" style="line-height: 130%;">
                    <div class="fst-italic mt-2" style="font-size: 14px">For violation Report, Deviation Report</div>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Submission of additional information</label><br>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Submission of corrective action</label><br>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Clarificatory interview with PI</label><br>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Site visit</label><br>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Suspension of recruitment</label><br>
                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                    <label for="vehicle1">Suspension of study</label><br>

                </div>
                <div class="col" style="line-height: 130%;">
                    <div class="fst-italic mt-2" style="font-size: 14px">For Progress Report, Final Report, Amendments report and Early Termination Report</div>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Accepted/ approved</label><br>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Requires additional information or action</label><br>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Requires resubmission with corrections</label><br>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Requires revision of protocol</label><br>
                        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                        <label for="vehicle1">Disapproved</label><br>
                </div>
            </div>
        </div>
         
        <div class="mt-2">UERC has the following reason/s for the decision/action:</div>
        <div class="container">
            <div class="border border-dark px-2 py-1" style="min-height: 50px;" contentEditable=true></div>
            <div>For inquiries and questions, please communicate with UERC at <span class="text-decoration-underline text-primary">uerc-secretariat@adamson.edu.ph</span></div>
        </div>
       
        <div class="container-signatures mt-4" style="margin-top: 20px">
            <div>Sincerely,</div>
            <input type="file" id="imageInput" style="position: absolute">
            <img id="selectedImage" style="width: 260px; height: 130px;">
                <div style="border: 1px solid black; width: 300px"></div>
                <div style="line-height: 130%">
                    <input type="text" class="mt-2" style="width: 300px" id="inputElement" placeholder="Please insert name and press ENTER.">
                    <div class="mt-1 fw-bold" id="resultElement"></div>
                    <div class="mt-1">Chairperson, {{ $protocols->user->role=='Admin' ? 'UERC' : $protocols->user->colleges }}</div>
                    <div>{{ date('M d, Y', strtotime($protocols->date_of_receipt)) }}</div>
            
                </div>
        </div>

        <div class="container-f d-flex justify-content-between" style="margin-top: 60px">
            <div style="font-size: 12px">F-CRD-UERC Form No. 028 Notice of Decision/Action Taken</div>
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
function textAreaAdjust(element) {
  element.style.height = "1px";
  element.style.height = (25+element.scrollHeight)+"px";
}
    function generatePDF(){
        const element = document.querySelector('.content');
        var opt = {
            margin:0,
            filename:     'notice of decision & action taken.pdf',
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
</script>
</html>