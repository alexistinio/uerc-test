<?php

namespace App\Http\Livewire;

use App\Models\BoardMember;
use Livewire\Component;

class BoardMemberMgt extends Component
{
    public function render()
    {
        $chairperson = BoardMember::where('position','Chairperson')->get();
        $secretary = BoardMember::where('position','Secretary')->get();
        $member = BoardMember::where('position','Member')->get();
        $na_member = BoardMember::where('position','Non-Affiliate Member')->get();
        $el_member = BoardMember::where('position','External Lay Member')->get();

        return view('livewire.board-member-mgt', compact('chairperson','secretary','member','na_member','el_member'))->layout('layouts.base');
    }

    public function create()
    {
        return view('view.board_member_mgt.add_board_member');
    }

    public function edit()
    {
        $board_member =  BoardMember::find(request('id'));

        return view('view.board_member_mgt.edit_board', compact('board_member'));
    }

    public function update($id)
    {
        $board_member = BoardMember::find($id);
        
        $data = request()->validate([
            'title' => 'required',
            'firstname' => 'required',
            'initial' => 'nullable',
            'lastname' => 'required',
            'position' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the position being added/updated is 'Chairperson' or 'Secretary'
                    if (in_array($value, ['Chairperson', 'Secretary'])) {
                        // Check if a user with the specified position already exists in the database
                        $existingCount = \DB::table('board_members')
                            ->where('position', $value)
                            ->where('id', '<>', request()->input('id')) // Exclude the current user when updating
                            ->count();
            
                        if ($existingCount > 0) {
                            $fail("The $value position is already occupied.");
                        }
                    }
                },
                'string',
                'max:255'
            ],
            'email' => 'required',
            'phone_number' => 'nullable',
       
        ]);
     
        $board_member->update($data);

        if($board_member->wasChanged()){

            return redirect('/board_member_mgt')->with('message', 'Board Member "'.$board_member->firstname.' '.$board_member->lastname.'" has been updated.');
        }
        else{
            return redirect('/board_member_mgt')->with('message', 'No changes made.');
        }

       
    }

    public function delete($id)
    {
        BoardMember::find($id)->delete();
        return back();
    }


    public function store(BoardMember $board_members)
    {
        $data = request()->validate([
            'title' => 'required',
            'firstname' => 'required',
            'initial' => 'nullable',
            'lastname' => 'required',
            'position' => [
                'required',
                function ($attribute, $value, $fail) {
                    // Check if the position being added/updated is 'Chairperson' or 'Secretary'
                    if (in_array($value, ['Chairperson', 'Secretary'])) {
                        // Check if a user with the specified position already exists in the database
                        $existingCount = \DB::table('board_members')
                            ->where('position', $value)
                            ->where('id', '<>', request()->input('id')) // Exclude the current user when updating
                            ->count();
            
                        if ($existingCount > 0) {
                            $fail("The $value position is already occupied.");
                        }
                    }
                },
                'string',
                'max:255'
            ],
            'email' => 'required',
            'phone_number' => 'nullable',
       
        ]);
     
        $board_members->create($data);
    
        return redirect('/board_member_mgt')->with('message','Board Member "'.$data['firstname'].' '.$data['lastname'].'" has been created.');
    }


}

