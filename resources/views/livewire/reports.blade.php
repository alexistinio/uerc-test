<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acknowledgement Form</title>
    <style>
        thead {
            font-size: 12px
        }
        th, td{
         
            padding: 2px 6px;
            border-collapse: collapse;
        }

        th{
            border-bottom: 1px solid black;
        }

        table{
            width: 100%;            
            padding: 2px 6px;
            border-collapse: collapse;
        }
        tr:nth-child(even) {background-color: #f2f2f2;}
        
        .bottom-block {
        
            left: 0;
            bottom: 0;
            width: 100%; /* Set the width to 100% to cover the entire viewport width */
            background-color: #f0f0f0; /* Set your desired background color */
            padding: 10px; /* Adjust padding as needed */
       
            z-index: 999; /* Adjust the z-index as needed to ensure it's above other content */
        }
    
        @media only screen and (max-width: 1300px) {
            .container-h {
                margin-left: 0
            }
        }
    </style>
</head>
<body>

    <div class="container-h mb-5 mt-3">
    <div class="d-flex ps-3">
        <h3 style="font-family: 'Inter Tight', sans-serif;">PHREB Reporting</h3>
    
        @if(count($filteredProtocols)!=0)
            <button class="btn btn-primary ms-2" onclick="generatePDF()">Download</button> 
        @endif    
    </div>
    <div class="ms-3 mb-3">Admin Access</div>
    <div class="d-flex ps-3">
        <div onclick="yearly_function()" class="py-2 px-3 <?php echo $intervals==null || $intervals=='yearly' ? 'bg-secondary text-light' : ''  ?>" style="cursor: pointer; border-radius: 10px">Yearly</div>
            <form id="yearly_form" action="" method="get">
                <input type="hidden" name="intervals" value="yearly">
            </form>
        <div onclick="monthly_function()" class="ms-2 py-2 px-3 <?php echo $intervals=='monthly' ? 'bg-secondary text-light' : ''  ?>" style="cursor: pointer; border-radius: 10px">Monthly</div>
            <form id="monthly_form" action="" method="get">
                <input type="hidden" name="intervals" value="monthly">
            </form>  
    </div>
    <div class="row mt-3">
            <div class="col-md-3 col-11">
            @if($intervals=='monthly')
                <form id="month_inputform" action="" method="get">
                    <input onchange="month_onchange()" type="month" class="form-control border border-secondary ms-3" id="month" name="month">
                    <input type="hidden" value="<?php echo $intervals ?>" name="intervals">
                </form>    
                <?php 
                echo "<script>document.getElementById('month').value = '$month'</script>";
                ?>
            @else
            <form id="year_inputform" action="" method="get">
                <select onchange="year_onchange()" id="year" class="form-select border border-secondary ms-3" name="year">
                <!-- JavaScript will generate the options here -->
                </select>
                <input type="hidden" name="intervals" value="<?php echo $intervals ?>">
            </form>    
            <script>
                const currentYear = new Date().getFullYear();
                const yearSelect = document.getElementById("year");

                for (let i = currentYear; i <= currentYear + 10; i++) {
                    const option = document.createElement("option");
                    option.value = i;
                    option.textContent = i;
                    yearSelect.appendChild(option);
                }
            </script>
            <?php echo "<script>document.getElementById('year').value = '$year'</script>";?>
            @endif
            </div>
        </div>
    </div>

    <div class="content-pdf" style="font-size: 12px">
    <main class="px-3">
    @if(count($filteredProtocols)!=0)
        <h5 class="mt-2">Adamson University UERC PHREB Reporting for {{ $intervals=='monthly' ? date("M Y", strtotime($month)) : $year }}</h5>
    @endif    
    <div style="overflow-x:scroll">
    <table class="mt-4">
        
        @if(count($filteredProtocols)!=0)
        <thead>
            <tr>
            <th>Protocol Code</th>
            <th>Protocol Title</th>
            <th>Researchers</th>
            <th>Funding</th>
            <th>Research Type</th>
            <th>Date Received</th>
            <th>Review Type</th>
            <th>Date of Meeting</th>
            <th>Primary Reviewer</th>
            <th>Decision</th>
            <th>Date of First Decision</th>
            <th>Status</th>
            <tr>
        </thead>
        <tbody>
        @endif
        <?php 
        $count = 0; 
        $mod = 7;
        ?>
        @forelse($filteredProtocols as $protocol)
         <?php 
            $count++;
         ?>
 
        
          
         <tr class="<?php echo $count % $mod === 0 ? 'html2pdf__page-break mt-5' : '' ?>">
            <?php 

            if($count>7){
                $count=1;
                $mod = 8;
            }
            ?>
                <td>{{ $protocol->protocol_code }}</td>
                <td>{{ $protocol->title }}</td>
                <td>{{ $protocol->p_researcher }}<?php echo $protocol->c_researcher!='None' ? '/'.$protocol->c_researcher : '' ?></td>
                <td>
                    <?php 
                    if($protocol->funding=='R - Researcher-funded'){
                        echo 'R';
                    }
                    else if($protocol->funding=='I - Institution-funded'){
                        echo 'I';
                    }
                    else if($protocol->funding=='A - Agency other than institutuion'){
                        echo 'A';
                    }
                    else if($protocol->funding=='D - Pharmaceutical companies'){
                        echo 'D';
                    }
                    else{
                        echo 'O';
                    }
                    ?>
                </td>
                <td>{{ $protocol->research_type }}</td>
                <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                <td>{{ $protocol->type_of_review }}</td>
                <td>{{ date('M d, Y', strtotime($protocol->date_of_receipt)) }}</td>
                <td>{{ $protocol->primary_reviewer }}</td>
                <td>{{ $protocol->first_decision }}</td>
                <td>
                    <?php
                       if($protocol->first_decision_access==null){
                        echo 'NA';
                       }
                       else{
                        echo date('M d, Y', strtotime($protocol->first_decision_access));
                       }
                    ?>
                </td>
                <td>
                <?php 
                    if($protocol->approval=='On-going Review'){
                        echo 'OR';
                    }
                    else if($protocol->approval=='Approved & On-going'){
                        echo 'A';
                    }
                    else if($protocol->approval=='Completed'){
                        echo 'C';
                    }
                    else{
                        echo 'T';
                    }
                    ?>
                </td>
            </tr>  
       
        @empty
        <?php
      
        $timestamp = strtotime($month);
        $month = date("M Y", $timestamp);
        ?>
        <h1 class="text-center mt-5 text-muted">No Data Found for <?php echo $intervals=='monthly' ? $month : 'Year '.$year ?>.</h1>     
        @endforelse
        </tbody>
        </table>
        </div>
    </main>
</div>

</body>
<script>
const element = document.querySelector('.content-pdf');

function yearly_function(){
        $("#yearly_form").submit();
    }

    function monthly_function(){
        $("#monthly_form").submit();
    }

    function month_onchange(){
      $("#month_inputform").submit();
    }

    function year_onchange(){
      $("#year_inputform").submit();
    }
    function generatePDF(){

        var opt = {
            margin: 5,
            filename:     'phreb.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, scrollY: 0 },
          
            jsPDF:        { format: 'a4', orientation: 'landscape' },
            
        };

        html2pdf().from(element).set(opt).save()
        
    }
</script>
</html>