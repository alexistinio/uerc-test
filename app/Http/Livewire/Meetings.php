<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Storage;

use App\Models\Meeting;
use App\Models\Folder;
use Livewire\Component;

class Meetings extends Component
{
    public $sort = 'DESC';

    public function render()
    {
        if(isset($_GET['query'])){
          $query = $_GET['query'];
        }
        else{
            $query = '';
        }

        if($query==''){
          $files = Meeting::where('f_id', null)->orderBy('created_at', $this->sort)->get();
          $folders = Folder::orderBy('created_at', $this->sort)->get();
        }
        else{
          $files = Meeting::where('file_name','LIKE' , '%'.$query.'%')->where('f_id', null)->orderBy('created_at', $this->sort)->get();
          $folders = Folder::where('folder_name','LIKE' , '%'.$query.'%')->orderBy('created_at', $this->sort)->get();
        }

  
        $combinedArray = $folders->merge($files);

        return view('livewire.meetings', compact('files','folders','combinedArray','query'))->layout('layouts.base');
    }

    public function store(Meeting $meetings)
    {
         $file = request()->file('uploadInput');

         $fileName = $file->getClientOriginalName();
         $file->storeAs('meetings', $fileName, 'public');

         $data = [
            'user_id'=>auth()->user()->id,
            'file_name'=>$fileName,
         ];
         $meetings->create($data);
         
       return back()->with('message', '"'.$fileName.'" has been successfully uploaded.');
    }

    public function createFolder(Folder $folder)
    {
    
        $folderName = request('folderName');
        $data = [
            'user_id' => auth()->user()->id,
            'folder_name' => $folderName,
         ];
        $path = '/meetings/fileFolders' . '/' . $folderName;
        Storage::makeDirectory($path);

        $folder->create($data);

       return back()->with('message','Folder "'.$folderName.'" has been created.');
    }

    public function openFolder($folderName)
    {
     
       if(isset($_GET['sort'])){
         $sort = $_GET['sort'];
       }
       else{
         $sort = 'DESC';
       }
       $f = Folder::where('folder_name',$folderName)->first();
       $id = $f->id;
       $folder = Folder::find($id);

       if($sort=='ASC'){
         $data = ($folder->meetings)->sortBy('created_at');
       }
   
       else{
         $data = ($folder->meetings)->sortByDesc('created_at');
       }

       return view('view.meetings.folder', compact('folder','data','sort'));
    }

    public function editFolder($id)
    {
    
      $folder = Folder::find($id);
      $oldName = $folder->folder_name;
      $newName = request('folderName');
      
      Storage::disk('public')->move("meetings/{$oldName}", "meetings/{$newName}");
      $folder->folder_name = request('folderName');
      $folder->update();

      if($folder->wasChanged()){
         return back()->with('message','Folder name changed to "'.$folder->folder_name.'".');
     }

      else {
         return back()->with('message','No changes made.');
      }
    }

    public function delete($id)
    {
    
      $file = Meeting::find($id);
      $path = '/meetings' . '/' . $file->file_name;

      Storage::disk('public')->delete($path);
      $file->delete();
    }
    
        public function d_fileInFolder($folderName, $id)
    {
    
    
      $file = Meeting::find($id);
      $folderName = $folderName;
      $path = '/meetings/fileFolders/'.$folderName.'/'.$file->file_name;

      Storage::disk('public')->delete($path);
      $file->delete();
      
    }

    public function delete_folder($id)
    {
    
       $folder = Folder::find($id);
       
       $path = '/meetings' . '/' . $folder->folder_name;
       Storage::deleteDirectory($path);

       foreach($folder->meetings as $file){
         $file->delete();
       }

       $folder->delete();
    }


    public function f_store(Meeting $meetings, $id)
    {
        $folder = Folder::find($id);
        $file = request()->file('uploadInput');

        $fileName = $file->getClientOriginalName();
        $file->storeAs('meetings/fileFolders/'.$folder->folder_name, $fileName, 'public');
       
        
        $data = [
           'user_id'=>auth()->user()->id,
           'f_id'=>$id,
           'file_name'=>$fileName,
        ];
        $meetings->create($data);
    

        return back()->with('message', 'File "'.$fileName.'" under folder "'.$folder->folder_name.'" has been uploaded.');
    }
}
