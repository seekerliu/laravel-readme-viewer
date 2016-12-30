<?php
/**
 * author: seekerliu
 * createTime: 2016/12/30 上午11:24
 * Description:
 */
namespace Seekerliu\Readme\Services;

use cebe\markdown\GithubMarkdown;
use Illuminate\Filesystem\Filesystem;

class ReadmeService
{
    /**
     * @var Filesystem
     */
    private $files;

    /**
     * Markdown
     * @var
     */
    private $parser;

    /**
     * @array Packages
     */
    private $packages;

    /**
     * ReadmeService constructor.
     * @param Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->parser = new GithubMarkdown();
        $this->packages = $this->getAllPackages();
    }

    public function getPackageList()
    {
        return $this->packages;
    }

    public function getDocs($packageName)
    {
        $fileName = $this->getReadmeFile($this->parseUrlParamToPackageName($packageName));
        if(!is_file($fileName)) {
            return 'No Readme File.';
        }
        $markdown = $this->files->get($fileName);
        $html = $this->parser->parse($markdown);
        return $html;
    }

    public function parsePackageNameToUrlParam($name)
    {
        return str_replace('/', '_', $name);
    }

    public function parseUrlParamToPackageName($name)
    {
        return str_replace('_', '/', $name);
    }

    protected function getAllPackages()
    {
        $composer = json_decode($this->files->get(app_path().'/../composer.json'));

        $require = get_object_vars($composer->require);
        $requireDev = get_object_vars($composer->{'require-dev'});

        $packages = [];

        foreach($require as $key=>$value) {
            if($key!='php') {
                $packages['require'][$key] = $this->parsePackageNameToUrlParam($key);
            }
        }

        foreach($requireDev as $key=>$value) {
            $packages['require-dev'][$key] = $this->parsePackageNameToUrlParam($key);
        }

        return $packages;
    }

    protected function getReadmeFile($packageName)
    {
        $name = $this->getReadmeFileName(\Config::get('readme.vendor_path').$packageName);
        return $name;
    }

    protected function getReadmeFileName($path)
    {
        $dir = dir($path);
        while($file = $dir->read()) {
            if(!is_dir($filePath = "$path/$file")) {
                if(stristr($file, \Config::get('readme.filename'))) {
                    return $filePath;
                }
            }
        }
    }

}