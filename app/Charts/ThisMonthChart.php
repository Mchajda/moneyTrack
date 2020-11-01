<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ThisMonthChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($axes, $minimalist)
    {
        parent::__construct();
        $this->minimalist($minimalist);
        $this->displayAxes($axes);
    }
}
