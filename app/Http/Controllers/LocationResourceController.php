<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Spatie\Tags\HasTags;

class LocationResourceController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);

        $location->attachTag('office');

        $location->save();

        return redirect('/company');
    }
}
