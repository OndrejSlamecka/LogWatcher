<?php
/**
 * LogWatcher
 *
 * @link https://github.com/OndrejSlamecka/LogWatcher
 * @copyright (c) 2012 Ondrej Slamecka (http://www.slamecka.cz)
 *
 * License can be found in license.txt file located in the root folder.
 */

use Nette\Utils\Strings;

class TemporaryFilePresenter extends BasePresenter
{

    public function actionClear()
    {
        $this->context->temporaryFiles->remove();

        // Make cache dir again (0777 mode is default)
        mkdir($this->context->temporaryFiles->getDirectory() . '/cache');

        $this->invalidateControl();
        $this->terminate();
    }

}
