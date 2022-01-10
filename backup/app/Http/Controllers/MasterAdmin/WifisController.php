<?php

namespace App\Http\Controllers\MasterAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wifi;
use App\Http\Requests\WifisRequest;

class WifisController extends Controller
{
    /**
     * Display a listing of the wifi routers
     * 
     * @param \App\Models\Wifi $wifi
     * @return \Illuminate\View\View
     */
    public function index(Wifi $wifi)
    {
        $wifiRouters = $wifi->orderBy('created_at', 'desc')->get();

        return view('masteradmin.wifi_routers.index', compact('wifiRouters'));
    }

    /**
     * Show the form for creating a new wifi router
     * 
     * @return \Illuminate\View\View 
     */
    public function create()
    {
        return view('masteradmin.wifi_routers.create');
    }

    /**
     * Store a newly created wifi router in storage.
     * 
     * @param \App\Http\Requests\WifisRequest  $request
     * @param \App\Models\Wifi $wifiRouter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WifisRequest $request, Wifi $wifiRouter)
    {
        $wifiRouter->create($request->all());

        return redirect()->route('wifi-routers.index')
            ->with('success', 'Wifi Router successfully created.');
    }

    /**
     * Show the form for editing the specified wifi router resource.
     * 
     * @param \App\Models\Wifi  $wifiRouter
     * @return \Illuminate\View\View
     */
    public function edit(Wifi $wifiRouter)
    {
        return view('masteradmin.wifi_routers.edit', compact('wifiRouter'));
    }

    /**
     * Update the specified wifi router in storage.
     * 
     * @param  \App\Http\Requests\WifisRequest  $request
     * @param \App\Models\Wifi $wifiRouter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WifisRequest $request, Wifi $wifiRouter)
    {
        $wifiRouter->update($request->all());

        return redirect()->route('wifi-routers.index')
            ->with('success', 'Wifi Router successfully updated.');
    }

    /**
     * Remove the specified wifi router from storage
     * 
     * @param @param \App\Models\Wifi $wifiRouter
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Wifi $wifiRouter)
    {
        $wifiRouter->delete();

        return response()->json([
            'result' => 'success',
            'message' => 'Wifi Router has been deleted.'
        ]);
    }
}
