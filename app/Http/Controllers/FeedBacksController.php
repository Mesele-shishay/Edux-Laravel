<?php

namespace App\Http\Controllers;

use App\Models\FeedBacks;
use App\Traits\UserProfile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedBacksRequest;
use App\Http\Requests\UpdateFeedBacksRequest;


class FeedBacksController extends Controller
{
     use UserProfile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedbacks = FeedBacks::paginate(10);
        $data = [
            'comments' => $feedbacks,
        ];

        // dd($data);
        return view('feedbacks.index',array_merge($data));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFeedBacksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedBacksRequest $request)
    {
        $request->validated();
        if (FeedBacks::create($request->all())) {
            return back()->with('status', 'Your contact request has been submitted successfully!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeedBacks  $feedBacks
     * @return \Illuminate\Http\Response
     */
    public function show(FeedBacks $feedBacks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeedBacks  $feedBacks
     * @return \Illuminate\Http\Response
     */
    public function edit(FeedBacks $feedBacks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedBacksRequest  $request
     * @param  \App\Models\FeedBacks  $feedBacks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFeedBacksRequest $request, FeedBacks $feedBacks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
      *
     * @param  \App\Models\FeedBacks  $feedBacks
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeedBacks $feedBacks)
    {
        //
    }
}
