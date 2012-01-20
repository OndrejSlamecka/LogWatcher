<?php
/**
 * LogWatcher
 *
 * @link https://github.com/OndrejSlamecka/LogWatcher
 * @copyright (c) 2011 Ondrej Slamecka (http://www.slamecka.cz)
 *
 * License can be found in license.txt file located in the root folder.
 */

namespace Repository;

class File extends \Nette\Object
{

    /** @var string */
    private $directory;

    public function __construct($directory)
    {
        if (!is_dir($directory))
            throw new \Nette\IOException('Path given in config.neon (' . $directory . ') is invalid.');

        $this->directory = realpath($directory);
    }

    /**
     * Returns Nette\Utils\Finder or single file if given $filename
     * @param string $name
     * @return \Nette\Utils\Finder
     */
    public function find($filename = NULL)
    {
        if ($filename === NULL) {
            return \Nette\Utils\Finder::find('*')
                            ->exclude('.*')
                            ->from($this->directory);
        } else {
            $path = $this->directory . '/' . $filename;
            if (is_file($path))
                return file_get_contents($path);
            else
                throw new \Nette\IOException('File ' . $path . ' does not exist');
        }
    }

    /**
     * Removes all files or just $filename if given
     * @param string $filename
     */
    public function remove($filename = NULL)
    {
        if ($filename !== NULL) {
            $filename = realpath($this->directory . '/' . $filename);
            unlink($filename);
        } else {
            $files = $this->find()->childFirst();

            foreach ($files as $file) {
                if ($file->isDir()) {
                    rmdir($file->getPathname());
                } else {
                    unlink($file->getPathname());
                }
            }
        }
    }

}
