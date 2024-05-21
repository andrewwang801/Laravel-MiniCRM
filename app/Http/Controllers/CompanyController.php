<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Utils\Utils;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as FacadesImage;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $company_array = Company::get();

        return view('company.index')->with('company_array', $company_array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.create');
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

        set_time_limit(0);
        ini_set('memory_limit', '-1');


        $validation = Validator::make(request()->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return redirect('company/');
        }

        $name = request('name');
        $email = request('email');
        $website = request('website');

        if (!isset($email)) {
            $email = "";
        }
        if (!isset($website)) {
            $website = "";
        }

        $company = new Company();
        $company->name = $name;
        $company->email = $email;
        $company->website = $website;

        $timestamp = time();

        if (request('logo') != null) {
            $image_filename = $timestamp . '.png';

            $original_image_path = public_path('images/original');
            if (!file_exists($original_image_path)) {
                mkdir($original_image_path);
            }

            $marker_image_path = public_path('images/marker');
            if (!file_exists($marker_image_path)) {
                mkdir($marker_image_path);
            }

            $thumbnail_image_path = public_path('images/thumbnail');
            if (!file_exists($thumbnail_image_path)) {
                mkdir($thumbnail_image_path);
            }

            // save original image
            request('logo')->move($original_image_path, $image_filename);

            // generate marker image
            $original_image = FacadesImage::make($original_image_path . DIRECTORY_SEPARATOR . $image_filename);

            // create empty canvas
            $logo = FacadesImage::canvas(128, 128);
            $logo->encode('png');

            // fill image with color
            $logo->fill('#ffffff');

            // generate thumbnail image
            FacadesImage::make($original_image_path . DIRECTORY_SEPARATOR . $image_filename)
                ->fit(320, 320)
                ->save($thumbnail_image_path . DIRECTORY_SEPARATOR . $image_filename);

            $company->logo_uri = $image_filename;
        }

        $company->save();

        return redirect('company/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $company = Company::where('id', $id)->first();

        return view('company.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $company = Company::where('id', $id)->first();

        return view('company.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        $validation = Validator::make(request()->all(), [
            'name' => 'required',
        ]);

        if ($validation->fails()) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }


        $name = request('name');
        $email = request('email');
        $website = request('website');

        $company = Company::where('id', $id)->first();

        if (!isset($company)) {
            return Utils::makeResponse([], config('constants.response-message.invalid-params'));
        }

        $company->name = $name;
        if (isset($email)) {
            $company->email = $email;
        }
        if (isset($website)) {
            $company->website = $website;
        }

        $company->save();

        return redirect('company/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::where('id', $id)->delete();

        return Utils::makeResponse();
    }
}
