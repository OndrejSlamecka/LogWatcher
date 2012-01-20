<?php

use Nette\Utils\Strings;

class TemporaryFilePresenter extends BasePresenter
{

    public function actionClear()
    {
        $this->getService('temporaryFiles')->remove();
        $this->invalidateControl();
        $this->terminate();
    }

}
