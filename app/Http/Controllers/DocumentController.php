<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    //Add Document
    public function addDocument(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>";print_r($data);die;
            $document = new Document;
            $document->name = $data['document'];
            $document->save();
            return redirect('/admin/view-documents')->with('flash_message_success', 'Document added Successfully !');
        }
        return view('admin.documents.document_add');
    }
    //Edit document
    public function editDocument(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            Document::where(['id'=>$id])->update(['name'=>$data['document']]);
            return redirect('/admin/view-documents')->with('flash_message_success', 'Document updated Successfully !');
        }
        $documentDetails = Document::where(['id' => $id])->first();
        return view('admin.documents.document_edit')->with(compact('documentDetails'));
    }
    //Delete document
    public function deleteDocument($id = null){
        if(!empty($id)){
            Document::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success', 'Document deleted Successfully !');
        }
    }
    //View documents
    public function viewDocuments(){
        $documents = Document::get();
        return view('admin.documents.documents_view')->with(compact('documents'));
    }

}
