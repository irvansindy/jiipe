<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\ZoneCluster;
use App\Models\SubDevelopment;
use App\Models\SubRegionalAdvantages;
use App\Models\SubResourceEnergy;
class IndustrialEstateController extends Controller
{
    public function index()
    {
        $zones = Zone::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }, 'zoneClass.translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])->where('zone_class_id', 1)->get();
        return view('layouts.client.industrial-estate.index', compact('zones'));
    }

    public function zoneDetail($id)
    {
        $zones = Zone::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }, 'zoneClass.translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])->where('zone_class_id', 1)->get();

        $zone = Zone::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }, 'zoneClass.translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])->findOrFail($id);

        $clusters = ZoneCluster::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }, 'zone' => function($query) {
            $query->with(['translations' => function($query){
                $query->where('locale', app()->getLocale());
            }]);
        }])
        ->where('zone_id', $id)
        ->get();

        $advantages = SubRegionalAdvantages::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])
        ->where('zone_id', $id)->get();

        $energies = SubResourceEnergy::with(['translations' => function($query) {
            $query->where('locale', app()->getLocale());
        }])
        ->where('zone_id', $id)->get();
        $developments = SubDevelopment::where('zone_id', $id)->get();
        return view('layouts.client.industrial-estate.zone-detail', compact('zones','zone', 'clusters', 'developments', 'advantages', 'energies'));
    }

    public function clusterDetail($id)
    {
        $cluster = ZoneCluster::with('translations')->findOrFail($id);
        return view('layouts.client.industrial-estate.cluster-detail', compact('cluster'));
    }

    public function developmentDetail($id)
    {
        $development = SubDevelopment::with('translations')->findOrFail($id);
        return view('layouts.client.industrial-estate.development-detail', compact('development'));
    }

    public function advantageDetail($id)
    {
        $advantage = SubRegionalAdvantages::with('translations')->findOrFail($id);
        return view('layouts.client.industrial-estate.advantage-detail', compact('advantage'));
    }

    public function energyDetail($id)
    {
        $energy = SubResourceEnergy::with('translations')->findOrFail($id);
        return view('layouts.client.industrial-estate.energy-detail', compact('energy'));
    }
}
