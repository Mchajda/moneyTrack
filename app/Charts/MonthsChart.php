<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class MonthsChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($axes)
    {
        parent::__construct();
        $this->displayAxes($axes);
        $this->minimalist(false);
    }
}
