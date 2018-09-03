<?php namespace NSRosenqvist\Phulp;

use Phulp\DistFile;
use Phulp\Source;
use Phulp\Filter\Filter;

class ChangedFilter implements \Phulp\PipeInterface
{
    private $dest;

    public function __construct(string $dest)
    {
        $this->dest = $dest;
    }

    public function execute(Source $src)
    {
        $filter = new Filter(function (DistFile $file) {
            $path = $file->getFullPath().DIRECTORY_SEPARATOR.$file->getName();
            $dest = $this->dest.DIRECTORY_SEPARATOR.$file->getDistpathname();

            if (! file_exists($dest)) {
                return true;
            }
            elseif (filemtime($path) > filemtime($dest)) {
                return true;
            }
            elseif (md5_file($path) !== md5_file($dest)) {
                return true;
            }

            return false;
        });

        $filter->execute($src);
    }
}
