<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProtocolCode;


class CodeCategory extends Component
{

    public $delete_id;
    public $year, $category_codes, $program_codes, $sequence_codes;

   

    public function render()
    {
        $sort = request('sort', 'DESC');
        $colleges = request('colleges', 'all');
    
        $collegesToPrograms = [
            'ARC' => ['ARC'],
            'BUS' => ['ACC', 'CUS', 'FIN', 'HOS', 'MGT'],
            'CELA' => ['COM', 'EDU', 'LANG', 'PHY', 'SOC'],
            'ENG' => ['CEE', 'CIV', 'COE', 'ELE', 'MIN', 'IND', 'MEC'],
            'LAW' => ['LAW'],
            'NUR' => ['NUR'],
            'PHA' => ['PHA'],
            'COS' => ['CHE', 'COS', 'ITM', 'MAT', 'BIO', 'PSY'],
        ];
    
        if (array_key_exists($colleges, $collegesToPrograms)) {
            $programCodes = $collegesToPrograms[$colleges];
            $protocolCode = ProtocolCode::whereIn('program_codes', $programCodes)
                ->orderBy('created_at', $sort)
                ->paginate(6, ['*'], 'page', request()->input('page'));
        } else {
            $protocolCode = ProtocolCode::orderBy('created_at', $sort)->paginate(6, ['*'], 'page', request()->input('page'));
        }
    
        $sCode = ProtocolCode::count();
        $this->sequence_codes = sprintf("%02d", $sCode + 1);
    
        return view('livewire.code-category', compact('protocolCode', 'sCode', 'colleges', 'sort'))
            ->layout('layouts.base');
    }
    
    

    public function delete($id)
    {
        $code = ProtocolCode::find($id);
        $code->delete();

        $protocol_codes = ProtocolCode::where('id','>', $id)->get();
        
        foreach($protocol_codes as $protocol){
            $protocol->sequence_codes = sprintf("%02d", $protocol->sequence_codes-1);
            $protocol->protocol_code = $protocol->year.'-'.$protocol->category_codes.'-'.$protocol->program_codes.'-'.$protocol->sequence_codes;
            $protocol->update();
        }
    } 

    public function edit_code($id)
    {
      
       $protocol_code = ProtocolCode::find($id);

       return response()->json(['protocol_code' => $protocol_code]);
    } 

    public function update_code($id)
    {
        $data = [
            'year'=> request('edit_year'),
            'category_codes'=>request('edit_category_codes'),
            'program_codes'=>request('edit_program_codes'),
            'sequence_codes'=>request('edit_sequence_codes'),
        ];
      
        $protocol_code = $data['year'].'-'.$data['category_codes'].'-'.$data['program_codes'].'-'.$data['sequence_codes'];
        $data['protocol_code'] = $protocol_code;
         
           
        $protocolCode = ProtocolCode::find($id);
        $protocolCode->update($data);
   
      
           if($protocolCode->wasChanged()){
               return redirect('/protocol_codes')->with('message', 'Protocol Code has been updated.'); 
           }
   
           else {
               return redirect('/protocol_codes')->with('message', 'No changes made.'); 
           }
    } 
    public function store(ProtocolCode $protocolCode){
        $data = request()->validate([
            'year'=>'required',
            'category_codes'=>'required',
            'program_codes'=>'required',
            'sequence_codes'=>'required',
        ]); 

        $protocol_code = $data['year'].'-'.$data['category_codes'].'-'.$data['program_codes'].'-'.$data['sequence_codes'];
        
        $protocolCode->create([
            'year'=>$data['year'],
            'category_codes'=>$data['category_codes'],
            'program_codes'=>$data['program_codes'],
            'sequence_codes'=>$data['sequence_codes'],
            'protocol_code'=>$protocol_code
        ]);

        return redirect('/protocol_codes')->with('message','Protocol Code Added!');
    }
}
