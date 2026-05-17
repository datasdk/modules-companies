<?php

namespace Modules\Companies\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Companies\Models\Companies as CompanyModel;
use Carbon\Carbon;

class DashboardCompanies extends AbstractWidget
{

    
    public $reloadTimeout = 60;

    protected $config = [];

    public function run()
    {
        // Statistik
        $totalCompanies = CompanyModel::count();
        $companiesCreatedToday = CompanyModel::whereDate('created_at', Carbon::today())->count();
        $companiesCreatedThisMonth = CompanyModel::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Seneste firmaer + beregnet logo_url
        $latestCompanies = CompanyModel::latest()
            ->limit(3)
            ->get()
            ->map(function ($company) {
                $company->logo_url = $company->logo
                    ? asset('storage/' . $company->logo)
                    : 'https://placehold.co/40x40/6c757d/ffffff?text=' . strtoupper(substr($company->name, 0, 2));

                return $company;
            });

        return view('companies::widgets.dashboard_companies', [
            'config' => $this->config,
            'totalCompanies' => $totalCompanies,
            'latestCompanies' => $latestCompanies,
            'companiesCreatedToday' => $companiesCreatedToday,
            'companiesCreatedThisMonth' => $companiesCreatedThisMonth,
        ]);
    }
}
