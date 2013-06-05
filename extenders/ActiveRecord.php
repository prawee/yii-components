<?php
/*
* create by mr.prawee wongsa 
* www.prawee.com
*/
class ActiveRecord extends CActiveRecord{
   public function beforeSave() {
        if ($this->isNewRecord) {
            if ($this->hasAttribute('created'))
                $this->created = new CDbExpression('NOW()');
        }

        if ($this->hasAttribute('modified'))
            $this->modified = new CDbExpression('NOW()');

        return parent::beforeSave();
    }
    public function scope() {
       return array_merge(parent::scopes(),array(
            'active'=>array(
                'condition'=>' t.status="A" ',
            ),
        ));
    }
}
