<?php

namespace PHPPHP\Engine\Zval;

use PHPPHP\Engine\Zval;

class Variable extends Zval {

    protected $name;
    protected $zval;
    protected $executor;

    public function __construct(Zval $name) {
        $this->name = $name;
    }

    public function __call($method, $args) {
        $varName = $this->name->toString();
        if ($varName == 'this') {
            $this->zval = Zval::lockedPtrFactory($this->executor->getCurrent()->ci);
        } else {
            $this->zval = $this->executor->getCurrent()->fetchVariable($varName);
        }
        return call_user_func_array(array($this->zval, $method), $args);
    }

    public function &getArray() {
        $this->zval = $this->executor->getCurrent()->fetchVariable($this->name->toString());
        $ret = &$this->zval->getArray();
        return $ret;
    }

    public function setExecutor(\PHPPHP\Engine\Executor $executor) {
        $this->executor = $executor;
    }

    public function getName() {
        return $this->name->toString();
    }
}