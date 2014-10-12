<?php
namespace Family\Model;

use Zend\View\Model\JsonModel;

class JsonModelUnicode extends JsonModel
{
    public function serialize()
    {
        $variables = $this->getVariables();
        if ($variables instanceof Traversable) {
            $variables = ArrayUtils::iteratorToArray($variables);
        }

        if (null !== $this->jsonpCallback) {
            return $this->jsonpCallback.'('.json_encode($variables, JSON_UNESCAPED_UNICODE).');';
        }
        return json_encode($variables, JSON_UNESCAPED_UNICODE);
    }
}
