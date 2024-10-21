<?php

namespace App\Http\Controllers;

use App\Models\Backgroundmodels\Project;
use App\Models\ProjectElement;
use Beste\Json;
use Illuminate\Http\Request;

class ChartsDataController extends Controller
{
    const CHART_LABEL = '相關作品數量';

    public $chartType = 'bar';

    public function getLatestElementData(Request $request)
    {
        return  ProjectElement::select('project_id', 'element_name')
            ->distinct()
            ->get()
            ->groupBy('element_name')
            ->map(function ($element) {
                return $element->count();
            })
            ->sortDesc()
            ->toArray();
    }

    public function setChart(Request $request)
    {

        return response(
            [
                'type' => $this->chartType,
                'data' => [
                    'datasets' => [
                        [
                            'label' => self::CHART_LABEL,
                            'data' => $this->getLatestElementData($request),
                            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                            'borderColor' => 'rgb(54, 162, 235)',
                            'borderWidth' => '1'
                        ]
                    ]
                ],
                'options' => [
                    'responsive' => true,
                    'maintainAspectRatio' => false,
                    'scales' => [
                        'y' => [
                            'ticks' => [
                                'beginAtZero' => true,
                                'stepSize' => '1',
                            ]
                        ]
                    ],
                    'plugins' => [
                        'legend' => [
                            'display' => true,
                            'position' => 'right',
                            // 'align' => 'center'
                        ],
                        'tooltip' => [
                            'enabled' => true
                        ]
                    ]
                ]
            ]
        );
    }
}
