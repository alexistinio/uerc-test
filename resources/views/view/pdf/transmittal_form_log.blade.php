<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Transmittal Form</title>
<style>
    .container-b div, .container-signatures div, .container-f div{
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    div{
        font-size: 14px;
    }
    .upper-table .col{
        border: 1px solid black;
        height: 50px;
        text-align: center;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    body{
        font-family: Arial, Helvetica, sans-serif;
    }

</style>
</head>
<body>
 <div class="content">
   @include('view.form.form_header')

    <main>
    <div class="container-b pt-4 px-4 mx-5">
        <div class="row">
            <div class="col offset-4">
             <div style="font-size: 16px" class="fw-bold text-center">UERC Transmittal Form Log</div>
            </div>
            <div class="col text-end">{{ $protocols->protocol_code }}</h1>
            </div>
        </div>
     <div class="container upper-table mt-3">
     <div class="row">
            <div class="col">Code</div>
            <div class="col">Title</div>
            <div class="col">Principal Investigator</div>
            <div class="col">Type of Document</div>
            <div class="col">Reviewer</div>
            <div class="col">Released</div>
            <div class="col">Returned</div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
            <div class="col"></div>
        </div>
     </div>
        
         
            <div class="container border border-dark mt-5">
                <div class="row">
                    <div class="col">
                        <div class="pb-3 fw-bold">Title: {{ $protocols->title}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col pb-2" style="border-width: 1px 1px 0 0; border-color: black; border-style: solid;">
                        <div class="fw-bold">Approval Date:</div>
                    </div>
                    <div class="col" style="border-top: 1px solid black">
                        <div class="fw-bold">Study Site:</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="border-width: 1px 1px 0 0; border-color: black; border-style: solid;">
                        <div class="fw-bold">Principal Investigator (PI): {{ $protocols->p_researcher }}</div>
                        <div class="fw-bold">Email: {{ $protocols->email }}</div>
                    </div>
                    <div class="col" style="border-top: 1px solid black">
                        <div class="fw-bold">Mobile Number: +63 {{ $protocols->phone_number }}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="border-width: 1px 1px 0 0; border-color: black; border-style: solid;">
                        <div class="fw-bold">Sponsor:</div>
                        <div class="fw-bold">Email:</div>
                    </div>
                    <div class="col" style="border-top: 1px solid black">
                        <div class="fw-bold">Contact Person:</div>
                        <div class="fw-bold">Mobile Number:</div>
                    </div>
                </div>
                <div class="row fw-bold" style="border-top: 1px solid black;">
                    <div class="col-4 p-0">
                        <table style="width: 100%">
                        <tr>    
                            <th style="border-width: 0 1px 1px 0; border-color: black; border-style: solid; text-align: center">Type of <br>Documents</th>       
                        </tr>
                        <tr>
                            <td class="px-2" style="border-width: 0 1px 1px 0; border-color: black; border-style: solid;">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Protocol</label><br><br>
                            </td>
                         
                        </tr>
                        <tr>
                            <td class="px-2" style="border-width: 0 1px 1px 0; border-color: black; border-style: solid;">
                                <div class="d-flex">
                                <input type="checkbox" class="mb-4 me-1" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1">Related <br>Documents</label><br><br>
                                </div>
                            
                            </td>
                   
                        </tr>
                        <tr>
                            <td class="px-2" style="border-width: 0 1px 0 0; border-color: black; border-style: solid;">
                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Others</label><br><br>
                            </td>
                    
                        </tr>
                        </div>
                       
                    </table>
               </div>
             
                       
                 
                    <div class="col text-center px-0" style="border-left: 1px solid black">
                       <div style="height: 48px; border-bottom: 1px solid black">Released by:</div>
                       <div class="mx-1" style="border: 1px solid black; margin-top: 75px"></div>
                      <div style="font-size: 12px">Signature over Printed name</div>
                      <div style="font-size: 14px" class="text-start mx-2 mt-3">Date:</div>
                    </div>
                    <div class="col px-0 text-center" style="border-left: 1px solid black">
                       <div style="height: 48px; border-bottom: 1px solid black">Received by:</div>
                       <div class="mx-1" style="border: 1px solid black; margin-top: 75px"></div>
                      <div style="font-size: 12px">Signature over Printed name</div>
                      <div style="font-size: 14px" class="text-start mx-2 mt-3">Date:</div>
                    </div>
                    <div class="col px-0 text-center" style="border-left: 1px solid black">
                       <div class="px-1" style="height: 48px; border-bottom: 1px solid black">Purpose of Transmittal:</div>
                    </div>
                </div>
            </div>
            <div class="container-f d-flex justify-content-between" style="margin-top: 250px">
            <div style="font-size: 12px">UERC Form No.  Transmittal Form</div>
            <div style="font-size: 14px">Page <span class="fw-bold">1</span> of <span class="fw-bold">1</span></div>
        </div>
</div>

    </main>
 
</div>
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
            filename:     'transmittal form log.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().from(element).set(opt).save()
    }
</script>
</html>