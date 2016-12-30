<?php

namespace Seekerliu\Readme\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Seekerliu\Readme\Services\ReadmeService;

class ReadmeController extends Controller
{
    private $readme;

    /**
     * ReadmeController constructor.
     * @param $readme
     */
    public function __construct(ReadmeService $readme)
    {
        $this->readme = $readme;
    }

    public function index($packageName='laravel_framework')
    {
        $packages = $this->readme->getPackageList();
        $docs = $this->readme->getDocs($packageName);

        $packageName = $this->readme->parseUrlParamToPackageName($packageName);
        return view('readme::index')->with(compact('packageName', 'packages', 'docs'));
    }

}
