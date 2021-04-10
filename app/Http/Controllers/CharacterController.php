<?php

namespace App\Http\Controllers;

use App\Http\Resources\CharacterCollection;
use App\Http\Resources\CharacterResource;
use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    private $repository;

    public function __construct(Character $model) {
        $this->repository = new CharacterRepository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return CharacterCollection
     */
    public function index()
    {
        return new CharacterCollection($this->repository->all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return CharacterResource
     */
    public function show($id)
    {
        return new CharacterResource($this->repository->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
