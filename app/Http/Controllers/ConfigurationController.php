<?php

namespace App\Http\Controllers;

use App\Http\Requests\Configurations\StoreConfigurationRequest;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    const STORAGE_PATH = 'storage/images/configurations';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Configurations\StoreConfigurationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConfigurationRequest $request)
    {
        $name = uniqid() . $request->file('logo')->getClientOriginalName();
        $request->file('logo')->move(public_path(self::STORAGE_PATH), $name);

        $configuration = Configuration::first();
        if($configuration){
            $configuration->logo = self::STORAGE_PATH.'/'.$name;
            $configuration->update();
        }else{
            $configuration = new Configuration();
            $configuration->logo = self::STORAGE_PATH.'/'.$name;
            $configuration->save();
        }

        return redirect('/user/profile');
    }

}
