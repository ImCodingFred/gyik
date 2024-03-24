<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function Welcome(){
        return view('welcome',[
            'result' => question::select('questions.id','questions.question','questions.anonim','users.name')
                                    ->join('users','users.id','questions.user')
                                    ->orderBy('id','DESC')
                                    ->limit(4)
                                    ->get()
        ]);
    }

    public function OsszTema(){
        return view('ossztema',[
            'result' => question::select('questions.id','questions.question','questions.anonim','users.name')
                                    ->join('users','users.id','questions.user')
                                    ->orderBy('id','DESC')
                                    ->paginate(20)
        ]);
    }

    public function Tema(){
        if(Auth::check()){
            return view('tema');
        } else{
            return redirect('/');
        }
    }

    public function TemaData(Request $request){
        if(Auth::check()){
            $request->validate([
                'question' => 'required'
            ],[
                'question.required' => 'Üres mezőt nem küldhet be!'
            ]);
            $data = new Question;
            $data->user = Auth::user()->id;
            $data->question=$request->question;
            if($request->has('anonim')){
                $data->anonim=1;
            } else{
                $data->anonim=0;
            }
            $data->save();
            return redirect('/');
        } else{
            return redirect('/belepes');
        }
    }
    public function EgyTema($id){
        return view('egytema',[
            'question'=> question::find($id),
            'quser' => user::find(question::find($id)->user),
            'answer'=> answer::select('answers.id','answers.question','answers.user',
                                    'answers.answer','answers.anonim','users.name')
                                ->join('users','users.id','answers.user')
                                ->where('question','=',$id)
                                ->orderby('answers.id','DESC')
                                ->paginate(5),
            //'sorszam' => answer::where('question',$id)->count('question')
        ]);
    }

    public function EgyTemaData(Request $request){
        if(Auth::check()){
            $request->validate([
                'answer' => 'required'
            ],[
                'answer.required' => "A válasz mező nem lehet üres"
            ]);
            $data = new answer;
            $data->question = $request->id;
            $data->user = Auth::user()->id;
            $data->answer = $request->answer;
            if($request->has('anonim')){
                $data->anonim = 1;
            } else{
                $data->anonim = 0;
            }
            $data->save();
            return redirect('/tema/'.$request->id);
        } else{
            return redirect('/belepes');
        }
    }

    public function SearchPost(Request $request)
         {
            $request -> validate([
                'search' => '',
            ],[
                'search.required' => 'A keresési mező kitöltése kötelező!',
                'search.min' => 'A keresési mező minimum 3 karakter hosszú legyen!',
            ]);
            if ($request->options == 'tema') {
                return view('kereses', [
                    'questions' => question::select('questions.id', 'questions.question', 'users.name', 'questions.anonim')->join('users', 'questions.user', '=', 'users.id')->where('question', 'like', '%'.$request->search.'%')->orderBy('questions.id', 'DESC')->paginate(10),
                ]);
            } elseif ($request->options == 'hozzaszolas') {
                return view('kereses', [
                    'answers' => answer::select('answers.id', 'answers.question', 'answers.user', 'answers.answer', 'answers.anonim', 'users.name')->join('users', 'answers.user', '=', 'users.id')->where('answer', 'like', '%'.$request->search.'%')->orderBy('answers.id', 'DESC')->paginate(10),
                    'question' => question::find($request->search),
                ]);
            } elseif ($request->options == 'felhasznalo') {
                return view('kereses', [
                    'users' => User::where('name', 'like', '%'.$request->search.'%')->paginate(10),
                ]);
            }
            return view('kereses', [
                'users' => User::where('name', 'like', '%'.$request->search.'%')->paginate(10),
            ]);
        }

}
