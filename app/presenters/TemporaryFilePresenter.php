<?php

use Nette\Utils\Strings;

class TemporaryFilePresenter extends BasePresenter
{

    public function actionClear()
    {
        $this->getService('temporaryFiles')->remove();

        // Make cache dir again (0777 mode is default)
        mkdir($this->getService('temporaryFiles')->getDirectory() . '/cache');

        $this->invalidateControl();
        $this->terminate();
    }

}
