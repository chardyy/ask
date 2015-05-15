<?php

class AnswersController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('auth', array('only' => array('store')));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validation = Validator::make(Input::all(), Answer::$rules);

        $question_id = Input::get('question_id');
        if ($validation->passes()) {
            Answer::create(array(
                'answer' => Input::get('answer'),
                'question_id' => $question_id,
                'user_id' => Auth::user()->id
            ));
            return Redirect::back()
                ->with('message', 'Your answer has been posted');
        }
        return Redirect::back()
            ->withErrors($validation)
            ->withInput();
    }

}