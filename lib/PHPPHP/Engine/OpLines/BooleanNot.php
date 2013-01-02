<?php

namespace PHPPHP\Engine\OpLines;

class BitwiseAnd extends \PHPPHP\Engine\OpLine {

    public function execute(\PHPPHP\Engine\ExecuteData $data) {
        $this->result->setValue(!$this->op1->getValue());

        $data->nextOp();
    }

}