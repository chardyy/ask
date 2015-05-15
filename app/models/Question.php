<?php

class Question extends \Eloquent {
	protected $fillable = ['question', 'user_id'];

    public static $rules = [
        'question' => 'required|max: 255',
        'solved' => 'in:0, 1'
    ];

    public function user(){
        return $this->belongsTo('User');
    }

    public function answers(){
        return $this->hasMany('Answer');
    }

    public static function unsolved(){
        return static::where('solved', '=', 0)
                       ->take(3)->orderBy('id', 'DESC')
                       ->paginate(3);
    }

    public static function your_questions(){
        return static::where('user_id', '=', Auth::user()->id)->paginate(3);
    }

    public static function search($keyword)
    {
        return static::where('question', 'like', '%'.$keyword.'%')
            ->orderBy('updated_at', 'ASC')
            ->paginate(3);
    }
}