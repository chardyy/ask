<?php

class QuestionsController extends \BaseController {

     //public $restful = true;
	/**
	 * Display a listing of the resource.
	 * GET /questions
	 *
	 * @return Response
	 */

    public function __construct(){
        $this->beforeFilter('auth', array('only' => array('create', 'your_questions','edit','store', 'update')));
     }

	public function index()
	{
        return View::make('questions.index')
            ->with('title', 'Murag ASKfm - Home')
            ->with('questions', Question::unsolved());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /questions/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $validator = Validator::make(Input::all(), Question::$rules);

        if($validator->passes()){
            Question::create([
                'question' => Input::get('question'),
                'user_id' => Auth::user()->id
            ]);

            return Redirect::to('/')->with('message', 'Your question has been posted');
        }else{
            return Redirect::to('/')->withErrors($validator)->withInput();
        }
	}


	/**
	 * Store a newly created resource in storage.
	 * POST /questions
	 *
	 * @return Response
	 */
	public function store()
	{
        $validation = Validator::make(Input::all(), Question::$rules);
        if ($validation->passes()) {
            Question::create(array(
                'question' => Input::get('question'),
                'user_id' => Auth::user()->id
            ));
            return Redirect::route('home')
                ->with('message', 'Your question has been posted');
        }
        return Redirect::route('home')
            ->withErrors($validation)
            ->withInput();
	}

	/**
	 * Display the specified resource.
	 * GET /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('questions.show')
            ->with('title', 'Make it Snappy - View Question')
            ->with('question', Question::find($id));
    }

    public function get_your_questions(){
        return View::make('questions.your_questions')
                     ->with('title', 'Murag ASKfm - Your Own Question')
                     ->with('username', Auth::user()->username)
                     ->with('questions', Question::your_questions());
    }



	/**
	 * Show the form for editing the specified resource.
	 * GET /questions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if (!$this->questionBelongsToUser($id)) {
            return Redirect::route('your-questions')
                ->with('message', 'Invalid question');
        }
        return View::make('questions.edit')
            ->with('title', 'Make it Snappy - Edit Question')
            ->with('question', Question::find($id));
    }

	/**
	 * Update the specified resource in storage.
	 * PUT /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $id == Input::get('question_id');
        if (!$this->questionBelongsToUser($id)) {
            return Redirect::route('your-questions')
                ->with('message', 'Invalid question');
        }
        $validation = Validator::make(Input::all(), Question::$rules);
        if ($validation->passes()) {
            Question::where('id','=',$id)->update(array(
                'question' => Input::get('question'),
                'solved' => Input::get('solved'),
            ));
            return Redirect::back()
                ->with('message', 'Your question has been saved');
        }
        return Redirect::back()
            ->withErrors($validation)
            ->withInput();
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /questions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    private function questionBelongsToUser($id)
    {
        $question = Question::find($id);
        $user = Auth::user();
        if (!isset($question) or !isset($user)) {
            return False;
        }
        return ($question->user_id == Auth::user()->id);
    }


    public function postSearch()
    {
        $keyword = Input::get('keyword');
        if (empty($keyword)) {
            return Redirect::back()
                ->with('message', 'No keyword entered, please try again');
        }
        return Redirect::to('results/'.$keyword);
    }

    public function getResults($keyword)
    {


        return View::make('questions.results')
            ->with('title', 'Make it Snappy - Search Results')
            ->with('questions', Question::search($keyword));
    }

}