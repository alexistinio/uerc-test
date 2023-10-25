<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Protocol;
use Spipu\Html2Pdf\Html2Pdf;


class Reports extends Component
{

    public function generatePdf()
    {

        if(isset($_GET['intervals'])){
            $intervals = $_GET['intervals'];
        }
        else{
            $intervals = null;
        }

        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }
        else{
            $currentYear = date("Y");
            $currentMonth = date("m");
            $month = $currentYear.'-'.$currentMonth;
        }

        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }
        else{
            $year = date("Y");
        }
        // Create an instance of HTML2PDF
        $html2pdf = new Html2Pdf();

        // Set PDF content from the Blade view
        $html2pdf->writeHTML(view('livewire.reports')->render());

        // Output PDF as a download or save to a file
        $html2pdf->output('your_pdf_file.pdf');

        // You can also use $html2pdf->Output() to directly output the PDF to the browser.

        // Optionally, you can use the following line to redirect back to the Livewire component.
        // return redirect()->to('/your-route');

        return back()->with([
            'intervals' => $intervals,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function render()
    {
 
        if(isset($_GET['intervals'])){
            $intervals = $_GET['intervals'];
        }
        else{
            $intervals = null;
        }

        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }
        else{
            $currentYear = date("Y");
            $currentMonth = date("m");
            $month = $currentYear.'-'.$currentMonth;
        }

        if(isset($_GET['year'])){
            $year = $_GET['year'];
        }
        else{
            $year = date("Y");
        }
       
        $protocols = Protocol::all();
        if($intervals=='monthly'){
            $filteredProtocols = [];
            foreach($protocols as $protocol){
                $protocol_month = substr($protocol->date_of_receipt, 0, 7);
                if($protocol_month != $month){
                    continue;
                }
                $filteredProtocols[] = $protocol;
            }
        }
        else{
            $filteredProtocols = [];
            foreach($protocols as $protocol){
                $protocol_year = substr($protocol->date_of_receipt, 0, 4);
                if($protocol_year != $year){
                    continue;
                }
                $filteredProtocols[] = $protocol;
            }
        }

        return view('livewire.reports', compact('filteredProtocols', 'intervals','month','year'))->layout('layouts.base');
    }
    
}
